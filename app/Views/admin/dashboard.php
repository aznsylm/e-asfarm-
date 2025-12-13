<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-line mr-2"></i>Selamat Datang di Dashboard E-Asfarm</h3>
            </div>
            <div class="card-body">
                <p class="mb-0">Gunakan menu di sidebar untuk mengelola konten website E-Asfarm.</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <h5><i class="fas fa-heartbeat mr-2"></i>Monitoring Kesehatan</h5>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalIbuHamil ?? 0 ?></h3>
                <p>Ibu Hamil & Menyusui</p>
            </div>
            <div class="icon">
                <i class="fas fa-female"></i>
            </div>
            <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $totalBalita ?? 0 ?></h3>
                <p>Balita & Anak</p>
            </div>
            <div class="icon">
                <i class="fas fa-baby"></i>
            </div>
            <a href="<?= base_url('admin/monitoring/balita') ?>" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $totalRemaja ?? 0 ?></h3>
                <p>Remaja</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-friends"></i>
            </div>
            <a href="<?= base_url('admin/monitoring/remaja') ?>" class="small-box-footer">Lihat Data <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <h5><i class="fas fa-folder mr-2"></i>Manajemen Konten</h5>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $totalArtikel ?? 0 ?></h3>
                <p>Total Artikel</p>
            </div>
            <div class="icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <a href="<?= base_url('admin/kelola-artikel') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?= $totalFaq ?? 0 ?></h3>
                <p>Total Tanya Jawab</p>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
            <a href="<?= base_url('admin/kelola-tanya-jawab') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $totalPoster ?? 0 ?></h3>
                <p>Total Poster</p>
            </div>
            <div class="icon">
                <i class="fas fa-images"></i>
            </div>
            <a href="<?= base_url('admin/kelola-poster') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-dark">
            <div class="inner">
                <h3><?= $totalModul ?? 0 ?></h3>
                <p>Total Modul</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="<?= base_url('admin/kelola-modul') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <h5><i class="fas fa-users mr-2"></i>Manajemen Pengguna</h5>
    </div>
    <?php if (($userRole ?? 'admin') === 'superadmin'): ?>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-teal">
            <div class="inner">
                <h3><?= $totalPengguna ?? 0 ?></h3>
                <p>Total Pengguna</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="<?= base_url('admin/kelola-pengguna') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-indigo">
            <div class="inner">
                <h3><?= $totalAdmin ?? 0 ?></h3>
                <p>Total Admin</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
            <a href="<?= base_url('admin/kelola-admin') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <?php else: ?>
    <div class="col-lg-4 col-6">
        <div class="small-box bg-teal">
            <div class="inner">
                <h3><?= $totalPengguna ?? 0 ?></h3>
                <p>Total Pengguna (Padukuhan Anda)</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="<?= base_url('admin/kelola-pengguna') ?>" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
