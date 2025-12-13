<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> - E-Asfarm</title>

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/E-Asfarm-Logo.png'); ?>" />
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tabler Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <style>
    :root{--teal:#047d78;--teal-dark:#036663;--gray:#6c757d;}
    .topbar{background:#047d78;color:#fff;padding:1rem;box-shadow:0 2px 8px rgba(0,0,0,0.1);}
    .topbar .btn-light{background:#fff;color:#047d78;border:none;}
    .topbar .btn-light:hover{background:#f8f9fa;}
    .topbar .badge{background:#036663!important;}
    .sidebar{background:#047d78;color:#fff;}
    .sidebar .nav-link{color:rgba(255,255,255,0.8);padding:0.75rem 1rem;transition:all 0.3s;}
    .sidebar .nav-link:hover,.sidebar .nav-link.active{background:rgba(255,255,255,0.1);color:#fff;}
    .sidebar .nav-link i{margin-right:0.5rem;}
    .content-area{background:#f5f5f5;min-height:calc(100vh - 60px);padding:1.5rem;}
    .card{border:none;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.08);}
    .btn-teal{background:#047d78;color:#fff;border:none;}
    .btn-teal:hover{background:#036663;color:#fff;}
    .text-teal{color:#047d78!important;}
    .bg-teal{background:#047d78!important;}
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <?php 
        $role = session()->get('role') ?? 'pengguna';
        if ($role === 'superadmin' || $role === 'admin') {
            echo view('layouts/components/sidebar_admin');
        } else {
            echo view('layouts/components/sidebar_pengguna');
        }
        ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Topbar -->
            <header class="topbar d-flex align-items-center justify-content-between">
                <button class="btn btn-light btn-sm sidebar-toggle" id="sidebarToggle">
                    <i class="ti ti-menu-2"></i>
                </button>
                <div class="topbar-right">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-user"></i> <?= session()->get('username') ?>
                            <span class="badge ms-1"><?= ucfirst(session()->get('role')) ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('/') ?>"><i class="ti ti-home"></i> Beranda</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>"><i class="ti ti-dashboard"></i> Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= base_url('logout') ?>"><i class="ti ti-logout"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Dashboard JS -->
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
    <!-- Additional Scripts -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>
