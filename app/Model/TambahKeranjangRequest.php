<?php

namespace Bobakuy\Model;

class TambahKeranjangRequest
{
    public int $user_id;
    public int $menu_id;
    public string $nama_menu;
    public int $jumlah;
    public int $harga;
    public int $total_harga;
}
