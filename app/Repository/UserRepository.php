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
        $statement = $this->connection->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
        $statement->execute([
            $user->username, $user->password
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
        $statement = $this->connection->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->username = $row['username'];
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
