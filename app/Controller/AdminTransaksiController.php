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

class AdminTransaksiController
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
        $statement = $this->connection->prepare("
        SELECT transaksi.*, users.username 
        FROM transaksi 
        JOIN users ON transaksi.user_id = users.id
        ORDER BY transaksi.date DESC
    ");
        $statement->execute();
        $transaksis = $statement->fetchAll(PDO::FETCH_ASSOC);

        View::render('Transaksi/index', [
            "title" => "Transaksi",
            "transaksi" => $transaksis
        ]);
    }
    function transaksiDetail($id)
    {

        $statement = $this->connection->prepare("SELECT transaksi.*, users.username FROM transaksi JOIN users ON transaksi.user_id = users.id WHERE transaksi.id = ?");
        $statement->execute([$id]);

        $transaksi = $statement->fetch(PDO::FETCH_ASSOC);

        $statement2 = $this->connection->prepare("SELECT * FROM transaksi_item WHERE transaksi_id = ?");
        $statement2->execute([$id]);

        $transaksi_item = $statement2->fetchAll();

        if ($transaksi) {
            View::render('Transaksi/transaksiDetail', [
                "title" => "Transaksi ",
                "transaksi" => $transaksi,
                "transaksi_item" => $transaksi_item
            ]);
        } else {
            // Jika transaksi tidak ditemukan, tampilkan pesan error atau redirect
            View::render('Transaksi/transaksiDetail', [
                "title" => "Transaksi ",
                "error" => "Transaksi tidak ditemukan"
            ]);
        }
    }
    function transaksiDiantar($id)
    {
        try {
            // Persiapkan query untuk mengambil transaksi berdasarkan id
            $statement = $this->connection->prepare("SELECT * FROM transaksi WHERE id = ?");
            $statement->execute([$id]);

            // Ambil hasil transaksi
            $transaksi = $statement->fetch(PDO::FETCH_ASSOC);

            if ($transaksi) {
                // Cek apakah status transaksi adalah 'menunggu_pembayaran'
                if ($transaksi['status'] == 'diproses') {
                    // Persiapkan query untuk mengubah status transaksi menjadi 'dibayar'
                    $updateStatement = $this->connection->prepare("UPDATE transaksi SET status = 'diantar' WHERE id = ?");
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

            View::redirect("/admin/transaksiDetail/" . $id);
        } catch (ValidationException $exception) {
            View::render('Transaksi/transaksiDetail/' . $id, [
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
