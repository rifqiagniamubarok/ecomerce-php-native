<nav x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" class="flex items-center justify-between border-b border-slate-300 px-6 py-4 dark:border-slate-700" aria-label="penguin ui menu">
    <!-- Brand Logo -->
    <a href="#" class="text-2xl font-bold text-black dark:text-white">
        <span>Bobakuy Admin</span>
    </a>
    <!-- Desktop Menu -->
    <ul class="hidden items-center gap-4 md:flex">
        <li><a href="/admin/beranda" class="font-bold text-blue-500 underline-offset-2 hover:text-blue-500 focus:outline-none focus:underline dark:text-blue-500 dark:hover:text-blue-500" aria-current="page">Beranda</a></li>
        <li><a href="/admin/transaksi" class="font-medium text-slate-700 underline-offset-2 hover:text-blue-500 focus:outline-none focus:underline dark:text-slate-300 dark:hover:text-blue-500">Transaksi</a></li>
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
        <li class="py-4"><a href="/admin/beranda" class="w-full text-lg font-bold text-blue-500 focus:underline dark:text-blue-500" aria-current="page">Beranda</a></li>
        <li class="py-4"><a href="/admin/transaksi" class="w-full text-lg font-medium text-slate-700 focus:underline dark:text-slate-300">Transaksi</a></li>
        <li class="py-4"><a href="/logout" class="w-full text-lg font-medium text-red-600 focus:underline dark:text-slate-300">Logout</a></li>
    </ul>
</nav>
<div class="container mx-auto mt-4">
    <a href="/admin/beranda">
        <button type="button" class="cursor-pointer whitespace-nowrap bg-transparent rounded-xl border border-blue-700 px-4 py-2 text-sm font-medium tracking-wide text-blue-500 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:border-blue-600 dark:text-blue-500 dark:focus-visible:outline-blue-600">
            Kembali
        </button>
    </a>

</div>
<div class="container mx-auto mt-4 p-2">
    <?php if (isset($model['error'])) { ?>
        <div class="">
            <div class="relative w-full overflow-hidden rounded-xl border border-red-600 bg-white text-slate-700 dark:bg-slate-900 dark:text-slate-300" role="alert">
                <div class="flex w-full items-center gap-2 bg-red-600/10 p-4">
                    <div class="bg-red-600/15 text-red-600 rounded-full p-1" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-2">
                        <h3 class="text-sm font-semibold text-red-600">Peringatan</h3>
                        <p class="text-xs font-medium sm:text-sm"> <?= $model['error'] ?></p>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>
    <form class="space-y-2" method="post" action="/admin/menu/edit/<?= $model['menu']['id'] ?>" enctype="multipart/form-data">
        <div class="flex w-full max-w-xs flex-col gap-1 text-slate-700 dark:text-slate-300">
            <label for="nama" class="w-fit pl-0.5 text-sm">Nama</label>
            <input id="nama" type="text" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600" name="nama" placeholder="Masukan nama" autocomplete="nama" value="<?= $model['menu']['nama'] ?>" />
        </div>
        <div class="flex w-full max-w-xs flex-col gap-1 text-slate-700 dark:text-slate-300">
            <label for="harga" class="w-fit pl-0.5 text-sm">Harga</label>
            <input id="harga" type="number" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600" name="harga" placeholder="Masukan harga" autocomplete="harga" value="<?= $model['menu']['harga'] ?>" />
        </div>
        <div class="relative flex w-full max-w-sm flex-col gap-1 text-slate-700 dark:text-slate-300">
            <label for="fileInput" class="w-fit pl-0.5 text-sm">Upload File</label>
            <input id="gambar" name="gambar" type="file" class="w-full max-w-md overflow-clip rounded-xl border border-slate-300 bg-slate-100/50 text-sm file:mr-4 file:cursor-pointer file:border-none file:bg-slate-100 file:px-4 file:py-2 file:font-medium file:text-black focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:file:bg-slate-800 dark:file:text-white dark:focus-visible:outline-blue-600" />

            <small class="pl-0.5">PNG, JPG, WebP - Max 5MB</small>
        </div>
        <button class="cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 px-4 py-2 text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600" type="submit">Simpan perubahan</button>
    </form>
</div>