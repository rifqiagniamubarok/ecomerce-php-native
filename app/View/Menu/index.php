<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between border-b border-slate-300 px-6 py-4 dark:border-slate-700" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#" class="text-2xl font-bold text-black dark:text-white">
        <span>Bobakuy</span>
        <!-- <img src="./your-logo.svg" alt="brand logo" class="w-10" /> -->
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 md:flex">
        <li><a href="/beranda" class="font-bold text-blue-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-blue-600 dark:hover:text-blue-600" aria-current="page">Beranda</a></li>
        <li><a href="/pembelian" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Pembelian</a></li>
        <li><a href="/logout" class="font-medium text-red-600 underline-offset-2 hover:text-red-500 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Logout</a></li>
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
        <li class="py-4"><a href="/beranda" class="w-full text-lg font-bold text-blue-700 focus:underline dark:text-blue-600" aria-current="page">Beranda</a></li>
        <li class="py-4"><a href="/pembelian" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Pembelian</a></li>
        <li class="py-4"><a href="/logout" class="w-full text-lg font-medium text-red-600 focus:underline dark:text-slate-300">Logout</a></li>
    </ul>
</nav>
<div class="container mx-auto mt-4">

    <a href="/admin/menu/buat">
        <button type="button" class="cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 px-4 py-2 text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">
            Buat menu baru
        </button>
    </a>
</div>
<div class="container mx-auto mt-4">
    <div class="grid grid-cols-5 gap-2">
        <?php if (isset($model['dataMenu']) && is_array($model['dataMenu'])) : ?>
            <?php foreach ($model['dataMenu'] as $menu) : ?>
                <?php if (is_array($menu)) : ?>
                    <article class="group flex rounded-xl max-w-sm flex-col overflow-hidden border border-slate-300 bg-slate-100 text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                        <div class="h-44 md:h-64 overflow-hidden">
                            <img src="<?= htmlspecialchars($menu['gambar']) ?>" class="object-cover transition duration-700 ease-out group-hover:scale-105" alt="<?= htmlspecialchars($menu['nama']) ?>" />
                        </div>
                        <div class="flex flex-col gap-4 p-6">
                            <h3 class="text-balance text-xl lg:text-2xl font-bold text-black dark:text-white" aria-describedby="tripDescription"><?= htmlspecialchars($menu['nama']) ?></h3>
                            <p id="tripDescription" class="text-pretty text-sm mb-2">
                                @ Rp. <?= number_format($menu['harga'], 0, ',', '.') ?>
                            </p>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Data menu tidak ditemukan.</p>
        <?php endif; ?>

    </div>
</div>