<?php

namespace Bobakuy\Repository;

use Bobakuy\Domain\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(username, password, role, alamat) VALUES (?, ?, ?, ?)");
        $statement->execute([
            $user->username, $user->password, $user->role, $user->alamat
        ]);
        return $user;
    }

    public function saveUser(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users(username, password, role) VALUES (?, ?)");
        $statement->execute([
            $user->username, $user->password, 'user'
        ]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users SET name = ?, password = ? WHERE id = ?");
        $statement->execute([
            $user->username, $user->password, $user->id
        ]);
        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->role = $row['role'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
    public function findById(string $id): ?User
    {
        $statement = $this->connection->prepare("SELECT id, username, password, role FROM users WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->username = $row['username'];
                $user->role = $row['role'];
                $user->password = $row['password'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from users");
    }
}
