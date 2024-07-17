<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between px-6 py-4" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#footer" class="text-2xl font-bold text-black dark:text-white">
        <span>Boba<span class="text-blue-700 dark:text-blue-600">ku</span>y</span>
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 sm:flex">
        <li><a href="/menu" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Menu</a></li>
        <li><a href="/keranjang" class="font-bold text-blue-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-blue-600 dark:hover:text-blue-600" aria-current="page">Keranjang</a></li>
        <li><a href="/transaksi" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Transaksi</a></li>
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
        <li class="py-4"><a href="/keranjang" class="w-full text-lg font-bold text-blue-700 focus:underline dark:text-blue-600" aria-current="page">Keranjang</a></li>
        <li class="py-4"><a href="/transaksi" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Transaksi</a></li>
        <!-- CTA Button -->
        <li class="mt-4 w-full border-none"><a href="/logout" class="rounded-xl bg-red-700 px-4 py-2 block text-center font-medium tracking-wide text-slate-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Logout</a></li>
    </ul>
</nav>
<div class="md:container md:mx-auto mt-4 pb-10 p-2">
    <div class="space-y-4">
        <?php if (!empty($model['keranjang'])) : ?>
            <?php foreach ($model['keranjang'] as $item) : ?>
                <?php if (is_array($item)) : ?>
                    <article class="group rounded-xl grid grid-cols-5 md:grid-cols-10 overflow-hidden border border-slate-300 bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <!-- Image -->
                        <div class="col-span-2 md:col-span-1 overflow-hidden">
                            <img src="<?= $item['gambar'] ?>" class="w-full aspect-square object-cover transition duration-700 ease-out group-hover:scale-105" alt="a men wearing VR goggles" />
                        </div>
                        <!-- Body -->
                        <div class="col-span-3 md:col-span-9 grid grid-cols-1 md:grid-cols-2 items-center px-4">
                            <div>
                                <p class="text-balance text-sm md:text-lg font-bold text-black lg:text-2xl dark:text-white"><?= $item['nama_menu'] ?></p>
                                <p class="text-gray-600 text-xs md:text-sm">@ Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                                <p class="text-blue-600 text-xs md:text-base">total Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></p>
                            </div>
                            <div class="text-xs md:text-base">
                                <div>Jumlah :</div>
                                <div class="flex gap-4 items-center">
                                    <div>
                                        <form method="post" action="/kuranginKeranjang/<?= $item['id'] ?>">
                                            <button type="submit" class="cursor-pointer whitespace-nowrap rounded-md bg-blue-700 px-2 md:px-4 md:py-2 py-1 text-xs font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">-</button>
                                        </form>
                                    </div>
                                    <div class="text-xs md:text-xl"><?= $item['jumlah'] ?></div>
                                    <div>
                                        <form method="post" action="/tambahKeranjang/<?= $item['menu_id'] ?>">
                                            <button type="submit" class="cursor-pointer whitespace-nowrap rounded-md bg-blue-700 px-2 md:px-4 md:py-2 py-1 text-xs font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">+</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
            <div class="w-full">
                <form method="post" action="/lanjutPembayaran">
                    <button type="submit" class="cursor-pointer whitespace-nowrap rounded-md bg-blue-700 px-4 py-2 text-xs md:text-xl font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600 w-full">Lanjutkan ke pembayaran</button>
                </form>
            </div>
        <?php else : ?>
            <p class="text-center text-gray-600">Keranjang Anda kosong.</p>
        <?php endif; ?>
    </div>

</div>