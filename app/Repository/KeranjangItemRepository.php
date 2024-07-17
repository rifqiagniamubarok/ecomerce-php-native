<?php

namespace Bobakuy\Repository;

use Bobakuy\Domain\KeranjangItem;

class KeranjangItemRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(KeranjangItem $keranjang): KeranjangItem
    {
        $statement = $this->connection->prepare("INSERT INTO keranjang_item(user_id, menu_id, nama_menu, jumlah, harga, total_harga) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->execute([
            $keranjang->user_id, $keranjang->menu_id, $keranjang->nama_menu, $keranjang->jumlah, $keranjang->harga, $keranjang->total_harga
        ]);
        return $keranjang;
    }
}
