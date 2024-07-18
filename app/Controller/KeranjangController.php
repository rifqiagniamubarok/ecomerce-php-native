<?php

namespace Bobakuy\Controller;

use Bobakuy\App\View;
use Bobakuy\Config\Database;
use Bobakuy\Exception\ValidationException;
use Bobakuy\Repository\SessionRepository;
use Bobakuy\Repository\UserRepository;
use Bobakuy\Service\SessionService;
use Error;
use PDO;

class KeranjangController
{

    private \PDO $connection;

    private SessionService $sessionService;

    public function __construct()
    {
        $this->connection = Database::getConnection();

        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function index()
    {
        $user = $this->sessionService->current();
        $statement = $this->connection->prepare("
        SELECT 
            keranjang_item.*, 
            menu.nama AS nama_menu, 
            menu.harga AS harga_menu,
            menu.gambar AS gambar
        FROM 
            keranjang_item 
        JOIN 
            menu 
        ON 
            keranjang_item.menu_id = menu.id
        WHERE keranjang_item.user_id = ?
    
    ");

        $statement->execute([$user->id]);
        $keranjangs = $statement->fetchAll(PDO::FETCH_ASSOC);

        View::render('Customer/keranjang', [
            "title" => "Keranjang ",
            "keranjang" => $keranjangs
        ]);
    }
    function tambahKeranjang($id)
    {
        try {
            $id = (int)$id;
            $user = $this->sessionService->current();

            $statement = $this->connection->prepare("SELECT id, nama, harga FROM menu WHERE id = ?");
            $statement->execute([$id]);
            $menu = $statement->fetch(PDO::FETCH_ASSOC);

            if ($menu) {
                $statement2 = $this->connection->prepare("SELECT * FROM keranjang_item WHERE menu_id = ? AND user_id = ?");
                $statement2->execute([$id, $user->id]);
                $existingItem = $statement2->fetch(PDO::FETCH_ASSOC);

                if (!$existingItem) {
                    $statement3 = $this->connection->prepare("INSERT INTO keranjang_item(user_id, menu_id, nama_menu, jumlah, harga, total_harga) VALUES (?, ?, ?, ?, ?, ?)");
                    $statement3->execute([$user->id, $id, $menu['nama'], 1, $menu['harga'], $menu['harga']]);
                } else {
                    $newJumlah = $existingItem['jumlah'] + 1;
                    $newTotalHarga = $menu['harga'] * $newJumlah;
                    $statement3 = $this->connection->prepare("UPDATE keranjang_item SET jumlah = ?, total_harga = ? WHERE menu_id = ? AND user_id = ?");
                    $statement3->execute([$newJumlah, $newTotalHarga, $id, $user->id]);
                }

                View::redirect('/keranjang');
            } else {
                throw new ValidationException("Menu tidak ditemukan");
            }
        } catch (ValidationException $exception) {
            View::render('Customer/keranjang', [
                'title' => 'Keranjang',
                'error' => $exception->getMessage()
            ]);
        }
    }
    function kuranginKeranjang($id)
    {
        try {
            $id = (int)$id;
            $user = $this->sessionService->current();

            $statement = $this->connection->prepare("SELECT * FROM keranjang_item WHERE id = ? AND user_id = ?");
            $statement->execute([$id, $user->id]);
            $item = $statement->fetch(PDO::FETCH_ASSOC);

            if ($item) {
                if ($item['jumlah'] > 1) {
                    $newJumlah = $item['jumlah'] - 1;
                    $newTotalHarga = $item['harga'] * $newJumlah;
                    $statement3 = $this->connection->prepare("UPDATE keranjang_item SET jumlah = ?, total_harga = ? WHERE id = ? AND user_id = ?");
                    $statement3->execute([$newJumlah, $newTotalHarga, $id, $user->id]);
                } else {
                    $statement2 = $this->connection->prepare("DELETE FROM keranjang_item WHERE id = ? AND user_id = ?");
                    $statement2->execute([$id, $user->id]);
                }
            } else {
                throw new Error("Keranjang tidak ditemukan");
            }

            // Redirect to the keranjang page after updating the cart
            View::redirect('/keranjang');
        } catch (ValidationException $exception) {
            View::render('Customer/keranjang', [
                'title' => 'Keranjang',
                'error' => $exception->getMessage()
            ]);
        }
    }
    function lanjutPembayaran()
    {
        try {
            $user = $this->sessionService->current();

            // Mulai transaksi
            $this->connection->beginTransaction();

            // Ambil semua item dari keranjang
            $statement = $this->connection->prepare("SELECT * FROM keranjang_item WHERE user_id = ?");
            $statement->execute([$user->id]);
            $keranjangItems = $statement->fetchAll(PDO::FETCH_ASSOC);

            if (empty($keranjangItems)) {
                throw new Error("Keranjang kosong");
            }

            // Hitung total jumlah dan total harga
            $totalJumlah = 0;
            $totalHarga = 0;
            foreach ($keranjangItems as $item) {
                $totalJumlah += $item['jumlah'];
                $totalHarga += $item['total_harga'];
            }

            // Insert data transaksi baru
            $statement = $this->connection->prepare("INSERT INTO transaksi (user_id, total_jumlah, total_harga, status, date) VALUES (?, ?, ?, 'menunggu_pembayaran', NOW())");
            $statement->execute([$user->id, $totalJumlah, $totalHarga]);

            // Ambil ID transaksi yang baru dibuat
            $transaksiId = $this->connection->lastInsertId();

            // Pindahkan setiap item dari keranjang ke transaksi_item dengan transaksi_id
            $statement = $this->connection->prepare("INSERT INTO transaksi_item (transaksi_id, user_id, nama_menu, harga, total_harga, jumlah) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($keranjangItems as $item) {
                $statement->execute([$transaksiId, $user->id, $item['nama_menu'], $item['harga'], $item['total_harga'], $item['jumlah']]);
            }

            // Hapus semua item dari keranjang
            $statement = $this->connection->prepare("DELETE FROM keranjang_item WHERE user_id = ?");
            $statement->execute([$user->id]);

            // Commit transaksi
            $this->connection->commit();

            // Redirect ke halaman sukses atau halaman transaksi
            View::redirect('/transaksi');
        } catch (ValidationException $exception) {
            View::render('Customer/keranjang', [
                'title' => 'Keranjang',
                'error' => $exception->getMessage()
            ]);
        }
    }
}
