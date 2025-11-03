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

	<!-- text editor -->
	<link rel="stylesheet" href="<?= base_url('assets/libs/quill/dist/quill.snow.css'); ?>">

	<title>E-Asfarm Admin</title>
</head>

<body class="link-sidebar">
	<!-- Preloader -->
	<div class="preloader">
		<img src="<?= base_url('assets/images/logos/favicon.png'); ?>" alt="loader" class="lds-ripple img-fluid" />
	</div>

	<div id="main-wrapper">
		<!-- Sidebar Start -->

		<?php include('asset/admin-left-sidebar.php') ?>

		<!--  Sidebar End -->

		<div class="page-wrapper">
			<!--  Header Start -->

			<?php include('asset/admin-header.php') ?>

			<!--  Header End -->

			<!-- left sidebar with horizontal -->
			<?php include('asset/admin-left-sidebar2.php') ?>

			<!-- end left sidebar with horizontal -->

			<!-- kontent -->
			<?= $this->renderSection('content') ?>
			<!-- end kontent -->

			<button class="btn btn-danger p-3 rounded-circle d-flex align-items-center justify-content-center customizer-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
				<i class="icon ti ti-settings fs-7"></i>
			</button>


			<!-- setting -->
			<?php include('asset/admin-setting.php') ?>
			<!-- setting end -->

			<script>
				function handleColorTheme(e) {
					document.documentElement.setAttribute("data-color-theme", e);
				}
			</script>
		</div>

		<!--  Search Bar -->
		<?php include('asset/admin-search-bar.php') ?>


	</div>
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
	<script src="<?= base_url('assets/libs/fullcalendar/index.global.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/apps/calendar-init.js'); ?>"></script>
	<script src="<?= base_url('assets/js/vendor.min.js'); ?>"></script>
	<script src="<?= base_url('assets/libs/apexcharts/dist/apexcharts.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/dashboards/dashboard3.js'); ?>"></script>
	<script src="<?= base_url('assets/libs/quill/dist/quill.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/forms/quill-init.js'); ?>"></script>



</body>

</html>