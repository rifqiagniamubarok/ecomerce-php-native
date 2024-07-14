<?php

namespace Bobakuy\Controller;

use Bobakuy\App\View;
use Bobakuy\Config\Database;
use Bobakuy\Repository\SessionRepository;
use Bobakuy\Repository\UserRepository;
use Bobakuy\Service\SessionService;

class MenuController
{

    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }


    function index()
    {
        View::render('Menu/index', [
            "title" => "Home"
        ]);
    }
    function buat()
    {
        View::render('Menu/create', [
            "title" => "Create menu "
        ]);
    }
    function postBuat()
    {
        View::render('Menu/create', [
            "title" => "Create menu "
        ]);
    }
}
