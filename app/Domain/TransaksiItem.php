<?php

namespace Bobakuy\Domain;

class TransaksiItem
{
    public ?int $id;
    public int $user_id;
    public int $menu_id;
    public string $nama_menu;
    public int $harga;
    public int $total_harga;
    public int $jumlah;
}
