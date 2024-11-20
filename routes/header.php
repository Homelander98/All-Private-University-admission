<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= html_escape($page_title ?? '') ?></title>
    <link rel="icon" href="<?= e_attr(uri('favicon.ico')) ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= html_escape(uri('assets/theme.min.css')) ?>">
    <link rel="stylesheet" href="<?= html_escape(uri('assets/styles.css')) ?>">


<script type="text/javascript" src="<?= html_escape(uri('assets/bootstrap.bundle.min.js')) ?>"></script>
<script type="text/javascript" src="<?= html_escape(uri('assets/scripts.js')) ?>"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm border-bottom">
  <div class="container">
    <a class="navbar-brand" href="<?= e_attr(uri('/')); ?>">


    <img src="<?= e_attr(uri('assets/img/BBBB.png')); ?>" alt="<?= e_attr(config('app_name')); ?>" class="navbar-logo" style="width: 150px; height: auto;">


  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">




      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


        <li class="nav-item">
          <a class="nav-link <?= e_attr(active_class('/')) ?>" aria-current="page" href="<?= e_attr(uri('/')); ?>">Home</a>
        </li>


        <li class="nav-item">
          <a class="nav-link <?= e_attr(active_class('/apply')) ?>" href="<?= e_attr(uri('/apply')); ?>">Apply</a>
        </li>

        <li class="nav-item">
          <a class="nav-link <?= e_attr(active_class('/browse')) ?>" href="<?= e_attr(uri('/browse')); ?>">Browse Programs</a>
        </li>

        </li>


        <?php if (is_admin()) : ?>

        <li class="nav-item">
          <a class="nav-link <?= e_attr(active_class('/admin')) ?>" href="<?= e_attr(uri('/admin')); ?>">Admin Dashboard</a>
          <?php endif; ?>

        <?php if (!is_logged()) : ?>
        <li class="nav-item">
          <a class="nav-link <?= e_attr(active_class('/register')) ?>" href="<?= e_attr(uri('/register')); ?>">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= e_attr(active_class('/login')) ?>" href="<?= e_attr(uri('/login')); ?>">Login</a>
        </li>


        <?php else : ?>
        <li class="nav-item">
          <a class="nav-link <?= e_attr(active_class('/dashboard')) ?>" href="<?= e_attr(uri('/dashboard')); ?>">My Dashboard</a>
        </li>

        <li class="nav-item">
          <form action="<?= e_attr(uri('/logout')) ?>" method="POST">
            <?= render_csrf_input(); ?>
            <button class="nav-link bg-transparent border-0">Logout</button>
          </form>
        </li>
          <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

