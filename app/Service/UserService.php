<?php

namespace Bobakuy\Service;

use Bobakuy\Config\Database;
use Bobakuy\Domain\User;
use Bobakuy\Exception\ValidationException;
use Bobakuy\Model\UserLoginRequest;
use Bobakuy\Model\UserLoginResponse;
use Bobakuy\Model\UserPasswordUpdateRequest;
use Bobakuy\Model\UserPasswordUpdateResponse;
use Bobakuy\Model\UserProfileUpdateRequest;
use Bobakuy\Model\UserProfileUpdateResponse;
use Bobakuy\Model\UserRegisterRequest;
use Bobakuy\Model\UserRegisterResponse;
use Bobakuy\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByUsername($request->username);
            if ($user != null) {
                throw new ValidationException("User Id already exists");
            }

            print_r($request);

            $user = new User();
            $user->username = $request->username;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;



            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if (
            $request->username == null || $request->password == null || trim($request->username) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Id, Name, Password can not blank");
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findByUsername($request->username);
        if ($user == null) {
            throw new ValidationException("Id or password is wrong");
        }

        if (password_verify($request->password, $user->password)) {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        } else {
            throw new ValidationException("Id or password is wrong");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if (
            $request->username == null || $request->password == null ||
            trim($request->username) == "" || trim($request->password) == ""
        ) {
            throw new ValidationException("Id, Password can not blank");
        }
    }

    public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
    {
        $this->validateUserProfileUpdateRequest($request);

        try {
            Database::beginTransaction();

            $user = $this->userRepository->findByUsername($request->username);
            if ($user == null) {
                throw new ValidationException("User is not found");
            }

            $user->username = $request->username;
            $this->userRepository->update($user);

            Database::commitTransaction();

            $response = new UserProfileUpdateResponse();
            $response->user = $user;
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserProfileUpdateRequest(UserProfileUpdateRequest $request)
    {
        if (
            $request->username == null ||
            trim($request->username) == ""
        ) {
            throw new ValidationException("Id, Name can not blank");
        }
    }
}
