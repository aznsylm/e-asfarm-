<?= $this->extend('layouts/user_layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-12">
        <div class="card" style="background-color: #047d78; color: white;">
            <div class="card-body p-4">
                <h2 class="mb-2">Selamat Datang, <?= esc($user->username) ?>!</h2>
                <p class="mb-0">Pantau kesehatan Anda dan keluarga melalui E-Asfarm</p>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($alerts)): ?>
<div class="row">
    <div class="col-12">
        <?php foreach ($alerts as $alert): ?>
        <div class="alert alert-<?= $alert['type'] ?> alert-dismissible fade show">
            <strong><i class="fas fa-<?= $alert['icon'] ?>"></i> Perhatian!</strong> <?= $alert['message'] ?>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="small-box <?= $hasIbuHamil ? 'bg-info' : 'bg-secondary' ?>">
            <div class="inner">
                <h3><?= $hasIbuHamil ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' ?></h3>
                <p>Ibu Hamil & Menyusui</p>
            </div>
            <div class="icon"><i class="fas fa-baby"></i></div>
            <?php if ($hasIbuHamil): ?>
            <a href="<?= base_url('pengguna/monitoring') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="small-box <?= $hasBalita ? 'bg-success' : 'bg-secondary' ?>">
            <div class="inner">
                <h3><?= $hasBalita ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' ?></h3>
                <p>Balita & Anak</p>
            </div>
            <div class="icon"><i class="fas fa-child"></i></div>
            <?php if ($hasBalita): ?>
            <a href="<?= base_url('pengguna/monitoring-balita') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-12 mb-3">
        <div class="small-box <?= $hasRemaja ? 'bg-warning' : 'bg-secondary' ?>">
            <div class="inner">
                <h3><?= $hasRemaja ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>' ?></h3>
                <p>Remaja</p>
            </div>
            <div class="icon"><i class="fas fa-user-friends"></i></div>
            <?php if ($hasRemaja): ?>
            <a href="<?= base_url('pengguna/monitoring-remaja') ?>" class="small-box-footer">Lihat Detail <i class="fas fa-arrow-circle-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if ($lastVisit): ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background-color: #047d78; color: white;">
                <h3 class="card-title"><i class="fas fa-calendar-check"></i> Kunjungan Terakhir</h3>
            </div>
            <div class="card-body">
                <p class="mb-0"><strong>Tanggal:</strong> <?= date('d F Y', strtotime($lastVisit)) ?></p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-6 col-12 mb-3">
        <div class="card">
            <div class="card-header" style="background-color: #047d78; color: white;">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi Kesehatan</h3>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="fas fa-check-circle text-success"></i> Lakukan pemeriksaan rutin sesuai jadwal</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success"></i> Konsumsi suplemen sesuai anjuran tenaga kesehatan</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success"></i> Jaga pola makan bergizi seimbang</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success"></i> Istirahat cukup dan kelola stres</li>
                    <li class="mb-0"><i class="fas fa-check-circle text-success"></i> Segera hubungi tenaga kesehatan jika ada keluhan</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php if (!$hasIbuHamil && !$hasBalita && !$hasRemaja): ?>
<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <h5><i class="fas fa-info-circle"></i> Belum Ada Data Monitoring</h5>
            <p class="mb-0">Data monitoring kesehatan Anda belum diinput oleh tenaga kesehatan. Silakan hubungi admin padukuhan atau tenaga kesehatan di wilayah Anda untuk memulai monitoring kesehatan.</p>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>