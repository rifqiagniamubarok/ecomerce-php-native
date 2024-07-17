<div class="bg-sky-600">
    <div class="w-screen h-screen flex flex-col justify-center items-center gap-2">
        <div class="border shadow-md px-2 md:px-4 py-4 md:py-8 rounded-md w-[250px] md:w-[400px] bg-white">
            <div>
                <form class="space-y-1 md:space-y-4 w-full" method="post" action="/admin/register">
                    <p class="text-sm md:text-xl font-semibold text-center">
                        <span>Boba<span class="text-blue-700 dark:text-blue-600">ku</span>y</span>
                    </p>
                    <p class="text-sm md:text-xl font-semibold text-center">
                        Daftar admin
                    </p>
                    <?php if (isset($model['error'])) { ?>
                        <div class="">
                            <div class="relative w-full overflow-hidden rounded-xl border border-red-600 bg-white text-slate-700 dark:bg-slate-900 dark:text-slate-300" role="alert">
                                <div class="flex w-full items-center gap-2 bg-red-600/10 p-1 md:p-4">
                                    <div class="bg-red-600/15 text-red-600 rounded-full p-1" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-2">
                                        <h3 class="text-xs md:text-sm font-semibold text-red-600">Peringatan</h3>
                                        <p class="text-xs md:text-xs font-medium sm:text-sm"> <?= $model['error'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="flex w-full flex-col gap-1 text-slate-700 dark:text-slate-300">
                        <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Username</label>
                        <input name="username" type="text" id="username" placeholder="username" value="<?= $_POST['username'] ?? '' ?>" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600" />
                    </div>
                    <div class="flex w-full flex-col gap-1 text-slate-700 dark:text-slate-300">
                        <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Password</label>
                        <input name="password" type="password" id="password" placeholder="password" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600" />
                    </div>
                    <div class="flex items-center justify-end">
                        <button class="cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 px-4 py-2 text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600" type="submit">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
        <p>
            <a href="/admin/login" class="hover:text-gray-200 text-white text-xs md:text-sm">Masuk sebagai admin</a>
        </p>
    </div>
</div>