<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between px-6 py-4" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#footer" class="text-2xl font-bold text-black dark:text-white">
        <span>Boba<span class="text-blue-700 dark:text-blue-600">ku</span>y</span>
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 sm:flex">
        <li><a href="/menu" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Menu</a></li>
        <li><a href="/keranjang" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Keranjang</a></li>
        <li><a href="/transaksi" class="font-bold text-blue-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-blue-600 dark:hover:text-blue-600" aria-current="page">Transaksi</a></li>
        <!-- CTA Button -->
        <li><a href="/logout" class="rounded-xl bg-red-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Logout</a></li>
    </ul>
    <!-- Mobile Menu Button -->
    <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen" :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null" type="button" class="flex text-slate-700 dark:text-slate-300 sm:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    <!-- Mobile Menu -->
    <ul x-cloak x-show="mobileMenuIsOpen" x-transition:enter="transition motion-reduce:transition-none ease-out duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition motion-reduce:transition-none ease-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" id="mobileMenu" class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col divide-y divide-slate-300 rounded-b-xl border-b border-slate-300 bg-slate-100 px-6 pb-6 pt-20 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800 sm:hidden">
        <li class="py-4"><a href="/menu" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Menu</a></li>
        <li class="py-4"><a href="/keranjang" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Keranjang</a></li>
        <li class="py-4"><a href="/transaksi" class="w-full text-lg font-bold text-blue-700 focus:underline dark:text-blue-600" aria-current="page">Transaksi</a></li>
        <!-- CTA Button -->
        <li class="mt-4 w-full border-none"><a href="/logout" class="rounded-xl bg-red-700 px-4 py-2 block text-center font-medium tracking-wide text-slate-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Logout</a></li>
    </ul>
</nav>
<div class="md:container md:mx-auto mt-4 p-2 pb-10">
    <article class="group rounded-xl  border border-slate-300 bg-slate-100 md:p-4 p-2 space-y-2">
        <p class="text-xs md:text-base">
            <?= $model['transaksi']["date"] ?>
        </p>
        <?php if ($model['transaksi']["status"] === 'menunggu_pembayaran') : ?>
            <div class="p-2 md:p-4 text-sm md:text-xl bg-gray-200 text-center">Menunggu Pembayaran</div>
        <?php elseif ($model['transaksi']["status"] === 'diproses') : ?>
            <div>
                <div class="p-2 md:p-4 text-sm md:text-xl bg-yellow-600 text-white text-center">Diproses</div>
                <p class="text-xs md:text-lg text-center mt-4">Tunggu sebentar, Kami sedang menyiapkan pesanan anda</p>
            </div>
        <?php elseif ($model['transaksi']["status"] === 'diantar') : ?>
            <div>
                <div class="p-2 md:p-4 text-sm md:text-xl bg-sky-600 text-white text-center">Diantar</div>
                <p class="text-xs md:text-lg text-center mt-4">Tunggu sebentar, Kurir sedang mengantarkan pesanan anda</p>
            </div>
        <?php elseif ($model['transaksi']["status"] === 'diterima') : ?>
            <div>
                <div class="p-2 md:p-4 text-sm md:text-xl bg-emerald-600 text-white text-center">Diterima</div>
                <p class="text-xs md:text-lg text-center mt-4">Selamat menikmati minumannya</p>
            </div>
        <?php elseif ($model['transaksi']["status"] === 'dibatalkan') : ?>
            <div class="p-2 md:p-4 text-sm md:text-xl bg-red-600 text-white">Dibatalkan</div>
        <?php endif; ?>
        <p class="text-sm md:text-base"><?= $model['transaksi']["total_jumlah"] ?> item</p>
        <div class="p-4 rounded-md border border-blue-600 space-y-2">
            <?php foreach ($model['transaksi_item'] as $item) : ?>
                <?php if (is_array($item)) : ?>
                    <div>
                        <p class="text-xs md:text-sm"><?= $item['jumlah'] ?> x <?= $item['nama_menu'] ?> </p>
                        <p class="text-xs md:text-sm text-gray-400">@<?= $item['harga'] ?> </p>
                        <p class="text-sm md:text-base text-black">Rp. <?= $item['total_harga'] ?> </p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <p class="text-sm md:text-base">Total harga :</p>
        <p class="text-base md:text-xl text-blue-600">Rp. <?= $model['transaksi']["total_harga"] ?></p>
        <?php if ($model['transaksi']["status"] === 'menunggu_pembayaran') : ?>
            <form method="post" action="/bayarTransaksi/<?= $model['transaksi']['id'] ?>">
                <button type="submit" class="cursor-pointer whitespace-nowrap rounded-md bg-blue-700 px-2 md:px-4 py-1 md:py-2 text-sm md:text-xl w-full font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Bayar</button>
            </form>
        <?php endif; ?>
        <?php if ($model['transaksi']["status"] === 'diantar') : ?>
            <form method="post" action="/terimaTransaksi/<?= $model['transaksi']['id'] ?>">
                <button type="submit" class="cursor-pointer whitespace-nowrap rounded-md bg-emerald-600 px-2 md:px-4 py-1 md:py-2 text-sm md:text-xl w-full font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Terima Pesanan</button>
            </form>
        <?php endif; ?>
        <?php if ($model['transaksi']["status"] === 'menunggu_pembayaran') : ?>
            <form method="post" action="/batalkanTransaksi/<?= $model['transaksi']['id'] ?>">
                <button type="submit" class="cursor-pointer whitespace-nowrap rounded-md bg-red-700 px-2 md:px-4 py-1 md:py-2 text-sm md:text-xl w-full font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Batalkan</button>
            </form>
        <?php endif; ?>
    </article>
</div>