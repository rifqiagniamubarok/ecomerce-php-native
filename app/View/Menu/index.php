<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between border-b border-slate-300 px-6 py-4 dark:border-slate-700" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#" class="text-2xl font-bold text-black dark:text-white">
        <span>Bobakuy Admin</span>
        <!-- <img src="./your-logo.svg" alt="brand logo" class="w-10" /> -->
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 md:flex">
        <li><a href="/admin/beranda" class="font-bold text-blue-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-blue-600 dark:hover:text-blue-600" aria-current="page">Beranda</a></li>
        <li><a href="/admin/transaksi" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-700 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-600">Transaksi</a></li>
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
        <li class="py-4"><a href="/admin/beranda" class="w-full text-lg font-bold text-blue-700 focus:underline dark:text-blue-600" aria-current="page">Beranda</a></li>
        <li class="py-4"><a href="/admin/transaksi" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Transaksi</a></li>
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
<div class="container mx-auto mt-4 p-2">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
        <?php if (isset($model['dataMenu']) && is_array($model['dataMenu'])) : ?>
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
                        <div class="p-2 md:p-4">
                            <h3 class="text-balance text-sm md:text-2xl font-bold text-black dark:text-white" aria-describedby="tripDescription"><?= htmlspecialchars($menu['nama']) ?></h3>
                            <p id="tripDescription" class="text-pretty text-xs md:text-sm mb-2">
                                @ Rp. <?= number_format($menu['harga'], 0, ',', '.') ?>
                            </p>
                            <div x-data="{modalIsOpen: false}">
                                <div class="space-y-1 md:space-y-2">
                                    <a href="/admin/menu/edit/<?= $menu['id'] ?>">
                                        <button type="button" class="cursor-pointer whitespace-nowrap rounded-md w-full bg-yellow-500 px-2 md:px-4 py-1 md:py-2 text-center text-xs md:text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Ubah</button>
                                    </a>
                                    <button @click="modalIsOpen = true" type="button" class="cursor-pointer whitespace-nowrap rounded-md w-full bg-red-700 px-2 md:px-4 py-1 md:py-2 text-center text-xs md:text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Hapus</button>
                                </div>
                                <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                                    <!-- Modal Dialog -->
                                    <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-xl border border-slate-300 bg-white text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                                        <!-- Dialog Header -->
                                        <div class="flex items-center justify-between border-b border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20">
                                            <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-black dark:text-white">Hapus menu</h3>
                                            <button @click="modalIsOpen = false" aria-label="close modal">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        <!-- Dialog Body -->
                                        <div class="px-4 py-8">
                                            <p>Yakin ingin menghapus menu ini ?</p>
                                        </div>
                                        <!-- Dialog Footer -->
                                        <div class="flex items-center justify-end p-2 bg-slate-100 border-t">
                                            <button @click="modalIsOpen = false" type="button" class="cursor-pointer whitespace-nowrap rounded-xl px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-700 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:text-slate-300 dark:focus-visible:outline-blue-600">Batal</button>
                                            <form method="post" action="/admin/menu/hapus/<?= $menu['id'] ?>"">
                                                <button @click=" modalIsOpen=false" type="submit" class="cursor-pointer whitespace-nowrap rounded-xl bg-red-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Data menu tidak ditemukan.</p>
        <?php endif; ?>

    </div>
</div>