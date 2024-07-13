<div class="container col-xl-10 col-xxl-8 px-4 py-5">

    <?php if (isset($model['error'])) { ?>
        <div class="row">
            <div class="alert alert-danger" role="alert">
                <?= $model['error'] ?>
            </div>
        </div>
    <?php } ?>

    <div class="row align-items-center g-lg-5 py-5">

        <div class="col-md-10 mx-auto col-lg-5">
            <form class="p-4 p-md-5 border rounded-3 bg-light" method="post" action="/users/login">
                <div class="form-floating mb-3">
                    <input name="username" type="text" class="form-control" id="username" placeholder="usernmae" value="<?= $_POST['username'] ?? '' ?>">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="password" type="password" class="form-control" id="password" placeholder="password">
                    <label for="password">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Masuk sebagai admin</button>
            </form>
        </div>
    </div>
</div>