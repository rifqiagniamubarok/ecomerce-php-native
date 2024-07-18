<?php

namespace Bobakuy\Controller;

use Bobakuy\App\View;
use Bobakuy\Config\Database;
use Bobakuy\Exception\ValidationException;
use Bobakuy\Model\BuatMenuRequest;
use Bobakuy\Repository\MenuRepository;
use Bobakuy\Repository\SessionRepository;
use Bobakuy\Repository\UserRepository;
use Bobakuy\Service\MenuService;
use Bobakuy\Service\SessionService;
use Error;
use PDO;

class MenuController
{

    private MenuService $menuService;
    private SessionService $sessionService;
    private \PDO $connection;

    public function __construct()
    {
        $connection = Database::getConnection();

        $menuRepository = new MenuRepository($connection);
        $this->menuService = new MenuService($menuRepository);
        $this->connection = Database::getConnection();
    }


    function index()
    {
        $dataMenu = $this->menuService->semuaMenu();

        View::render('Menu/index', [
            "title" => "Home",
            "dataMenu" => $dataMenu,
        ]);
    }
    function buat()
    {
        View::render('Menu/create', [
            "title" => "Buat menu "
        ]);
    }
    function buatMenu()
    {
        $request = new BuatMenuRequest();
        $request->nama = $_POST['nama'];
        $request->harga = $_POST['harga'];

        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['gambar']['tmp_name'];
            $fileName = $_FILES['gambar']['name'];
            $fileSize = $_FILES['gambar']['size'];
            $fileType = $_FILES['gambar']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Directory to save the uploaded file
                $uploadFileDir = __DIR__ . '/../../public/images/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }

                // Generate unique file name with timestamp
                $timestamp = time();
                $fileNameNew =  $fileNameCmps[0] . '-' . $timestamp . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $fileNameNew;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $request->gambar = '/images/' . $fileNameNew; // Gunakan nama file baru dengan timestamp
                } else {
                    throw new Error('Ada masalah dalam upload file, silahkan ulangin');
                }
            } else {
                throw new Error('Upload file gagal. Tipe file yang diperbolehkan: ' . implode(',', $allowedfileExtensions));
            }
        } else {
            throw new Error('Ada masalah dalam upload file, silahkan ulangin');
        }

        try {

            $statement3 = $this->connection->prepare("INSERT INTO menu(gambar, nama, harga) VALUES (?, ?, ?)");
            $statement3->execute([$request->gambar, $request->nama, $request->harga]);
            View::redirect('/admin/beranda');
        } catch (ValidationException $exception) {
            View::render('Menu/create', [
                'title' => 'Buat menu',
                'error' => $exception->getMessage()
            ]);
        }
    }
    function editMenu($id)
    {
        $id = (int)$id;
        $statement = $this->connection->prepare("SELECT * FROM menu WHERE id = ?");
        $statement->execute([$id]);
        $menu = $statement->fetch(PDO::FETCH_ASSOC);
        if ($menu) {
            View::render('Menu/edit', [
                "title" => "Edit menu",
                "menu" => $menu
            ]);
        } else {
            View::render('Menu/edit', [
                "title" => "Edit menu",
                "error" => "Menu tidak ditemukan"
            ]);
        }
    }
    function editMenuPost($id)
    {
        $request = new BuatMenuRequest();
        $request->nama = $_POST['nama'];
        $request->harga = $_POST['harga'];

        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['gambar']['tmp_name'];
            $fileName = $_FILES['gambar']['name'];
            $fileSize = $_FILES['gambar']['size'];
            $fileType = $_FILES['gambar']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));

            $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'webp');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Directory to save the uploaded file
                $uploadFileDir = __DIR__ . '/../../public/images/';
                if (!is_dir($uploadFileDir)) {
                    mkdir($uploadFileDir, 0777, true);
                }

                // Generate unique file name with timestamp
                $timestamp = time();
                $fileNameNew =  $fileNameCmps[0] . '-' . $timestamp . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $fileNameNew;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    $request->gambar = '/images/' . $fileNameNew; // Gunakan nama file baru dengan timestamp
                } else {
                    throw new Error('Ada masalah dalam upload file, silahkan ulangin');
                }
            } else {
                throw new Error('Upload file gagal. Tipe file yang diperbolehkan: ' . implode(',', $allowedfileExtensions));
            }
        } else {
            throw new Error('Ada masalah dalam upload file, silahkan ulangin');
        }

        $id = (int)$id;
        try {
            $statement3 = $this->connection->prepare("UPDATE menu SET gambar = ?, nama = ?, harga = ? WHERE id = ?");
            $statement3->execute([$request->gambar, $request->nama, $request->harga, $id]);
            View::redirect('/admin/beranda');
        } catch (ValidationException $exception) {
            View::render('Menu/create', [
                'title' => 'Buat menu',
                'error' => $exception->getMessage()
            ]);
        }
    }
    function hapusMenu($id)
    {
        $id = (int)$id;
        try {
            // Mulai transaksi
            $this->connection->beginTransaction();

            // Hapus semua item transaksi yang terkait dengan menu
            $statement1 = $this->connection->prepare("DELETE FROM transaksi_item WHERE menu_id = ?");
            $statement1->execute([$id]);

            // Hapus menu
            $statement2 = $this->connection->prepare("DELETE FROM menu WHERE id = ?");
            $statement2->execute([$id]);

            // Commit transaksi
            $this->connection->commit();

            // Redirect ke halaman beranda admin setelah berhasil menghapus
            View::redirect('/admin/beranda');
        } catch (ValidationException $exception) {
            // Rollback transaksi jika terjadi kesalahan
            $this->connection->rollBack();

            // Render ulang halaman beranda dengan pesan error
            View::render('Admin/beranda', [
                'title' => 'Beranda Admin',
                'error' => $exception->getMessage()
            ]);
        }
    }
}
