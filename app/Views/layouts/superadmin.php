<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/favicon.png') ?>" />

    <!-- Core Css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>" />

    <title>Super Admin - E-asfarm</title>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="<?= base_url('assets/images/logos/favicon.png') ?>" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        
        <!-- Sidebar Start -->
        <?php include('asset/superadmin-left-sidebar.php') ?>
        <!--  Sidebar End -->

        <!-- Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php include('asset/admin-header.php') ?>
            <!--  Header End -->

            <!-- Content -->
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <!-- Import Js Files -->
    <script src="<?= base_url('assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sidebarmenu.js') ?>"></script>
    <script src="<?= base_url('assets/js/app.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.js') ?>"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>