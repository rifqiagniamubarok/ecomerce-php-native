<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Bobakuy\App\Router;
use Bobakuy\Config\Database;
use Bobakuy\Controller\AdminTransaksiController;
use Bobakuy\Controller\CustomerController;
use Bobakuy\Controller\HomeController;
use Bobakuy\Controller\KeranjangController;
use Bobakuy\Controller\MenuController;
use Bobakuy\Controller\TransaksiController;
use Bobakuy\Controller\UserController;
use Bobakuy\Middleware\MustNotLoginMiddleware;
use Bobakuy\Middleware\MustLoginMiddleware;
use Bobakuy\Middleware\MustLoginMiddlewareGeneral;
use Bobakuy\Middleware\MustLoginMiddlewareUser;

Database::getConnection('prod');

// Home Controller
// Router::add('GET', '/', HomeController::class, 'index', []);

// Admin
// Menu
Router::add('GET', '/admin/beranda', MenuController::class, 'index', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/menu/buat', MenuController::class, 'buat', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/menu/buat', MenuController::class, 'buatMenu', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/menu/edit/([0-9]+)', MenuController::class, 'editMenu', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/menu/edit/([0-9]+)', MenuController::class, 'editMenuPost', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/menu/hapus/([0-9]+)', MenuController::class, 'hapusMenu', [MustLoginMiddleware::class]);

// Transaksi
Router::add('GET', '/admin/transaksi', AdminTransaksiController::class, 'index', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/transaksiDetail/([0-9]+)', AdminTransaksiController::class, 'transaksiDetail', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/transaksiDiantar/([0-9]+)', AdminTransaksiController::class, 'transaksiDiantar', [MustLoginMiddleware::class]);

// User Controller
Router::add('GET', '/admin/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/admin/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
Router::add('GET', '/admin/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/admin/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
Router::add('GET', '/logout', UserController::class, 'logout', [MustLoginMiddlewareGeneral::class]);
Router::add('GET', '/admin/profile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/profile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
Router::add('GET', '/admin/password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/admin/password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);

// User
Router::add('GET', '/register', UserController::class, 'registerUser', [MustNotLoginMiddleware::class]);
Router::add('POST', '/register', UserController::class, 'postRegisterUser', [MustNotLoginMiddleware::class]);
Router::add('GET', '/', UserController::class, 'loginUser', [MustNotLoginMiddleware::class]);
Router::add('GET', '/login', UserController::class, 'loginUser', [MustNotLoginMiddleware::class]);
Router::add('POST', '/login', UserController::class, 'postLoginUser', [MustNotLoginMiddleware::class]);
Router::add('GET', '/menu', CustomerController::class, 'index', [MustLoginMiddlewareUser::class]);

// keranjang
Router::add('GET', '/keranjang', KeranjangController::class, 'index', [MustLoginMiddlewareUser::class]);
Router::add('POST', '/tambahKeranjang/([0-9]+)', KeranjangController::class, 'tambahKeranjang', [MustLoginMiddlewareUser::class]);
Router::add('POST', '/kuranginKeranjang/([0-9]+)', KeranjangController::class, 'kuranginKeranjang', [MustLoginMiddlewareUser::class]);
Router::add('POST', '/lanjutPembayaran', KeranjangController::class, 'lanjutPembayaran', [MustLoginMiddlewareUser::class]);

// transaksi
Router::add('GET', '/transaksi', TransaksiController::class, 'index', [MustLoginMiddlewareUser::class]);
Router::add('GET', '/transaksiDetail/([0-9]+)', TransaksiController::class, 'transaksiDetail', [MustLoginMiddlewareUser::class]);
Router::add('POST', '/bayarTransaksi/([0-9]+)', TransaksiController::class, 'konfirmasiPembayaran', [MustLoginMiddlewareUser::class]);
Router::add('POST', '/terimaTransaksi/([0-9]+)', TransaksiController::class, 'terimaTransaksi', [MustLoginMiddlewareUser::class]);
Router::add('POST', '/batalkanTransaksi/([0-9]+)', TransaksiController::class, 'batalkanTransaksi', [MustLoginMiddlewareUser::class]);
Router::run();
