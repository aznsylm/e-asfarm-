<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Selamat Datang, <?= esc(session()->get('username')) ?>!</h2>
            <p class="text-muted">Dashboard <?= session()->get('role') === 'superadmin' ? 'Super Admin' : 'Admin' ?> E-Asfarm</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <i class="ti ti-users" style="font-size: 3rem; color: #667eea;"></i>
                    <h3 class="mt-3"><?= $stats['total_users'] ?></h3>
                    <p class="text-muted mb-0">Total Pengguna</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <i class="ti ti-file-text" style="font-size: 3rem; color: #28a745;"></i>
                    <h3 class="mt-3"><?= $stats['total_articles'] ?></h3>
                    <p class="text-muted mb-0">Total Artikel</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <i class="ti ti-heart-rate-monitor" style="font-size: 3rem; color: #ffc107;"></i>
                    <h3 class="mt-3"><?= $stats['total_monitoring'] ?></h3>
                    <p class="text-muted mb-0">Data Monitoring</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body text-center">
                    <i class="ti ti-map-pin" style="font-size: 3rem; color: #17a2b8;"></i>
                    <h3 class="mt-3"><?= $stats['total_padukuhan'] ?></h3>
                    <p class="text-muted mb-0">Padukuhan</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5><i class="ti ti-info-circle"></i> Informasi Sistem</h5>
                </div>
                <div class="card-body">
                    <h6 class="text-primary">Fitur Utama E-Asfarm:</h6>
                    <ul>
                        <li><strong>Kelola Pengguna:</strong> Manajemen data pengguna dan admin</li>
                        <li><strong>Kelola Artikel:</strong> Publikasi artikel kesehatan (Farmasi, Gizi, Kebidanan)</li>
                        <li><strong>Kelola FAQ:</strong> Tanya jawab seputar kesehatan</li>
                        <li><strong>Kelola Unduhan:</strong> Dokumen dan materi edukasi</li>
                        <li><strong>Monitoring Kesehatan:</strong> Sistem monitoring ibu hamil, balita, dan remaja</li>
                        <li><strong>Laporan Statistik:</strong> Analisis data kesehatan per kategori</li>
                        <li><strong>Multi-Padukuhan:</strong> Isolasi data berdasarkan wilayah</li>
                    </ul>

                    <h6 class="text-primary mt-4">Informasi Penting:</h6>
                    <div class="alert alert-info">
                        <i class="ti ti-alert-circle"></i> 
                        <?php if(session()->get('role') === 'admin'): ?>
                            Anda login sebagai <strong>Admin</strong> dengan akses terbatas pada Padukuhan: <strong><?= esc($padukuhan_name) ?></strong>
                        <?php else: ?>
                            Anda login sebagai <strong>Super Admin</strong> dengan akses penuh ke semua fitur dan data
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="ti ti-link"></i> Navigasi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('admin/kelola-pengguna') ?>" class="btn btn-outline-primary">
                            <i class="ti ti-users"></i> Kelola Pengguna
                        </a>
                        <?php if(session()->get('role') === 'superadmin'): ?>
                        <a href="<?= base_url('admin/kelola-admin') ?>" class="btn btn-outline-warning">
                            <i class="ti ti-user-shield"></i> Kelola Admin
                        </a>
                        <?php endif; ?>
                        <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="btn btn-outline-success">
                            <i class="ti ti-heart-rate-monitor"></i> Monitoring Ibu Hamil
                        </a>
                        <a href="<?= base_url('admin/laporan/ibu-hamil') ?>" class="btn btn-outline-info">
                            <i class="ti ti-chart-bar"></i> Laporan Statistik
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5><i class="ti ti-bell"></i> Notifikasi</h5>
                </div>
                <div class="card-body">
                    <?php if($stats['pending_articles'] > 0): ?>
                    <div class="alert alert-warning mb-2">
                        <i class="ti ti-alert-triangle"></i> 
                        <strong><?= $stats['pending_articles'] ?></strong> artikel menunggu persetujuan
                    </div>
                    <?php else: ?>
                    <p class="text-muted mb-0">Tidak ada notifikasi baru</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
