<div class="container col-xl-10 col-xxl-8 px-4 py-5">

    <?php if (isset($model['error'])) { ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?>
            </div>
        </div>
    <?php } ?>

    <div class="w-screen h-screen flex justify-center items-center">
        <div class="border border-blue-600 p-4 rounded-md">
            <div>
                <form class="space-y-4" method="post" action="/admin/login">
                    <p class="text-xl font-semibold">Masuk sebagai admin</p>
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