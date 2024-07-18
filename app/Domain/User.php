<?php

namespace Bobakuy\Domain;

class User
{
    public ?int $id;
    public string $username;
    public string $password;
    public ?string $role;
    public ?string $alamat;
}
