<?php

namespace Bobakuy\Service;

use Bobakuy\Config\Database;
use Bobakuy\Domain\Menu;
use Bobakuy\Exception\ValidationException;
use Bobakuy\Model\BuatMenuRequest;
use Bobakuy\Model\BuatMenuResponse;
use Bobakuy\Repository\MenuRepository;

class MenuService
{
    private MenuRepository $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function semuaMenu()
    {
        Database::beginTransaction();
        try {
            $response = $this->menuRepository->findAll();

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }
    public function temukanMenu($id)
    {
        Database::beginTransaction();
        try {
            $response = $this->menuRepository->findById($id);

            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    public function buatMenu(BuatMenuRequest $request): BuatMenuResponse
    {
        $this->validateBuatMenuRequest($request);

        try {
            Database::beginTransaction();
            $menu = $this->menuRepository->findByName($request->nama);
            if ($menu != null) {
                throw new ValidationException("Nama telah digunakan");
            }

            $menu = new Menu();
            $menu->nama = $request->nama;
            $menu->gambar = $request->gambar;
            $menu->harga = $request->harga;

            $this->menuRepository->save($menu);

            $response = new BuatMenuResponse();
            $response->menu = $menu;


            Database::commitTransaction();
            return $response;
        } catch (\Exception $exception) {
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateBuatMenuRequest(BuatMenuRequest $request)
    {
        if (
            $request->nama == null || $request->gambar == null || $request->harga == null || trim($request->nama) == "" || trim($request->gambar) == "" || trim($request->harga) == ""
        ) {
            throw new ValidationException("Nama, gambar, harga tidak boleh kosong");
        }
    }
}
