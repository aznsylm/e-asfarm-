<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashboard' ?> - E-Asfarm</title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/E-Asfarm-Logo.png'); ?>" />
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
    .navbar-dark{background:#047d78!important;}
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active{background:#047d78!important;}
    .btn-primary{background:#047d78!important;border-color:#047d78!important;}
    .btn-primary:hover{background:#036663!important;border-color:#036663!important;}
    .small-box.bg-info{background:#047d78!important;}
    
    /* Mobile Responsive Styles */
    @media (max-width: 768px) {
        .content-header h1 { font-size: 1.5rem; }
        .card-title { font-size: 1rem; }
        .small-box h3 { font-size: 1.5rem; }
        .small-box p { font-size: 0.875rem; }
        .table-responsive { font-size: 0.875rem; }
        .btn { font-size: 0.875rem; padding: 0.375rem 0.75rem; }
        .alert { font-size: 0.875rem; }
        .breadcrumb { font-size: 0.75rem; }
        .card-body { padding: 1rem; }
        .modal-dialog { margin: 0.5rem; }
        .text-md-right { text-align: left !important; }
    }
    
    @media (max-width: 576px) {
        .content-header h1 { font-size: 1.25rem; }
        .card-header h3 { font-size: 0.95rem; }
        .small-box { margin-bottom: 1rem; }
        .btn-block { width: 100%; }
        img.rounded-circle { width: 120px !important; height: 120px !important; }
    }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

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
                    <span class="dropdown-item dropdown-header">Pengguna</span>
                    <div class="dropdown-divider"></div>
                    <a href="<?= base_url('pengguna/dashboard') ?>" class="dropdown-item">
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

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?= base_url('pengguna/dashboard') ?>" class="brand-link text-center" style="padding: 0.5rem; background-color: #fff;">
            <img src="<?= base_url('assets/images/logos/E-Asfarm-Logo.png') ?>" alt="E-Asfarm" style="width: 200px; height: 120px; object-fit: contain; margin: 0 auto; display: block;">
        </a>

        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="<?= base_url('pengguna/dashboard') ?>" class="nav-link <?= uri_string() == 'pengguna/dashboard' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li class="nav-item <?= strpos(uri_string(), 'pengguna/monitoring') !== false ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= strpos(uri_string(), 'pengguna/monitoring') !== false ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-heartbeat"></i>
                            <p>
                                Monitoring Kesehatan
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= base_url('pengguna/monitoring') ?>" class="nav-link <?= uri_string() == 'pengguna/monitoring' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Ibu Hamil & Menyusui</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengguna/monitoring-balita') ?>" class="nav-link <?= uri_string() == 'pengguna/monitoring-balita' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Balita & Anak</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengguna/monitoring-remaja') ?>" class="nav-link <?= uri_string() == 'pengguna/monitoring-remaja' ? 'active' : '' ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Remaja</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('pengguna/artikel-saya') ?>" class="nav-link <?= uri_string() == 'pengguna/artikel-saya' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>Artikel Saya</p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="<?= base_url('pengguna/hubungi-kami') ?>" class="nav-link <?= uri_string() == 'pengguna/hubungi-kami' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-phone-alt"></i>
                            <p>Hubungi Kami</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?= $title ?? 'Dashboard' ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= base_url('pengguna/dashboard') ?>">Dashboard</a></li>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<?= $this->renderSection('scripts') ?>
</body>
</html>
