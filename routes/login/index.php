<?php

$page_title = 'Login';

require(ROUTES_PATH . '/header.php');


?>

<div class="container mt-4">

<div class="card mx-auto login-form">

    <div class="card-body">


    <h3 class="card-title mb-3">Log in</h3>

    <?= render_flashes(); ?>

        <form action="<?= e_attr(uri('/login/action')); ?>" method="POST">
            <?= render_csrf_input(); ?>

            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="bruce@wayne-industries.com" required value="<?= e_attr(old('email')) ?>">
            </div>
            <!-- /.form-group mb-3 -->

            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" minlength="6" class="form-control" id="password" name="password" required>
            </div>
            <!-- /.form-group mb-3 -->


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>


        <p class="mt-4">Don't have an account? <a href="<?= e_attr(uri('register')); ?>">Register</a> here.</p>
    </div>
    <!-- /.card-body -->
</div>

</div>


<?php

require(ROUTES_PATH . '/footer.php');

// Reset form and flash
clear_old();
clear_flash();
?>
