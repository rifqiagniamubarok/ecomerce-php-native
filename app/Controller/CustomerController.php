<?php

namespace Bobakuy\Controller;

use Bobakuy\App\View;
use Bobakuy\Config\Database;
use Bobakuy\Exception\ValidationException;
use Bobakuy\Model\TambahKeranjangRequest;
use Bobakuy\Repository\KeranjangItemRepository;
use Bobakuy\Repository\MenuRepository;
use Bobakuy\Service\MenuService;
use Bobakuy\Service\SessionService;

class CustomerController
{
    private MenuService $menuService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $menuRepository = new MenuRepository($connection);
        $this->menuService = new MenuService($menuRepository);
    }
    function index()
    {
        $dataMenu = $this->menuService->semuaMenu();
        View::render('Customer/index', [
            "title" => "Menu ",
            "dataMenu" => $dataMenu
        ]);
    }
}
