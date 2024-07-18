<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class=" dark bg-black  flex items-center justify-between border-b border-slate-300 px-6 py-4 dark:border-slate-700" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#" class="text-2xl font-bold text-black dark:text-white">
        <span>Bobakuy Admin</span>
        <!-- <img src="./your-logo.svg" alt="brand logo" class="w-10" /> -->
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 md:flex">
        <li><a href="/admin/beranda" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-500 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-500">Beranda</a></li>
        <li><a href="/admin/transaksi" class="font-bold text-blue-500 underline-offset-2 hover:text-blue-500 focus:outline-none focus:underline dark:text-blue-500 dark:hover:text-blue-500" aria-current="page">Transaksi</a></li>
        <li><a href="/logout" class="font-medium text-red-600 underline-offset-2 hover:text-red-500 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-red-600">Logout</a></li>
    </ul>
    <!-- Mobile Menu Button -->
    <button @click="mobileMenuIsOpen = !mobileMenuIsOpen" :aria-expanded="mobileMenuIsOpen" :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null" type="button" class="flex text-slate-700 dark:text-slate-300 md:hidden" aria-label="mobile menu" aria-controls="mobileMenu">
        <svg x-cloak x-show="!mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg x-cloak x-show="mobileMenuIsOpen" xmlns="http://www.w3.org/2000/svg" fill="none" aria-hidden="true" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>
    <!-- Mobile Menu -->
    <ul x-cloak x-show="mobileMenuIsOpen" x-transition:enter="transition motion-reduce:transition-none ease-out duration-300" x-transition:enter-start="-translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition motion-reduce:transition-none ease-out duration-300" x-transition:leave-start="translate-y-0" x-transition:leave-end="-translate-y-full" id="mobileMenu" class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col divide-y divide-slate-300 rounded-b-xl border-b border-slate-300 bg-slate-100 px-6 pb-6 pt-20 dark:divide-slate-700 dark:border-slate-700 dark:bg-slate-800 md:hidden">
        <li class="py-4"><a href="/admin/beranda" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Beranda</a></li>
        <li class="py-4"><a href="/admin/transaksi" class="w-full text-lg font-bold text-blue-500 focus:underline dark:text-blue-500" aria-current="page">Transaksi</a></li>
        <li class="py-4"><a href="/logout" class="w-full text-lg font-medium text-red-600 focus:underline dark:text-slate-300">Logout</a></li>
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
                            <div class="flex items-center justify-between">
                                <p class="text-xs md:text-base font-medium">Pembeli: <?= $item['username'] ?></p>
                                <p class="text-xs md:text-base font-medium"><?= $item['date'] ?></p>
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
                                <a href="/admin/transaksiDetail/<?= $item['id'] ?>" class="w-fit font-medium text-sm md:text-base text-blue-500 underline-offset-2 hover:underline focus:underline focus:outline-none dark:text-blue-500 px-2">
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