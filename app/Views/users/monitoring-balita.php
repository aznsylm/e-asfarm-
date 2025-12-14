<?= $this->extend('layouts/user_layout') ?>
<?= $this->section('content') ?>

<?php if (!$hasMonitoring): ?>
<div class="alert alert-warning">
    <h5><i class="fas fa-exclamation-triangle"></i> Belum Ada Data Monitoring</h5>
    <p class="mb-0">Data monitoring kesehatan balita dan anak Anda belum tersedia. Silakan hubungi kader kesehatan di padukuhan Anda.</p>
</div>

<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-baby fa-5x text-muted mb-3"></i>
        <h4>Monitoring Balita & Anak</h4>
        <p class="text-muted">Fitur ini akan menampilkan data monitoring kesehatan balita dan anak yang diinput oleh tenaga kesehatan.</p>
        <a href="<?= base_url('pengguna/dashboard') ?>" class="btn btn-primary mt-3">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</div>
<?php else: ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-baby"></i> Data Identitas Balita & Anak</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger" onclick="window.location.href='<?= base_url('pengguna/monitoring-balita/export-pdf/' . $monitoring['id']) ?>'"><i class="fas fa-file-pdf"></i> PDF</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='<?= base_url('pengguna/monitoring-balita/export-excel/' . $monitoring['id']) ?>'"><i class="fas fa-file-excel"></i> Excel</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">Nama Anak</th><td>: <?= esc($identitas['nama_anak']) ?></td></tr>
                            <tr><th>Tanggal Lahir</th><td>: <?= date('d M Y', strtotime($identitas['tanggal_lahir'])) ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">Nama Wali</th><td>: <?= esc($identitas['nama_wali']) ?></td></tr>
                            <tr><th>No. HP Wali</th><td>: <?= esc($identitas['no_hp_wali']) ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalKunjungan ?></h3>
                <p>Total Kunjungan Pemeriksaan</p>
            </div>
            <div class="icon"><i class="fas fa-clipboard-list"></i></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" style="background:#047d78;color:#fff;">
        <h3 class="card-title"><i class="fas fa-history"></i> Riwayat Kunjungan (<?= $totalKunjungan ?> Kunjungan)</h3>
    </div>
    <div class="card-body">
        <?php if (empty($allKunjungan)): ?>
            <p class="text-muted text-center mb-0">Belum ada data kunjungan</p>
        <?php else: ?>
            <div class="accordion" id="accordionKunjungan">
                <?php foreach ($allKunjungan as $index => $detail): ?>
                <div class="card">
                    <div class="card-header" id="heading<?= $detail['kunjungan']['id'] ?>">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $detail['kunjungan']['id'] ?>">
                                <strong>Kunjungan ke-<?= $detail['kunjungan']['kunjungan_ke'] ?></strong> - <?= date('d M Y', strtotime($detail['kunjungan']['tanggal_kunjungan'])) ?>
                                <?php if ($index === 0): ?><span class="badge badge-success">Terbaru</span><?php endif; ?>
                            </button>
                        </h2>
                    </div>
                    <div id="collapse<?= $detail['kunjungan']['id'] ?>" class="collapse <?= $index === 0 ? 'show' : '' ?>" data-parent="#accordionKunjungan">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6><i class="fas fa-ruler"></i> Antropometri</h6>
                                    <?php if ($detail['antropometri']): ?>
                                    <table class="table table-sm">
                                        <tr><td>Berat Badan</td><td><strong><?= $detail['antropometri']['berat_badan'] ?> kg</strong></td></tr>
                                        <tr><td>Tinggi Badan</td><td><strong><?= $detail['antropometri']['tinggi_badan'] ?> cm</strong></td></tr>
                                        <tr><td>Lingkar Kepala</td><td><strong><?= $detail['antropometri']['lingkar_kepala'] ?> cm</strong></td></tr>
                                    </table>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <h6><i class="fas fa-exclamation-circle"></i> Keluhan</h6>
                                    <?php if ($detail['keluhan']): ?>
                                        <?php 
                                        $keluhanList = [];
                                        if ($detail['keluhan']['batuk']) $keluhanList[] = 'Batuk';
                                        if ($detail['keluhan']['pilek']) $keluhanList[] = 'Pilek';
                                        if ($detail['keluhan']['demam']) $keluhanList[] = 'Demam';
                                        if ($detail['keluhan']['diare']) $keluhanList[] = 'Diare';
                                        if ($detail['keluhan']['sembelit']) $keluhanList[] = 'Sembelit';
                                        if ($detail['keluhan']['gtm']) $keluhanList[] = 'GTM (Gerakan Tutup Mulut)';
                                        if (!empty($detail['keluhan']['lainnya'])) $keluhanList[] = $detail['keluhan']['lainnya'];
                                        ?>
                                        <?php if (empty($keluhanList)): ?>
                                            <p class="text-success mb-0">Tidak ada keluhan</p>
                                        <?php else: ?>
                                            <ul class="mb-0">
                                                <?php foreach ($keluhanList as $k): ?>
                                                <li><?= esc($k) ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">-</p>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <h6><i class="fas fa-syringe"></i> Imunisasi</h6>
                                    <?php if ($detail['imunisasi']): ?>
                                    <table class="table table-sm">
                                        <tr><td>Status</td><td><?= $detail['imunisasi']['status_imunisasi'] == 'lengkap' ? '<span class="badge badge-success">Lengkap</span>' : '<span class="badge badge-warning">Belum Lengkap</span>' ?></td></tr>
                                    </table>
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-6">
                                    <h6><i class="fas fa-utensils"></i> Gizi & Suplementasi</h6>
                                    <?php if ($detail['gizi']): ?>
                                    <table class="table table-sm">
                                        <tr><td>Vitamin A</td><td><?= $detail['gizi']['vitamin_a'] ? '<span class="badge badge-success">Sudah</span>' : '<span class="badge badge-secondary">Belum</span>' ?></td></tr>
                                        <tr><td>Obat Cacing</td><td><?= $detail['gizi']['obat_cacing'] ? '<span class="badge badge-success">Sudah</span>' : '<span class="badge badge-secondary">Belum</span>' ?></td></tr>
                                        <tr><td>Pola Makan</td><td><strong><?= esc($detail['gizi']['pola_makan'] ?: '-') ?></strong></td></tr>
                                    </table>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">-</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="alert alert-info">
    <h5><i class="fas fa-info-circle"></i> Catatan Penting</h5>
    <ul class="mb-0">
        <li>Pemeriksaan rutin sangat penting untuk tumbuh kembang anak</li>
        <li>Pastikan imunisasi lengkap sesuai jadwal</li>
        <li>Perhatikan pola makan dan nutrisi anak</li>
        <li>Segera hubungi tenaga kesehatan jika ada keluhan</li>
    </ul>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
