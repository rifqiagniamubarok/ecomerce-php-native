<?php

namespace Bobakuy\Controller;

use Bobakuy\Config\Database;
use Bobakuy\Domain\KeranjangItem;
use Bobakuy\Exception\ValidationException;
use Bobakuy\Model\TambahKeranjangRequest;
use Bobakuy\Model\TambahKeranjangResponse;
use Bobakuy\Repository\KeranjangItemRepository;

class TambahKeranjangService
{
    private KeranjangItemRepository $keranjangItemRepository;

    public function __construct(KeranjangItemRepository $keranjangItemRepository)
    {
        $this->keranjangItemRepository = $keranjangItemRepository;
    }

    public function tambahkanKeranjang(TambahKeranjangRequest $request)
    {
        try {
            Database::beginTransaction();


            $item = new KeranjangItem();
            $item->user_id = $request->user_id;
            $item->menu_id = $request->menu_id;
            $item->nama_menu = $request->nama_menu;
            $item->jumlah = $request->jumlah;
            $item->harga = $request->harga;
            $item->total_harga = $request->total_harga;

            $this->keranjangItemRepository->save($item);

            $response = new TambahKeranjangResponse();
            $response->keranjangItem = $item;


            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
}
