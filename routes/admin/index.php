<?php

if (!is_admin()) {
    flash('danger', 'Only admins can access this page.');
    redirect('/');
}

$page_title = 'Admin Dashboard';

$db = db();
$user = get_logged_user();



require(ROUTES_PATH . '/header.php');
?>


<div class="container py-5">


<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= e_attr(uri()); ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
  </ol>
</nav>


    <h3 class="mb-3">Admin Dashboard</h3>


    <?= render_flashes(); ?>


    <div class="row row-cols-3">
        <div class="col">
            <div class="card border shadow-sm">
                <div class="card-body">
                    <a href="<?= e_attr(uri('admin/applications')); ?>" class="card-link fs-1 fw-medium mb-2">Manage Applications</a>
                    <p class="card-text fs-display-1">You can manage all submitted applications from here.</p>
                </div>
            </div>
            <!-- /.card border shadow-sm -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


</div>


<?php
require(ROUTES_PATH . '/footer.php');

// Reset form and flash
clear_old();
clear_flash();
?>

