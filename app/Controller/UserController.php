<?php

namespace Bobakuy\Controller;

use Bobakuy\App\View;
use Bobakuy\Config\Database;
use Bobakuy\Exception\ValidationException;
use Bobakuy\Model\UserLoginRequest;
use Bobakuy\Model\UserPasswordUpdateRequest;
use Bobakuy\Model\UserProfileUpdateRequest;
use Bobakuy\Model\UserRegisterRequest;
use Bobakuy\Repository\SessionRepository;
use Bobakuy\Repository\UserRepository;
use Bobakuy\Service\SessionService;
use Bobakuy\Service\UserService;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;

    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    public function register()
    {
        View::render('User/register', [
            'title' => 'Register new admin'
        ]);
    }
    public function postRegister()
    {
        $request = new UserRegisterRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->role = 'admin';

        try {
            $this->userService->register($request);
            View::redirect('/admin/login');
        } catch (ValidationException $exception) {
            View::render('User/register', [
                'title' => 'Register new User',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function registerUser()
    {
        View::render('User/registerUser', [
            'title' => 'Register new User'
        ]);
    }
    public function postRegisterUser()
    {
        $request = new UserRegisterRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->role = 'user';

        try {
            $this->userService->register($request);
            View::redirect('/login');
        } catch (ValidationException $exception) {
            View::render('User/register', [
                'title' => 'Register new User',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function login()
    {
        View::render('User/login', [
            "title" => "Login admin"
        ]);
    }
    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->login($request);
            if ($response->user->role !== 'admin') {
                throw new ValidationException('Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
            $this->sessionService->create($response->user->id);
            View::redirect('/admin/beranda');
        } catch (ValidationException $exception) {
            View::render('User/login', [
                'title' => 'Login user',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function loginUser()
    {
        View::render('User/loginUser', [
            "title" => "Login user"
        ]);
    }
    public function postLoginUser()
    {
        $request = new UserLoginRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->login($request);
            if ($response->user->role != 'user') {
                throw new ValidationException('Anda tidak memiliki izin untuk mengakses halaman ini.');
            }
            $this->sessionService->create($response->user->id);

            View::redirect('/menu');
        } catch (ValidationException $exception) {
            View::render('User/loginUser', [
                'title' => 'Login user',
                'error' => $exception->getMessage()
            ]);
        }
    }
    public function logout()
    {
        $user = $this->sessionService->current();
        if ($user->role == 'admin') {
            $this->sessionService->destroy();
            View::redirect("/admin/login");
        } else {
            $this->sessionService->destroy();
            View::redirect("/login");
        }
    }

    public function updateProfile()
    {
        $user = $this->sessionService->current();

        View::render('User/profile', [
            "title" => "Update user profile",
            "user" => [
                "id" => $user->id,
                "name" => $user->username
            ]
        ]);
    }

    public function postUpdateProfile()
    {
        $user = $this->sessionService->current();

        $request = new UserProfileUpdateRequest();
        $request->username = $user->username;

        try {
            $this->userService->updateProfile($request);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/profile', [
                "title" => "Update user profile",
                "error" => $exception->getMessage(),
                "user" => [
                    "id" => $user->id,
                    "name" => $_POST['name']
                ]
            ]);
        }
    }

    public function updatePassword()
    {
        $user = $this->sessionService->current();
        View::render('User/password', [
            "title" => "Update user password",
            "user" => [
                "id" => $user->id
            ]
        ]);
    }
}
