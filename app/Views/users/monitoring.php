<?= $this->extend('layouts/user_layout') ?>
<?= $this->section('content') ?>

<?php if (!$hasMonitoring): ?>
<div class="alert alert-warning">
    <h5><i class="fas fa-exclamation-triangle"></i> Belum Ada Data Monitoring</h5>
    <p class="mb-0">Data monitoring kesehatan Anda belum diinput oleh tenaga kesehatan. Silakan hubungi bidan atau petugas kesehatan di padukuhan Anda.</p>
</div>
<?php else: ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-nurse"></i> Data Identitas Ibu Hamil & Menyusui</h3>
                <div class="card-tools">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-danger" onclick="window.location.href='<?= base_url('pengguna/monitoring/export-pdf/' . $monitoring['id']) ?>'"><i class="fas fa-file-pdf"></i> PDF</button>
                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='<?= base_url('pengguna/monitoring/export-excel/' . $monitoring['id']) ?>'"><i class="fas fa-file-excel"></i> Excel</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-3">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">Nama Ibu</th><td>: <?= esc($identitas['nama_ibu'] ?? '-') ?></td></tr>
                            <tr><th>Nama Suami</th><td>: <?= esc($identitas['nama_suami'] ?? '-') ?></td></tr>
                            <tr><th>Usia Ibu</th><td>: <?= esc($identitas['usia_ibu'] ?? '-') ?> tahun</td></tr>
                            <tr><th>Usia Suami</th><td>: <?= esc($identitas['usia_suami'] ?? '-') ?> tahun</td></tr>
                        </table>
                    </div>
                    <div class="col-lg-6 col-12 mb-3">
                        <table class="table table-sm table-borderless">
                            <tr><th width="40%">No. Telepon</th><td>: <?= esc($identitas['nomor_telepon'] ?? '-') ?></td></tr>
                            <tr><th>Alamat</th><td>: <?= esc($identitas['alamat'] ?? '-') ?></td></tr>
                            <tr><th>Usia Kehamilan</th><td>: <?= esc($identitas['usia_kehamilan'] ?? '-') ?> minggu</td></tr>
                            <tr><th>HPL</th><td>: <?= !empty($identitas['rencana_tanggal_persalinan']) ? date('d F Y', strtotime($identitas['rencana_tanggal_persalinan'])) : '-' ?></td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= esc($identitas['usia_kehamilan'] ?? '-') ?></h3>
                <p>Usia Kehamilan (minggu)</p>
            </div>
            <div class="icon"><i class="fas fa-baby"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= esc($kunjunganTerakhir['antropometri']['berat_badan'] ?? '-') ?></h3>
                <p>Berat Badan (kg)</p>
            </div>
            <div class="icon"><i class="fas fa-weight"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= esc($kunjunganTerakhir['antropometri']['tekanan_darah'] ?? '-') ?></h3>
                <p>Tekanan Darah (mmHg)</p>
            </div>
            <div class="icon"><i class="fas fa-heartbeat"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-12 mb-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= esc($kunjunganTerakhir['antropometri']['lila'] ?? '-') ?></h3>
                <p>LILA (cm)</p>
            </div>
            <div class="icon"><i class="fas fa-ruler"></i></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-12 mb-3">
        <div class="card">
            <div class="card-header" style="background:#047d78;color:#fff;">
                <h3 class="card-title"><i class="fas fa-calendar-check"></i> Rencana Persalinan</h3>
            </div>
            <div class="card-body">
                <table class="table table-sm table-borderless">
                    <tr><th width="50%">Tempat Persalinan</th><td>: <?= esc($skrining['tempat_persalinan'] ?? '-') ?></td></tr>
                    <tr><th>Penolong Persalinan</th><td>: <?= esc($skrining['penolong_persalinan'] ?? '-') ?></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12 mb-3">
        <div class="card">
            <div class="card-header" style="background:#047d78;color:#fff;">
                <h3 class="card-title"><i class="fas fa-notes-medical"></i> Riwayat Penyakit</h3>
            </div>
            <div class="card-body">
                <?php if ($riwayatPenyakit && !empty($riwayatPenyakit['riwayat_penyakit_array'])): ?>
                    <ul class="mb-0">
                        <?php foreach ($riwayatPenyakit['riwayat_penyakit_array'] as $penyakit): ?>
                            <li><?= esc($penyakit) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-success mb-0"><i class="fas fa-check-circle"></i> Tidak ada riwayat penyakit</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header" style="background:#047d78;color:#fff;">
        <h3 class="card-title"><i class="fas fa-chart-line"></i> Pemeriksaan Terakhir</h3>
        <div class="card-tools">
            <span class="badge badge-light"><?= $kunjunganTerakhir ? date('d M Y', strtotime($kunjunganTerakhir['kunjungan']['tanggal_kunjungan'])) : '-' ?></span>
        </div>
    </div>
    <div class="card-body">
        <?php if ($kunjunganTerakhir): ?>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-heartbeat"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tekanan Darah</span>
                        <span class="info-box-number"><?= esc($kunjunganTerakhir['antropometri']['tekanan_darah'] ?? '-') ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-weight"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Berat Badan</span>
                        <span class="info-box-number"><?= esc($kunjunganTerakhir['antropometri']['berat_badan'] ?? '-') ?> kg</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-ruler-vertical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Tinggi Badan</span>
                        <span class="info-box-number"><?= esc($kunjunganTerakhir['antropometri']['tinggi_badan'] ?? '-') ?> cm</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-12 mb-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-ruler"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">LILA</span>
                        <span class="info-box-number"><?= esc($kunjunganTerakhir['antropometri']['lila'] ?? '-') ?> cm</span>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <p class="text-muted text-center mb-0">Belum ada data pemeriksaan</p>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-12 mb-3">
        <div class="card">
            <div class="card-header" style="background:#047d78;color:#fff;">
                <h3 class="card-title"><i class="fas fa-exclamation-circle"></i> Keluhan Terakhir</h3>
            </div>
            <div class="card-body">
                <?php if ($kunjunganTerakhir && !empty($kunjunganTerakhir['keluhan']['keluhan_array'])): ?>
                    <ul class="mb-0">
                        <?php foreach ($kunjunganTerakhir['keluhan']['keluhan_array'] as $keluhan): ?>
                            <li><?= esc($keluhan) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-success mb-0"><i class="fas fa-check-circle"></i> Tidak ada keluhan</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-12 mb-3">
        <div class="card">
            <div class="card-header" style="background:#047d78;color:#fff;">
                <h3 class="card-title"><i class="fas fa-pills"></i> Suplementasi Terakhir</h3>
            </div>
            <div class="card-body">
                <?php if ($kunjunganTerakhir && $kunjunganTerakhir['suplementasi']): ?>
                    <table class="table table-sm table-borderless mb-0">
                        <tr><th width="40%">Nama Suplemen</th><td>: <?= esc($kunjunganTerakhir['suplementasi']['nama_suplemen'] ?? '-') ?></td></tr>
                        <tr><th>Status</th><td>: 
                            <?php if ($kunjunganTerakhir['suplementasi']['status_pemberian'] == 'sudah_diberikan'): ?>
                                <span class="badge badge-success">Sudah Diberikan</span>
                            <?php else: ?>
                                <span class="badge badge-warning">Belum Diberikan</span>
                            <?php endif; ?>
                        </td></tr>
                        <tr><th>Jumlah</th><td>: <?= esc($kunjunganTerakhir['suplementasi']['jumlah_tablet'] ?? '-') ?> tablet</td></tr>
                        <tr><th>Frekuensi</th><td>: <?= esc($kunjunganTerakhir['suplementasi']['frekuensi'] ?? '-') ?></td></tr>
                    </table>
                <?php else: ?>
                    <p class="text-muted mb-0">Belum ada data suplementasi</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>



<div class="card">
    <div class="card-header" style="background:#047d78;color:#fff;">
        <h3 class="card-title"><i class="fas fa-history"></i> Riwayat Kunjungan (<?= $totalKunjungan ?> Kunjungan)</h3>
    </div>
    <div class="card-body">
        <?php if (!empty($allKunjungan)): ?>
            <div class="accordion" id="accordionKunjungan">
                <?php foreach ($allKunjungan as $index => $kunjungan): ?>
                <div class="accordion-item mb-3 border rounded">
                    <h2 class="accordion-header" id="heading<?= $index ?>">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $index ?>">
                            <strong>Kunjungan Ke-<?= $kunjungan['kunjungan']['kunjungan_ke'] ?></strong> - <?= date('d M Y', strtotime($kunjungan['kunjungan']['tanggal_kunjungan'])) ?>
                            <?php if ($index === 0): ?><span class="badge badge-success">Terbaru</span><?php endif; ?>
                        </button>
                    </h2>
                    <div id="collapse<?= $index ?>" class="collapse <?= $index === 0 ? 'show' : '' ?>" data-parent="#accordionKunjungan">
                        <div class="accordion-body">
                            <div class="row">
                                <div class="col-lg-6 col-12 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-ruler"></i> Antropometri</h3>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($kunjungan['antropometri']): ?>
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td width="50%"><strong>Tekanan Darah</strong></td>
                                                        <td>: <?= esc($kunjungan['antropometri']['tekanan_darah']) ?> mmHg</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Berat Badan</strong></td>
                                                        <td>: <?= esc($kunjungan['antropometri']['berat_badan']) ?> kg</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Tinggi Badan</strong></td>
                                                        <td>: <?= esc($kunjungan['antropometri']['tinggi_badan']) ?> cm</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>LILA</strong></td>
                                                        <td>: <?= esc($kunjungan['antropometri']['lila']) ?> cm
                                                            <?php $lila = $kunjungan['antropometri']['lila']; ?>
                                                            <?php if ($lila < 23.5): ?>
                                                                <span class="badge badge-danger">Perlu Perhatian</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-success">Normal</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php else: ?>
                                                <p class="text-muted mb-0">Data tidak tersedia</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-exclamation-circle"></i> Keluhan</h3>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($kunjungan['keluhan'] && !empty($kunjungan['keluhan']['keluhan_array'])): ?>
                                                <ul class="list-unstyled mb-0">
                                                    <?php foreach ($kunjungan['keluhan']['keluhan_array'] as $keluhan): ?>
                                                        <li><i class="fas fa-circle text-warning" style="font-size:8px;"></i> <?= esc($keluhan) ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php else: ?>
                                                <p class="text-success mb-0"><i class="fas fa-check-circle"></i> Tidak ada keluhan</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-pills"></i> Suplementasi</h3>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($kunjungan['suplementasi']): ?>
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td width="50%"><strong>Nama Suplemen</strong></td>
                                                        <td>: <?= esc($kunjungan['suplementasi']['nama_suplemen']) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Status</strong></td>
                                                        <td>: 
                                                            <?php if ($kunjungan['suplementasi']['status_pemberian'] == 'sudah_diberikan'): ?>
                                                                <span class="badge badge-success">Sudah Diberikan</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-warning">Belum Diberikan</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Jumlah</strong></td>
                                                        <td>: <?= esc($kunjungan['suplementasi']['jumlah_tablet']) ?> tablet</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Frekuensi</strong></td>
                                                        <td>: <?= esc($kunjungan['suplementasi']['frekuensi']) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Efek Samping</strong></td>
                                                        <td>: 
                                                            <?php if (!empty($kunjungan['suplementasi']['efek_samping_array'])): ?>
                                                                <?= implode(', ', $kunjungan['suplementasi']['efek_samping_array']) ?>
                                                            <?php else: ?>
                                                                <span class="text-success">Tidak ada</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            <?php else: ?>
                                                <p class="text-muted mb-0">Data tidak tersedia</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><i class="fas fa-leaf"></i> Etnomedisin</h3>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($kunjungan['etnomedisin']): ?>
                                                <?php if ($kunjungan['etnomedisin']['menggunakan_obat_tradisional'] == 'ya'): ?>
                                                    <table class="table table-sm table-borderless">
                                                        <tr>
                                                            <td width="50%"><strong>Status</strong></td>
                                                            <td>: <span class="badge badge-success">Menggunakan</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Jenis Obat</strong></td>
                                                            <td>: 
                                                                <?php if (!empty($kunjungan['etnomedisin']['jenis_obat_array'])): ?>
                                                                    <?= implode(', ', $kunjungan['etnomedisin']['jenis_obat_array']) ?>
                                                                <?php else: ?>
                                                                    -
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Tujuan</strong></td>
                                                            <td>: 
                                                                <?php if (!empty($kunjungan['etnomedisin']['tujuan_penggunaan_array'])): ?>
                                                                    <?= implode(', ', $kunjungan['etnomedisin']['tujuan_penggunaan_array']) ?>
                                                                <?php else: ?>
                                                                    -
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Edukasi</strong></td>
                                                            <td>: 
                                                                <?php if ($kunjungan['etnomedisin']['edukasi_diberikan'] == 'sudah'): ?>
                                                                    <span class="badge badge-success">Sudah</span>
                                                                <?php else: ?>
                                                                    <span class="badge badge-warning">Belum</span>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <?php else: ?>
                                                    <p class="text-muted mb-0"><i class="fas fa-times-circle"></i> Tidak menggunakan obat tradisional</p>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <p class="text-muted mb-0">Data tidak tersedia</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted text-center mb-0">Belum ada riwayat kunjungan</p>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-info">
            <h5><i class="fas fa-info-circle"></i> Catatan Penting</h5>
            <ul class="mb-0">
                <li>Pemeriksaan rutin setiap bulan sangat dianjurkan</li>
                <li>Konsumsi suplemen sesuai anjuran tenaga kesehatan</li>
                <li>Perhatikan pola makan dan istirahat yang cukup</li>
                <li>Segera hubungi tenaga kesehatan jika ada keluhan</li>
                <?php if ($kunjunganTerakhir && isset($kunjunganTerakhir['antropometri']['lila'])): ?>
                    <?php $lila = $kunjunganTerakhir['antropometri']['lila']; ?>
                    <?php if ($lila < 23.5): ?>
                        <li class="text-danger"><strong>LILA <?= $lila ?> cm perlu perhatian khusus - konsultasikan dengan bidan/dokter</strong></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>

<?= $this->endSection() ?>
