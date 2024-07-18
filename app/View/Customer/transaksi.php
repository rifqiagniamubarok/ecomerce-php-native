<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="dark bg-black flex items-center justify-between px-6 py-4" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#footer" class="text-2xl font-bold text-black dark:text-white">
        <span>Bobakuy</span>
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
<div class="md:container md:mx-auto p-2 mt-4 pb-10">
    <div class="space-y-4">
        <?php if (!empty($model['transaksi'])) : ?>
            <?php foreach ($model['transaksi'] as $item) : ?>
                <?php if (is_array($item)) : ?>
                    <article class="group rounded-xl  border border-slate-300 bg-slate-100 ">
                        <!-- body -->
                        <div class=" justify-center p-2 md:p-6 gap-1">
                            <div class="text-xs md:text-base font-medium flex items-center justify-between ">
                                <p>alamat :<?= $item['alamat'] ?></p>
                                <p><?= $item['date'] ?></p>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 items-center">
                                <div class=" flex gap-2 items-center">
                                    <p class="hidden md:flex">Status</p>
                                    <?php if ($item["status"] === 'menunggu_pembayaran') : ?>
                                        <div class="py-1 md:py-2 px-2 md:px-4 text-xs md:text-base w-fit rounded-md md:rounded-full bg-gray-200">Menunggu Pembayaran</div>
                                    <?php elseif ($item["status"] === 'diproses') : ?>
                                        <div class="py-1 md:py-2 px-2 md:px-4 text-xs md:text-base w-fit rounded-md md:rounded-full bg-yellow-600 text-white">Diproses</div>
                                    <?php elseif ($item["status"] === 'diantar') : ?>
                                        <div class="py-1 md:py-2 px-2 md:px-4 text-xs md:text-base w-fit rounded-md md:rounded-full bg-sky-600 text-white">Diantar</div>
                                    <?php elseif ($item["status"] === 'diterima') : ?>
                                        <div class="py-1 md:py-2 px-2 md:px-4 text-xs md:text-base w-fit rounded-md md:rounded-full bg-emerald-600 text-white">Diterima</div>
                                    <?php elseif ($item["status"] === 'dibatalkan') : ?>
                                        <div class="py-1 md:py-2 px-2 md:px-4 text-xs md:text-base w-fit rounded-md md:rounded-full bg-red-600 text-white">Dibatalkan</div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p class="text-balance text-xs md:text-lg text-black ">total item : <?= $item['total_jumlah'] ?></p>
                                    <p class="text-balance text-xs md:text-lg text-black ">total harga : <?= $item['total_harga'] ?></p>
                                </div>
                                <a href="/transaksiDetail/<?= $item['id'] ?>" class="w-fit font-medium text-sm md:text-base text-blue-700 underline-offset-2 hover:underline focus:underline focus:outline-none dark:text-blue-600 px-2">
                                    Detail
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2.5" aria-hidden="true" class="inline size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p class="text-center text-gray-600">Belum ada transaksi.</p>
        <?php endif; ?>
    </div>
</div>