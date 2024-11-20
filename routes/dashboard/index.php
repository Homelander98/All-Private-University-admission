<?php

// Check if the user is logged in
if (!is_logged()) {
    flash('warning', 'Please login first to access dashboard.');
    redirect('login');
}


$page_title = 'Student Dashboard';

$db = db();
$user = get_logged_user();



$applications = $db->select()->from('applications')->where('user_id', '=', $user['id'])->execute()->fetchAll();




require(ROUTES_PATH . '/header.php');
?>

<!-- Bootstrap Dashboard Content -->
<div class="container py-5">



    <?= render_flashes(); ?>


    <h2 class="mb-2">Dashboard</h2>
    <p class="text-muted mb-4">This is where you can manage your profile, applications, and more.</p>

    <div class="row row-cols-sm-3 mb-4">

    <div class="col">

    <div class="card shadow-sm border">
        <div class="card-body">
            <h3 class="h5 mb-1"><?= e($user['name']); ?></h3>
            <span class="card-text"><?= e($user['email']); ?></span>
        </div>
    </div>
    </div>
    <!-- ./col -->


    <div class="col">

    <div class="card shadow-sm border">
        <div class="card-body">
            <h3 class="h5 mb-1">Applications</h3>
            <span class="card-text"><?= count($applications) ?></span>
        </div>
    </div>
    </div>
    <!-- ./col -->

    </div>





    <h3 class="mb-3">My Applications</h3>

    <?php if (empty($applications)) : ?>
        No applications submitted yet. You can <a href="<?= e_attr(uri('apply')); ?>">Apply here</a>.
    <?php else : ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">University</th>
      <th scope="col">Department</th>
      <th scope="col">Submitted</th>
      <th scope="col">Status</th>
    </tr>
  </thead>

  <tbody>


        <?php foreach ($applications as $application) : ?>
            <tr>
                <td>
                    <?= e($application['name']); ?>
                </td>

                <td>
                    <?= e(get_uni_name($application['university'])); ?>
                </td>

                <td>
                    <?= e(get_dept_name($application['department'])); ?>
                </td>
                <td>
                    <?= date('d/m/Y h:i A', $application['created_at']); ?>
                </td>

                <td>
                    <?php if ($application['status'] === 0) : ?>
                        <span class="badge text-bg-warning bg-warning">PENDING</span>

                    <?php elseif ($application['status'] === 1) : ?>
                        <span class="badge text-bg-success bg-success">APPROVED</span>
                        <?php else: ?>
                        <span class="badge text-bg-danger bg-danger">REJECTED</span>
                    <?php endif; ?>
                </td>
            </tr>


        <?php endforeach; ?>

        </tbody>

</table>


    <?php endif; ?>


</div>

<?php
require(ROUTES_PATH . '/footer.php');

// Reset form and flash
clear_old();
clear_flash();
?>
