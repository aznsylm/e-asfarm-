<!DOCTYPE html>
<html>
<head>
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand">Super Admin Dashboard</span>
            <div>
                <span class="text-white me-3">Selamat datang, <?= esc($user->username) ?>!</span>
                <a href="<?= base_url('/logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <h2>Dashboard Super Admin</h2>
                <p class="text-muted">Anda memiliki akses penuh ke seluruh sistem.</p>
                
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body text-center">
                                <h4>Kelola Admin</h4>
                                <a href="<?= base_url('/superadmin/kelola-admin') ?>" class="btn btn-light btn-sm">Lihat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <h4>Kelola Pengguna</h4>
                                <a href="<?= base_url('/superadmin/kelola-pengguna') ?>" class="btn btn-light btn-sm">Lihat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <h4>Pengaturan Sistem</h4>
                                <a href="<?= base_url('/superadmin/pengaturan-sistem') ?>" class="btn btn-light btn-sm">Lihat</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <h4>Admin Panel</h4>
                                <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-light btn-sm">Akses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>