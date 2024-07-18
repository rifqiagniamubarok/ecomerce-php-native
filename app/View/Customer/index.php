<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between px-6 py-4" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#footer" class="text-2xl font-bold text-black dark:text-white">
        <span>Boba<span class="text-blue-700 dark:text-blue-600">ku</span>y</span>
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 sm:flex">
        <li><a href="/menu" class="font-bold text-blue-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-blue-600 dark:hover:text-blue-600" aria-current="page">Menu</a></li>
        <li><a href="/keranjang" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Keranjang</a></li>
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
        <li class="py-4"><a href="/menu" class="w-full text-lg font-bold text-blue-700 focus:underline dark:text-blue-600" aria-current="page">Menu</a></li>
        <li class="py-4"><a href="/keranjang" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Keranjang</a></li>
        <li class="py-4"><a href="/transaksi" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Transaksi</a></li>
        <!-- CTA Button -->
        <li class="mt-4 w-full border-none"><a href="/logout" class="rounded-xl bg-red-700 px-4 py-2 block text-center font-medium tracking-wide text-slate-100 hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Logout</a></li>
    </ul>
</nav>

<div class="md:container md:mx-auto mt-4 pb-10 p-2">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-1 md:gap-2">
        <?php foreach ($model['dataMenu'] as $menu) : ?>
            <?php if (is_array($menu)) : ?>
                <article class="group flex rounded-xl max-w-sm flex-col overflow-hidden border border-slate-300 bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                    <div class="w-full aspect-square overflow-hidden">
                        <?php
                        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
                        $host = $_SERVER['HTTP_HOST'];
                        $baseUrl = $scheme . '://' . $host;
                        ?>
                        <img src="<?= $baseUrl . htmlspecialchars($menu['gambar']) ?>" class="object-cover transition duration-700 ease-out group-hover:scale-105" alt="<?= htmlspecialchars($menu['nama']) ?>" />
                    </div>
                    <div class="flex flex-col gap-1 py-2 md:px-4 px-2">
                        <h3 class="text-balance text-lg text-sm md:text-2xl font-semibold text-black dark:text-white" aria-describedby="tripDescription"><?= htmlspecialchars($menu['nama']) ?></h3>
                        <p id="tripDescription" class="text-pretty text-xs md:text-sm mb-2">
                            Rp. <?= number_format($menu['harga'], 0, ',', '.') ?>
                        </p>
                        <form method="post" action="/tambahKeranjang/<?= $menu['id'] ?>">
                            <button class="w-full cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 md:px-4 px-2 py-1 md:py-2 text-xs md:text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed " type="submit">Tambah ke keranjang</button>
                        </form>
                    </div>
                </article>
            <?php endif; ?>
        <?php endforeach; ?>


    </div>
</div>