<?php

namespace Bobakuy\Domain;

use DateTime;

class Transaksi
{
    public ?int $id;
    public int $user_id;
    public int $total_jumlah;
    public string $total_harga;
    public string $status;
    public DateTime $date;
}
