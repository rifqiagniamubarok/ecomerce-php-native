<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bobakuy\App\Router;
use Bobakuy\Config\Database;
use Bobakuy\Controller\HomeController;
use Bobakuy\Controller\MenuController;
use Bobakuy\Controller\UserController;
use Bobakuy\Middleware\MustNotLoginMiddleware;
use Bobakuy\Middleware\MustLoginMiddleware;

Database::getConnection('prod');

// Home Controller
Router::add('GET', '/', HomeController::class, 'index', []);

// Admin
// Menu
Router::add('GET', '/beranda', MenuController::class, 'index', [MustLoginMiddleware::class]);
Router::add('GET', '/menu/baru', MenuController::class, 'buat', [MustLoginMiddleware::class]);

// User Controller
Router::add('GET', '/admin/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/admin/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/admin/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/admin/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/profile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/profile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);

Router::run();
