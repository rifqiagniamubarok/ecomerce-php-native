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

class TransaksiController
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
        $statement = $this->connection->prepare("SELECT * FROM transaksi WHERE transaksi.user_id = ? ORDER BY transaksi.date DESC");
        $statement->execute([$user->id]);
        $transaksi = $statement->fetchAll();

        View::render('Customer/transaksi', [
            "title" => "Transaksi ",
            "transaksi" => $transaksi
        ]);
    }
    function transaksiDetail($id)
    {

        $statement = $this->connection->prepare("SELECT * FROM transaksi WHERE id = ?");
        $statement->execute([$id]);

        $transaksi = $statement->fetch(PDO::FETCH_ASSOC);

        $statement2 = $this->connection->prepare("SELECT * FROM transaksi_item WHERE transaksi_id = ?");
        $statement2->execute([$id]);

        $transaksi_item = $statement2->fetchAll();

        if ($transaksi) {
            View::render('Customer/transaksiDetail', [
                "title" => "Transaksi ",
                "transaksi" => $transaksi,
                "transaksi_item" => $transaksi_item
            ]);
        } else {
            // Jika transaksi tidak ditemukan, tampilkan pesan error atau redirect
            View::render('Customer/transaksiDetail', [
                "title" => "Transaksi ",
                "error" => "Transaksi tidak ditemukan"
            ]);
        }
    }
    function konfirmasiPembayaran($id)
    {
        try {
            // Persiapkan query untuk mengambil transaksi berdasarkan id
            $statement = $this->connection->prepare("SELECT * FROM transaksi WHERE id = ?");
            $statement->execute([$id]);

            // Ambil hasil transaksi
            $transaksi = $statement->fetch(PDO::FETCH_ASSOC);

            if ($transaksi) {
                // Cek apakah status transaksi adalah 'menunggu_pembayaran'
                if ($transaksi['status'] == 'menunggu_pembayaran') {
                    // Persiapkan query untuk mengubah status transaksi menjadi 'dibayar'
                    $updateStatement = $this->connection->prepare("UPDATE transaksi SET status = 'diproses' WHERE id = ?");
                    $updateStatement->execute([$id]);

                    // Cek apakah update berhasil
                    if ($updateStatement->rowCount() > 0) {
                        View::redirect("/transaksiDetail/" . $id);
                    } else {
                        throw new Error('Transaksi tidak ditemukan');
                    }
                } else {
                    throw new Error('Transaksi tidak ditemukan');
                }
            } else {
                throw new Error('Transaksi tidak ditemukan');
            }

            View::redirect("/transaksiDetail/" . $id);
        } catch (ValidationException $exception) {
            View::render('Customer/transaksiDetail', [
                'title' => 'Detail transaksi',
                'error' => $exception->getMessage()
            ]);
        }
    }
    function terimaTransaksi($id)
    {
        try {
            // Persiapkan query untuk mengambil transaksi berdasarkan id
            $statement = $this->connection->prepare("SELECT * FROM transaksi WHERE id = ?");
            $statement->execute([$id]);

            // Ambil hasil transaksi
            $transaksi = $statement->fetch(PDO::FETCH_ASSOC);

            if ($transaksi) {
                // Cek apakah status transaksi adalah 'menunggu_pembayaran'
                if ($transaksi['status'] == 'diantar') {
                    // Persiapkan query untuk mengubah status transaksi menjadi 'dibayar'
                    $updateStatement = $this->connection->prepare("UPDATE transaksi SET status = 'diterima' WHERE id = ?");
                    $updateStatement->execute([$id]);

                    // Cek apakah update berhasil
                    if ($updateStatement->rowCount() > 0) {
                        View::redirect("/transaksiDetail/" . $id);
                    } else {
                        throw new Error('Transaksi tidak ditemukan');
                    }
                } else {
                    throw new Error('Transaksi tidak ditemukan');
                }
            } else {
                throw new Error('Transaksi tidak ditemukan');
            }

            View::redirect("/transaksiDetail/" . $id);
        } catch (ValidationException $exception) {
            View::render('Customer/transaksiDetail', [
                'title' => 'Detail transaksi',
                'error' => $exception->getMessage()
            ]);
        }
    }
    function batalkanTransaksi($id)
    {
        try {
            // Persiapkan query untuk mengambil transaksi berdasarkan id
            $statement = $this->connection->prepare("SELECT * FROM transaksi WHERE id = ?");
            $statement->execute([$id]);

            // Ambil hasil transaksi
            $transaksi = $statement->fetch(PDO::FETCH_ASSOC);

            if ($transaksi) {
                // Cek apakah status transaksi adalah 'menunggu_pembayaran'
                if ($transaksi['status'] == 'menunggu_pembayaran') {
                    // Persiapkan query untuk mengubah status transaksi menjadi 'dibayar'
                    $updateStatement = $this->connection->prepare("UPDATE transaksi SET status = 'dibatalkan' WHERE id = ?");
                    $updateStatement->execute([$id]);

                    // Cek apakah update berhasil
                    if ($updateStatement->rowCount() > 0) {
                        View::redirect("/transaksiDetail/" . $id);
                    } else {
                        throw new Error('Transaksi tidak ditemukan');
                    }
                } else {
                    throw new Error('Transaksi tidak ditemukan');
                }
            } else {
                throw new Error('Transaksi tidak ditemukan');
            }

            View::redirect("/transaksiDetail/" . $id);
        } catch (ValidationException $exception) {
            View::render('Customer/transaksiDetail', [
                'title' => 'Detail transaksi',
                'error' => $exception->getMessage()
            ]);
        }
    }
}
