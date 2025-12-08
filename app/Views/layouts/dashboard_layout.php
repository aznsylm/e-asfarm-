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
            <header class="topbar">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="ti ti-menu-2"></i>
                </button>
                <div class="topbar-right">
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-user"></i> <?= session()->get('username') ?>
                            <span class="badge bg-primary ms-1"><?= ucfirst(session()->get('role')) ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
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
