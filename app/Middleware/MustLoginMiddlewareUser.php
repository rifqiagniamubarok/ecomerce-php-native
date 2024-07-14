<?php

namespace Bobakuy\Middleware;

use Bobakuy\App\View;
use Bobakuy\Config\Database;
use Bobakuy\Repository\SessionRepository;
use Bobakuy\Repository\UserRepository;
use Bobakuy\Service\SessionService;

class MustLoginMiddlewareUser implements Middleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function before(): void
    {
        $user = $this->sessionService->current();
        if ($user == null) {
            View::redirect('/login');
        } else if ($user->role !== 'user') {
            View::redirect('/login');
        }
    }
}
