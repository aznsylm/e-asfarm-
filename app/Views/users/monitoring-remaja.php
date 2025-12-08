<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2><?= $title ?></h2>
            <p class="text-muted">Data monitoring kesehatan remaja Anda</p>
        </div>
    </div>

    <?php if (!$hasMonitoring): ?>
        <div class="row">
            <div class="col-12">
                <div class="card border-info">
                    <div class="card-body text-center py-5">
                        <i class="ti ti-clipboard-off" style="font-size: 5rem; color: #ccc;"></i>
                        <h4 class="mt-3">Belum Ada Data Monitoring Remaja</h4>
                        <p class="text-muted">Anda belum memiliki data monitoring kesehatan remaja. Silakan hubungi admin atau kader kesehatan untuk mendaftarkan monitoring.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <!-- Data Identitas -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="ti ti-user"></i> Data Identitas</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr><td><strong>Nama Lengkap</strong></td><td>: <?= esc($identitas['nama_lengkap']) ?></td></tr>
                            <tr><td><strong>NIK</strong></td><td>: <?= esc($identitas['nik'] ?: '-') ?></td></tr>
                            <tr><td><strong>Tanggal Lahir</strong></td><td>: <?= date('d M Y', strtotime($identitas['tanggal_lahir'])) ?></td></tr>
                            <tr><td><strong>Jenis Kelamin</strong></td><td>: <?= $identitas['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td></tr>
                            <tr><td><strong>Nama Wali</strong></td><td>: <?= esc($identitas['nama_wali']) ?></td></tr>
                            <tr><td><strong>No. HP Wali</strong></td><td>: <?= esc($identitas['no_hp_wali']) ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="ti ti-chart-line"></i> Ringkasan</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span>Total Kunjungan</span>
                            <h3 class="mb-0 text-info"><?= $totalKunjungan ?></h3>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Status</span>
                            <span class="badge bg-success">Aktif</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Kunjungan -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="ti ti-history"></i> Riwayat Kunjungan (<?= $totalKunjungan ?> Kunjungan)</h5>
                    </div>
                    <div class="card-body">
                        <?php if (empty($allKunjungan)): ?>
                            <p class="text-muted text-center py-4">Belum ada data kunjungan</p>
                        <?php else: ?>
                            <div class="accordion" id="accordionKunjungan">
                                <?php foreach ($allKunjungan as $index => $detail): ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button <?= $index !== 0 ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $detail['kunjungan']['id'] ?>">
                                            <strong>Kunjungan ke-<?= $detail['kunjungan']['kunjungan_ke'] ?></strong>
                                            <span class="badge bg-secondary ms-2"><?= date('d M Y', strtotime($detail['kunjungan']['tanggal_kunjungan'])) ?></span>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= $detail['kunjungan']['id'] ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#accordionKunjungan">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <!-- Antropometri -->
                                                <div class="col-md-6 mb-3">
                                                    <h6 class="text-info"><i class="ti ti-ruler"></i> Antropometri</h6>
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
                                                <div class="col-md-6 mb-3">
                                                    <h6 class="text-info"><i class="ti ti-heart-rate-monitor"></i> Skrining Anemia</h6>
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
                                                <div class="col-md-6 mb-3">
                                                    <h6 class="text-info"><i class="ti ti-calendar-event"></i> Riwayat Haid</h6>
                                                    <table class="table table-sm">
                                                        <tr><td>Sudah Menstruasi</td><td><strong><?= $detail['haid']['sudah_menstruasi'] ?></strong></td></tr>
                                                        <tr><td>Keteraturan</td><td><strong><?= $detail['haid']['keteraturan_haid'] ?></strong></td></tr>
                                                        <tr><td>Nyeri Haid</td><td><strong><?= $detail['haid']['nyeri_haid'] ?></strong></td></tr>
                                                    </table>
                                                </div>
                                                <?php endif; ?>

                                                <!-- Gaya Hidup -->
                                                <div class="col-md-6 mb-3">
                                                    <h6 class="text-info"><i class="ti ti-activity"></i> Gaya Hidup & Risiko PTM</h6>
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
                                                <div class="col-md-6 mb-3">
                                                    <h6 class="text-info"><i class="ti ti-pill"></i> Suplementasi & Gizi</h6>
                                                    <?php if ($detail['suplementasi']): ?>
                                                    <table class="table table-sm">
                                                        <tr><td>Dapat TTD</td><td><?= $detail['suplementasi']['dapat_ttd'] ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' ?></td></tr>
                                                        <tr><td>Minum TTD</td><td><?= $detail['suplementasi']['minum_ttd'] ? '<span class="badge bg-success">Ya</span>' : '<span class="badge bg-secondary">Tidak</span>' ?></td></tr>
                                                        <tr><td>Kebiasaan Sarapan</td><td><strong><?= $detail['suplementasi']['kebiasaan_sarapan'] ?></strong></td></tr>
                                                    </table>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Swamedikasi -->
                                                <div class="col-md-6 mb-3">
                                                    <h6 class="text-info"><i class="ti ti-first-aid-kit"></i> Perilaku Swamedikasi</h6>
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
