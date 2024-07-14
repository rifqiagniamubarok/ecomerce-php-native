<div class="container col-xl-10 col-xxl-8 px-4 py-5">



    <div class="w-screen h-screen flex justify-center items-center">
        <div class="border border-blue-600 p-4 rounded-md">
            <div>
                <form class="space-y-4" method="post" action="/login">
                    <p class="text-xl font-semibold">Masuk ke Bobakuy</p>
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
                    <div class="flex w-full max-w-xs flex-col gap-1 text-slate-700 dark:text-slate-300">
                        <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Username</label>
                        <input id="textInputDefault" type="text" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600" name="username" type="text" id="username" placeholder="username" value="<?= $_POST['username'] ?? '' ?>" />
                    </div>
                    <div class="flex w-full max-w-xs flex-col gap-1 text-slate-700 dark:text-slate-300">
                        <label for="textInputDefault" class="w-fit pl-0.5 text-sm">Password</label>
                        <input id="textInputDefault" class="w-full rounded-xl border border-slate-300 bg-slate-100 px-2 py-2 text-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 disabled:cursor-not-allowed disabled:opacity-75 dark:border-slate-700 dark:bg-slate-800/50 dark:focus-visible:outline-blue-600" name="password" type="password" id="password" placeholder="password" value="<?= $_POST['password'] ?? '' ?>" />
                    </div>
                    <button class="cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 px-4 py-2 text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600" type="submit">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>