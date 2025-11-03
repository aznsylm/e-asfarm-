<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/favicon.png'); ?>" />

  <!-- Core Css -->
  <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>" />
  <!-- <?= base_url('assets/css/styles.css'); ?> -->

  <title>MatDash Bootstrap Admin</title>
</head>

<body class="link-sidebar">
  <!-- Preloader -->
  <div class="preloader">
    <img src="<?= base_url('assets/images/logos/favicon.png'); ?>" alt="loader" class="lds-ripple img-fluid" />
  </div>

  <?= $this->renderSection('content') ?>

  <div class="dark-transparent sidebartoggler"></div>
  <!-- Import Js Files -->
  <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/theme/app.init.js'); ?>"></script>
  <script src="<?= base_url('assets/js/theme/theme.js'); ?>"></script>
  <script src="<?= base_url('assets/js/theme/app.min.js'); ?>"></script>
  <script src="<?= base_url('assets/js/theme/sidebarmenu-default.js'); ?>"></script>

  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>