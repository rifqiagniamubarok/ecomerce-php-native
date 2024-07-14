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

class MenuController
{

    private MenuService $menuService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();

        $menuRepository = new MenuRepository($connection);
        $this->menuService = new MenuService($menuRepository);
    }


    function index()
    {
        $dataMenu = $this->menuService->semuaMenu();
        var_dump($dataMenu);
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
    function buatPost()
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
                    $request->gambar = 'http://localhost:8080/images/' . $fileNameNew; // Gunakan nama file baru dengan timestamp
                } else {
                    throw new ValidationException('There was an error moving the uploaded file.');
                }
            } else {
                throw new ValidationException('Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions));
            }
        } else {
            throw new ValidationException('No file uploaded or upload error.');
        }

        try {
            $this->menuService->buatMenu($request);
            View::redirect('/admin/beranda');
        } catch (ValidationException $exception) {
            View::render('Menu/create', [
                'title' => 'Buat menu',
                'error' => $exception->getMessage()
            ]);
        }
    }
}
