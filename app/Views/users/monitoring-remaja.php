<?= $this->extend('layouts/user_layout') ?>
<?= $this->section('content') ?>

<?php if (!$hasMonitoring): ?>
<div class="alert alert-warning">
    <h5><i class="fas fa-exclamation-triangle"></i> Belum Ada Data Monitoring</h5>
    <p class="mb-0">Data monitoring kesehatan remaja Anda belum tersedia. Silakan hubungi kader kesehatan di padukuhan Anda.</p>
</div>

<div class="card">
    <div class="card-body text-center py-5">
        <i class="fas fa-user-friends fa-5x text-muted mb-3"></i>
        <h4>Monitoring Kesehatan Remaja</h4>
        <p class="text-muted">Fitur ini akan menampilkan data monitoring kesehatan remaja yang diinput oleh tenaga kesehatan.</p>
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
                <h3 class="card-title"><i class="fas fa-user"></i> Data Identitas Remaja</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger" onclick="window.location.href='<?= base_url('pengguna/monitoring-remaja/export-pdf/' . $monitoring['id']) ?>'"><i class="fas fa-file-pdf"></i> PDF</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='<?= base_url('pengguna/monitoring-remaja/export-excel/' . $monitoring['id']) ?>'"><i class="fas fa-file-excel"></i> Excel</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">Nama Lengkap</th><td>: <?= esc($identitas['nama_lengkap']) ?></td></tr>
                            <tr><th>NIK</th><td>: <?= esc($identitas['nik'] ?: '-') ?></td></tr>
                            <tr><th>Tanggal Lahir</th><td>: <?= date('d M Y', strtotime($identitas['tanggal_lahir'])) ?></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">Jenis Kelamin</th><td>: <?= $identitas['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td></tr>
                            <tr><th>Nama Wali</th><td>: <?= esc($identitas['nama_wali']) ?></td></tr>
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
                            <p class="text-muted text-center py-4">Belum ada data kunjungan</p>
                        <?php else: ?>
                            <div class="accordion" id="accordionKunjungan">
                                <?php foreach ($allKunjungan as $index => $detail): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $detail['kunjungan']['id'] ?>">
                                            <strong>Kunjungan ke-<?= $detail['kunjungan']['kunjungan_ke'] ?></strong> - <?= date('d M Y', strtotime($detail['kunjungan']['tanggal_kunjungan'])) ?>
                                            <?php if ($index === 0): ?><span class="badge badge-success">Terbaru</span><?php endif; ?>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $detail['kunjungan']['id'] ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#accordionKunjungan">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <!-- Antropometri -->
                                                <div class="col-md-6">
                                                    <h6><i class="fas fa-ruler"></i> Antropometri</h6>
                                                    <?php if ($detail['antropometri']): ?>
                                                    <table class="table table-sm">
                                                        <tr><td>Berat Badan</td><td><strong><?= $detail['antropometri']['berat_badan'] ?> kg</strong></td></tr>
                                                        <tr><td>Tinggi Badan</td><td><strong><?= $detail['antropometri']['tinggi_badan'] ?> cm</strong></td></tr>
                                                        <tr><td>Lingkar Perut</td><td><strong><?= $detail['antropometri']['lingkar_perut'] ?> cm</strong></td></tr>
                                                        <tr><td>Tekanan Darah</td><td><strong><?= $detail['antropometri']['tekanan_darah'] ?> mmHg</strong></td></tr>
                                                    </table>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Skrining Anemia -->
                                                <div class="col-md-6">
                                                    <h6><i class="fas fa-heartbeat"></i> Skrining Anemia</h6>
                                                    <?php if ($detail['anemia']): ?>
                                                        <?php $gejala = json_decode($detail['anemia']['gejala_anemia'], true) ?? []; ?>
                                                        <?php if (empty($gejala) || in_array('Tidak Ada', $gejala)): ?>
                                                            <span class="badge bg-success">Tidak ada gejala</span>
                                                        <?php else: ?>
                                                            <ul class="list-unstyled">
                                                                <?php foreach ($gejala as $g): ?>
                                                                <li>• <?= esc($g) ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Riwayat Haid (jika perempuan) -->
                                                <?php if ($identitas['jenis_kelamin'] === 'P' && $detail['haid']): ?>
                                                <div class="col-md-6">
                                                    <h6><i class="fas fa-calendar"></i> Riwayat Haid</h6>
                                                    <table class="table table-sm">
                                                        <tr><td>Sudah Menstruasi</td><td><strong><?= $detail['haid']['sudah_menstruasi'] ?></strong></td></tr>
                                                        <tr><td>Keteraturan</td><td><strong><?= $detail['haid']['keteraturan_haid'] ?></strong></td></tr>
                                                        <tr><td>Nyeri Haid</td><td><strong><?= $detail['haid']['nyeri_haid'] ?></strong></td></tr>
                                                    </table>
                                                </div>
                                                <?php endif; ?>

                                                <!-- Gaya Hidup -->
                                                <div class="col-md-6">
                                                    <h6><i class="fas fa-running"></i> Gaya Hidup & Risiko PTM</h6>
                                                    <?php if ($detail['gaya_hidup']): ?>
                                                        <?php $risiko = json_decode($detail['gaya_hidup']['risiko_ptm'], true) ?? []; ?>
                                                        <?php if (empty($risiko) || in_array('Tidak Ada', $risiko)): ?>
                                                            <span class="badge bg-success">Tidak ada perilaku berisiko</span>
                                                        <?php else: ?>
                                                            <ul class="list-unstyled">
                                                                <?php foreach ($risiko as $r): ?>
                                                                <li>• <?= esc($r) ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Suplementasi -->
                                                <div class="col-md-6">
                                                    <h6><i class="fas fa-pills"></i> Suplementasi & Gizi</h6>
                                                    <?php if ($detail['suplementasi']): ?>
                                                    <table class="table table-sm">
                                                        <tr><td>Dapat TTD</td><td><?= $detail['suplementasi']['dapat_ttd'] ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' ?></td></tr>
                                                        <tr><td>Minum TTD</td><td><?= $detail['suplementasi']['minum_ttd'] ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' ?></td></tr>
                                                        <tr><td>Kebiasaan Sarapan</td><td><strong><?= $detail['suplementasi']['kebiasaan_sarapan'] ?></strong></td></tr>
                                                    </table>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Swamedikasi -->
                                                <div class="col-md-6">
                                                    <h6><i class="fas fa-first-aid"></i> Perilaku Swamedikasi</h6>
                                                    <?php if ($detail['swamedikasi']): ?>
                                                        <?php $perilaku = json_decode($detail['swamedikasi']['perilaku_swamedikasi'], true) ?? []; ?>
                                                        <?php if (empty($perilaku)): ?>
                                                            <span class="text-muted">Tidak ada data</span>
                                                        <?php else: ?>
                                                            <ul class="list-unstyled">
                                                                <?php foreach ($perilaku as $p): ?>
                                                                <li>• <?= esc($p) ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <?php if ($detail['kunjungan']['catatan']): ?>
                                            <div class="alert alert-info mt-3">
                                                <strong>Catatan:</strong> <?= esc($detail['kunjungan']['catatan']) ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
