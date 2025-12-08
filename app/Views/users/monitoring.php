<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Monitoring Kesehatan Saya</h2>
            <p class="text-muted">Data kesehatan yang diinput oleh tenaga kesehatan</p>
        </div>
    </div>

    <?php if (!$hasMonitoring): ?>
    <!-- Belum Ada Data Monitoring -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-warning">
                <div class="card-body text-center py-5">
                    <i class="ti ti-alert-circle text-warning" style="font-size: 4rem;"></i>
                    <h4 class="mt-3">Belum Ada Data Monitoring</h4>
                    <p class="text-muted">Data monitoring kesehatan Anda belum diinput oleh tenaga kesehatan.</p>
                    <p class="text-muted">Silakan hubungi bidan atau petugas kesehatan di padukuhan Anda untuk memulai monitoring kesehatan.</p>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>

    <!-- Ringkasan Status -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Usia Kehamilan</h6>
                    <h3 class="text-primary"><?= esc($identitas['usia_kehamilan'] ?? '-') ?> Bulan</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Berat Badan</h6>
                    <h3 class="text-primary"><?= esc($kunjunganTerakhir['antropometri']['berat_badan'] ?? '-') ?> kg</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Tekanan Darah</h6>
                    <h3 class="text-primary"><?= esc($kunjunganTerakhir['antropometri']['tekanan_darah'] ?? '-') ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">LILA</h6>
                    <h3 class="text-primary"><?= esc($kunjunganTerakhir['antropometri']['lila'] ?? '-') ?> cm</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Identitas -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-user"></i> Data Identitas</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Nama Ibu</strong></td>
                            <td>: <?= esc($identitas['nama_ibu'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nama Suami</strong></td>
                            <td>: <?= esc($identitas['nama_suami'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td><strong>Usia Ibu</strong></td>
                            <td>: <?= esc($identitas['usia_ibu'] ?? '-') ?> tahun</td>
                        </tr>
                        <tr>
                            <td><strong>Usia Suami</strong></td>
                            <td>: <?= esc($identitas['usia_suami'] ?? '-') ?> tahun</td>
                        </tr>
                        <tr>
                            <td><strong>No. Telepon</strong></td>
                            <td>: <?= esc($identitas['nomor_telepon'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>: <?= esc($identitas['alamat'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-calendar"></i> Rencana Persalinan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="50%"><strong>Usia Kehamilan</strong></td>
                            <td>: <?= esc($identitas['usia_kehamilan'] ?? '-') ?> bulan</td>
                        </tr>
                        <tr>
                            <td><strong>Rencana Tanggal Persalinan</strong></td>
                            <td>: <?= !empty($identitas['rencana_tanggal_persalinan']) ? date('d F Y', strtotime($identitas['rencana_tanggal_persalinan'])) : '-' ?></td>
                        </tr>
                        <tr>
                            <td><strong>Tempat Persalinan</strong></td>
                            <td>: <?= esc($skrining['tempat_persalinan'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <td><strong>Penolong Persalinan</strong></td>
                            <td>: <?= esc($skrining['penolong_persalinan'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Antropometri -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-chart-line"></i> Data Antropometri (Pemeriksaan Terakhir)</h5>
                </div>
                <div class="card-body">
                    <?php if ($kunjunganTerakhir): ?>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Tanggal Pemeriksaan</h6>
                                <h4><?= date('d M Y', strtotime($kunjunganTerakhir['kunjungan']['tanggal_kunjungan'])) ?></h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Tekanan Darah</h6>
                                <h4 class="text-primary"><?= esc($kunjunganTerakhir['antropometri']['tekanan_darah'] ?? '-') ?> mmHg</h4>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Berat Badan</h6>
                                <h4 class="text-primary"><?= esc($kunjunganTerakhir['antropometri']['berat_badan'] ?? '-') ?> kg</h4>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Tinggi Badan</h6>
                                <h4><?= esc($kunjunganTerakhir['antropometri']['tinggi_badan'] ?? '-') ?> cm</h4>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">LILA</h6>
                                <h4 class="text-primary"><?= esc($kunjunganTerakhir['antropometri']['lila'] ?? '-') ?> cm</h4>
                                <?php 
                                $lila = $kunjunganTerakhir['antropometri']['lila'] ?? 0;
                                if ($lila < 23.5): ?>
                                    <small class="text-danger">Perlu Perhatian</small>
                                <?php else: ?>
                                    <small class="text-success">Normal</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <p class="text-muted text-center">Belum ada data pemeriksaan</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Keluhan & Riwayat Penyakit -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-alert-circle"></i> Keluhan</h5>
                </div>
                <div class="card-body">
                    <?php if ($kunjunganTerakhir && !empty($kunjunganTerakhir['keluhan']['keluhan_array'])): ?>
                        <ul class="list-unstyled">
                            <?php foreach ($kunjunganTerakhir['keluhan']['keluhan_array'] as $keluhan): ?>
                                <li><i class="ti ti-point-filled text-warning"></i> <?= esc($keluhan) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <ul class="list-unstyled">
                            <li><i class="ti ti-check text-success"></i> Tidak ada keluhan</li>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-file-medical"></i> Riwayat Penyakit</h5>
                </div>
                <div class="card-body">
                    <?php if ($riwayatPenyakit && !empty($riwayatPenyakit['riwayat_penyakit_array'])): ?>
                        <ul class="list-unstyled">
                            <?php foreach ($riwayatPenyakit['riwayat_penyakit_array'] as $penyakit): ?>
                                <li><i class="ti ti-point-filled text-danger"></i> <?= esc($penyakit) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="alert alert-warning mt-3 mb-0">
                            <small><i class="ti ti-info-circle"></i> Perlu pemantauan rutin untuk kondisi kesehatan</small>
                        </div>
                    <?php elseif ($riwayatPenyakit && $riwayatPenyakit['tidak_ada_riwayat']): ?>
                        <ul class="list-unstyled">
                            <li><i class="ti ti-check text-success"></i> Tidak ada riwayat penyakit</li>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted mb-0">Data belum tersedia</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Suplementasi -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-pill"></i> Suplementasi</h5>
                </div>
                <div class="card-body">
                    <?php if ($kunjunganTerakhir && $kunjunganTerakhir['suplementasi']): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Suplemen</th>
                                    <th>Status</th>
                                    <th>Jumlah</th>
                                    <th>Frekuensi</th>
                                    <th>Efek Samping</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= date('d M Y', strtotime($kunjunganTerakhir['kunjungan']['tanggal_kunjungan'])) ?></td>
                                    <td><strong><?= esc($kunjunganTerakhir['suplementasi']['nama_suplemen'] ?? '-') ?></strong></td>
                                    <td>
                                        <?php if ($kunjunganTerakhir['suplementasi']['status_pemberian'] == 'sudah_diberikan'): ?>
                                            <span class="badge bg-success">Sudah Diberikan</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">Belum Diberikan</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= esc($kunjunganTerakhir['suplementasi']['jumlah_tablet'] ?? '-') ?> tablet</td>
                                    <td><?= esc($kunjunganTerakhir['suplementasi']['frekuensi'] ?? '-') ?></td>
                                    <td>
                                        <?php if (!empty($kunjunganTerakhir['suplementasi']['efek_samping_array'])): ?>
                                            <?= implode(', ', $kunjunganTerakhir['suplementasi']['efek_samping_array']) ?>
                                        <?php else: ?>
                                            <span class="text-success">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <p class="text-muted text-center">Belum ada data suplementasi</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Etnomedisin -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-leaf"></i> Penggunaan Obat Tradisional (Etnomedisin)</h5>
                </div>
                <div class="card-body">
                    <?php if ($kunjunganTerakhir && $kunjunganTerakhir['etnomedisin']): ?>
                        <?php if ($kunjunganTerakhir['etnomedisin']['menggunakan_obat_tradisional'] == 'ya'): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Status Penggunaan</strong></td>
                                        <td>: <span class="badge bg-success">Ya, Menggunakan</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jenis Obat</strong></td>
                                        <td>: 
                                            <?php if (!empty($kunjunganTerakhir['etnomedisin']['jenis_obat_array'])): ?>
                                                <?= implode(', ', $kunjunganTerakhir['etnomedisin']['jenis_obat_array']) ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tujuan Penggunaan</strong></td>
                                        <td>: 
                                            <?php if (!empty($kunjunganTerakhir['etnomedisin']['tujuan_penggunaan_array'])): ?>
                                                <?= implode(', ', $kunjunganTerakhir['etnomedisin']['tujuan_penggunaan_array']) ?>
                                            <?php else: ?>
                                                -
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%"><strong>Edukasi Diberikan</strong></td>
                                        <td>: 
                                            <?php if ($kunjunganTerakhir['etnomedisin']['edukasi_diberikan'] == 'sudah'): ?>
                                                <span class="badge bg-success">Sudah</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Belum</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                                <div class="alert alert-info mt-3">
                                    <small><i class="ti ti-info-circle"></i> Pastikan penggunaan obat tradisional dikonsultasikan dengan tenaga kesehatan</small>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="text-center py-3">
                            <p class="text-muted mb-0"><i class="ti ti-check text-success"></i> Tidak menggunakan obat tradisional</p>
                        </div>
                        <?php endif; ?>
                    <?php else: ?>
                    <p class="text-muted text-center">Data belum tersedia</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Kunjungan Timeline -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-history"></i> Riwayat Kunjungan Pemeriksaan (<?= $totalKunjungan ?> Kunjungan)</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($allKunjungan)): ?>
                        <div class="accordion" id="accordionKunjungan">
                            <?php foreach ($allKunjungan as $index => $kunjungan): ?>
                            <div class="accordion-item mb-3 border rounded">
                                <h2 class="accordion-header" id="heading<?= $index ?>">
                                    <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>">
                                        <div class="d-flex align-items-center w-100">
                                            <span class="badge bg-primary me-3" style="font-size: 1rem;">Kunjungan Ke-<?= $kunjungan['kunjungan']['kunjungan_ke'] ?></span>
                                            <span class="text-muted"><i class="ti ti-calendar"></i> <?= date('d F Y', strtotime($kunjungan['kunjungan']['tanggal_kunjungan'])) ?></span>
                                            <?php if ($index === 0): ?>
                                                <span class="badge bg-success ms-auto me-3">Terbaru</span>
                                            <?php endif; ?>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#accordionKunjungan">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <!-- Antropometri -->
                                            <div class="col-md-6 mb-3">
                                                <div class="card border-info h-100">
                                                    <div class="card-header bg-info text-white">
                                                        <h6 class="mb-0"><i class="ti ti-ruler"></i> Data Antropometri</h6>
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
                                                                            <span class="badge bg-danger">Perlu Perhatian</span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-success">Normal</span>
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

                                            <!-- Keluhan -->
                                            <div class="col-md-6 mb-3">
                                                <div class="card border-warning h-100">
                                                    <div class="card-header bg-warning text-white">
                                                        <h6 class="mb-0"><i class="ti ti-alert-circle"></i> Keluhan & Gejala</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <?php if ($kunjungan['keluhan'] && !empty($kunjungan['keluhan']['keluhan_array'])): ?>
                                                            <ul class="list-unstyled mb-0">
                                                                <?php foreach ($kunjungan['keluhan']['keluhan_array'] as $keluhan): ?>
                                                                    <li><i class="ti ti-point-filled text-warning"></i> <?= esc($keluhan) ?></li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php else: ?>
                                                            <p class="text-success mb-0"><i class="ti ti-check"></i> Tidak ada keluhan</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Suplementasi -->
                                            <div class="col-md-6 mb-3">
                                                <div class="card border-success h-100">
                                                    <div class="card-header bg-success text-white">
                                                        <h6 class="mb-0"><i class="ti ti-pill"></i> Suplementasi</h6>
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
                                                                            <span class="badge bg-success">Sudah Diberikan</span>
                                                                        <?php else: ?>
                                                                            <span class="badge bg-warning">Belum Diberikan</span>
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

                                            <!-- Etnomedisin -->
                                            <div class="col-md-6 mb-3">
                                                <div class="card border-secondary h-100">
                                                    <div class="card-header bg-secondary text-white">
                                                        <h6 class="mb-0"><i class="ti ti-leaf"></i> Etnomedisin</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <?php if ($kunjungan['etnomedisin']): ?>
                                                            <?php if ($kunjungan['etnomedisin']['menggunakan_obat_tradisional'] == 'ya'): ?>
                                                                <table class="table table-sm table-borderless">
                                                                    <tr>
                                                                        <td width="50%"><strong>Status</strong></td>
                                                                        <td>: <span class="badge bg-success">Menggunakan</span></td>
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
                                                                                <span class="badge bg-success">Sudah</span>
                                                                            <?php else: ?>
                                                                                <span class="badge bg-warning">Belum</span>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            <?php else: ?>
                                                                <p class="text-muted mb-0"><i class="ti ti-x"></i> Tidak menggunakan obat tradisional</p>
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
        </div>
    </div>

    <!-- Catatan Penting -->
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-primary"><i class="ti ti-notes"></i> Catatan Penting</h5>
                </div>
                <div class="card-body">
                    <ul>
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
                        <li>Total kunjungan pemeriksaan: <strong><?= $totalKunjungan ?> kali</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
