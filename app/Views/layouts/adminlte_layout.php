<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashboard' ?> - E-Asfarm</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/E-Asfarm-Logo.png'); ?>" />
    
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- AdminLTE v3.2.0 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <?= $this->renderSection('styles') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= base_url('/') ?>" class="nav-link">Beranda</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i> <?= session()->get('username') ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header"><?= ucfirst(session()->get('role')) ?></span>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('admin/dashboard') ?>" class="dropdown-item">
                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('logout') ?>" class="dropdown-item dropdown-footer text-danger">
                        <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?= base_url('admin/dashboard') ?>" class="brand-link text-center">
            <img src="<?= base_url('assets/images/logos/E-Asfarm-Logo.png') ?>" alt="E-Asfarm" style="width: 80px; height: 80px; margin: 10px auto; display: block;">
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- 1. Dashboard -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= uri_string() == 'admin/dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <!-- 2. Monitoring Kesehatan -->
                    <li class="nav-item <?= strpos(uri_string(), 'monitoring') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(uri_string(), 'monitoring') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-heartbeat"></i>
                            <p>
                                Monitoring Kesehatan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('admin/monitoring/dashboard') ?>" class="nav-link <?= uri_string() == 'admin/monitoring/dashboard' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="nav-link <?= uri_string() == 'admin/monitoring/ibu-hamil' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ibu Hamil & Menyusui</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/monitoring/balita') ?>" class="nav-link <?= uri_string() == 'admin/monitoring/balita' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Balita & Anak</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/monitoring/remaja') ?>" class="nav-link <?= uri_string() == 'admin/monitoring/remaja' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Remaja</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/monitoring/laporan') ?>" class="nav-link <?= uri_string() == 'admin/monitoring/laporan' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Laporan Statistik</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- 3. Kelola Pengguna -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-pengguna') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-pengguna') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Kelola Pengguna</p>
                        </a>
                    </li>
                    
                    <?php if(session()->get('role') === 'superadmin'): ?>
                    <!-- 4. Kelola Admin (Superadmin Only) -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-admin') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-admin') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-user-shield"></i>
                            <p>Kelola Admin</p>
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <!-- 5. Kelola Artikel -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-artikel') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-artikel') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Kelola Artikel</p>
                        </a>
                    </li>
                    
                    <!-- 4. Kelola Tanya Jawab -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-tanya-jawab') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-tanya-jawab') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-comments"></i>
                            <p>Kelola Tanya Jawab</p>
                        </a>
                    </li>
                    
                    <!-- 5. Kelola Poster -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-poster') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-poster') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-images"></i>
                            <p>Kelola Poster</p>
                        </a>
                    </li>
                    
                    <!-- 8. Kelola Modul -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-modul') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-modul') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Kelola Modul</p>
                        </a>
                    </li>
                    
                    <!-- SUPERADMIN ONLY -->
                    <?php if(session()->get('role') === 'superadmin'): ?>
                    
                    <!-- 9. Kelola Kategori -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-kategori') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-kategori') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>Kelola Kategori</p>
                        </a>
                    </li>
                    
                    <!-- 10. Kelola Padukuhan -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-padukuhan') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-padukuhan') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-map-marked-alt"></i>
                            <p>Kelola Padukuhan</p>
                        </a>
                    </li>
                    
                    <!-- 11. Kelola Running Text -->
                    <li class="nav-item">
                        <a href="<?= base_url('admin/kelola-running-text') ?>" class="nav-link <?= strpos(uri_string(), 'kelola-running-text') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-scroll"></i>
                            <p>Kelola Running Text</p>
                        </a>
                    </li>
                    
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $title ?? 'Dashboard' ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                            <?php if(isset($breadcrumb)): ?>
                                <li class="breadcrumb-item active"><?= $breadcrumb ?></li>
                            <?php endif; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
            Developed by <strong>Aizan</strong> 
            <a href="https://github.com/aznsylm" target="_blank" class="ml-2"><i class="fab fa-github"></i></a>
            <a href="https://www.instagram.com/zansylm/" target="_blank" class="ml-1"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/6282255693035" target="_blank" class="ml-1"><i class="fab fa-whatsapp"></i></a>
        </div>
        <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url('/') ?>">E-Asfarm</a>.</strong> All rights reserved.
    </footer>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE v3.2.0 -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
