<?php

namespace Bobakuy\Repository;

use Bobakuy\Domain\Menu;
use Bobakuy\Domain\User;

class MenuRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Menu $menu): Menu
    {
        $statement = $this->connection->prepare("INSERT INTO menu(nama, gambar, harga) VALUES (?, ?, ?)");
        $statement->execute([
            $menu->nama, $menu->gambar, $menu->harga
        ]);
        return $menu;
    }

    public function update(Menu $menu): Menu
    {
        $statement = $this->connection->prepare("UPDATE menu SET nama = ?, gambar = ?, harga = ? WHERE id = ?");
        $statement->execute([
            $menu->nama, $menu->gambar, $menu->harga, $menu->id
        ]);
        return $menu;
    }


    public function findById(int $id): ?Menu
    {
        $statement = $this->connection->prepare("SELECT id, nama, gambar, menu FROM menu WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $user = new Menu();
                $user->id = $row['id'];
                $user->nama = $row['nama'];
                $user->gambar = $row['gambar'];
                $user->harga = $row['harga'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByName(string $nama): ?Menu
    {
        $statement = $this->connection->prepare("SELECT id, nama, gambar, harga FROM menu WHERE nama = ?");
        $statement->execute([$nama]);

        try {
            if ($row = $statement->fetch()) {
                $user = new Menu();
                $user->id = $row['id'];
                $user->nama = $row['nama'];
                $user->gambar = $row['gambar'];
                $user->harga = $row['harga'];
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll()
    {
        $statement = $this->connection->prepare("SELECT * FROM menu");
        $statement->execute();

        try {
            $rows = $statement->fetchAll();
            return $rows ?: [];
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from menu");
    }
}
