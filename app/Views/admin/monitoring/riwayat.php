<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Monitoring Kesehatan</h2>
                    <p class="text-muted">Pasien: <strong><?= esc($identitas['nama_ibu'] ?? 'N/A') ?></strong></p>
                </div>
                <div>
                    <a href="<?= base_url('admin/monitoring/edit-master/'.$monitoring['id']) ?>" class="btn btn-warning">
                        <i class="ti ti-edit"></i> Edit Data Master
                    </a>
                    <a href="<?= base_url('admin/monitoring/input-kunjungan/'.$monitoring['id']) ?>" class="btn btn-success">
                        <i class="ti ti-plus"></i> Tambah Kunjungan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Master -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Data Identitas</h6>
                </div>
                <div class="card-body">
                    <?php if($identitas): ?>
                    <table class="table table-sm table-borderless">
                        <tr><td><strong>Nama Ibu</strong></td><td>: <?= esc($identitas['nama_ibu']) ?></td></tr>
                        <tr><td><strong>Nama Suami</strong></td><td>: <?= esc($identitas['nama_suami']) ?></td></tr>
                        <tr><td><strong>Usia Ibu</strong></td><td>: <?= esc($identitas['usia_ibu']) ?> tahun</td></tr>
                        <tr><td><strong>No. Telepon</strong></td><td>: <?= esc($identitas['nomor_telepon']) ?></td></tr>
                        <tr><td><strong>Alamat</strong></td><td>: <?= esc($identitas['alamat']) ?></td></tr>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Riwayat Penyakit</h6>
                </div>
                <div class="card-body">
                    <?php if($riwayatPenyakit): ?>
                        <?php if($riwayatPenyakit['tidak_ada_riwayat']): ?>
                            <span class="badge bg-success">Tidak ada riwayat penyakit</span>
                        <?php else: ?>
                            <?php $riwayat = json_decode($riwayatPenyakit['riwayat_penyakit'], true) ?? []; ?>
                            <ul class="list-unstyled mb-0">
                                <?php foreach($riwayat as $r): ?>
                                <li>• <?= esc($r) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0">Rencana Persalinan</h6>
                </div>
                <div class="card-body">
                    <?php if($identitas && $skrining): ?>
                    <table class="table table-sm table-borderless">
                        <tr><td><strong>Usia Kehamilan</strong></td><td>: <?= esc($identitas['usia_kehamilan']) ?> bulan</td></tr>
                        <tr><td><strong>Rencana Tanggal</strong></td><td>: <?= date('d M Y', strtotime($identitas['rencana_tanggal_persalinan'])) ?></td></tr>
                        <tr><td><strong>Tempat</strong></td><td>: <?= esc($skrining['tempat_persalinan']) ?></td></tr>
                        <tr><td><strong>Penolong</strong></td><td>: <?= esc($skrining['penolong_persalinan']) ?></td></tr>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Kunjungan -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Riwayat Kunjungan (<?= count($kunjunganList) ?> Kunjungan)</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($kunjunganList)): ?>
                        <p class="text-muted text-center py-4">Belum ada data kunjungan</p>
                    <?php else: ?>
                        <?php foreach($kunjunganList as $index => $kunjungan): ?>
                        <div class="card mb-3 border-start border-5 border-<?= $index === 0 ? 'success' : 'primary' ?>">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0">
                                        <i class="ti ti-calendar"></i> Kunjungan ke-<?= $kunjungan['kunjungan_ke'] ?>
                                        <span class="badge bg-secondary ms-2"><?= date('d M Y', strtotime($kunjungan['tanggal_kunjungan'])) ?></span>
                                    </h6>
                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#kunjungan<?= $kunjungan['id'] ?>">
                                        <i class="ti ti-eye"></i> Lihat Detail
                                    </button>
                                </div>
                            </div>
                            <div class="collapse" id="kunjungan<?= $kunjungan['id'] ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Antropometri -->
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-primary"><i class="ti ti-ruler"></i> Antropometri</h6>
                                            <?php if($kunjungan['antropometri']): ?>
                                            <table class="table table-sm">
                                                <tr><td>Tekanan Darah</td><td><strong><?= esc($kunjungan['antropometri']['tekanan_darah']) ?></strong> mmHg</td></tr>
                                                <tr><td>Berat Badan</td><td><strong><?= esc($kunjungan['antropometri']['berat_badan']) ?></strong> kg</td></tr>
                                                <tr><td>Tinggi Badan</td><td><strong><?= esc($kunjungan['antropometri']['tinggi_badan']) ?></strong> cm</td></tr>
                                                <tr><td>LILA</td><td><strong><?= esc($kunjungan['antropometri']['lila']) ?></strong> cm</td></tr>
                                            </table>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Keluhan -->
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-primary"><i class="ti ti-alert-circle"></i> Keluhan</h6>
                                            <?php if($kunjungan['keluhan']): ?>
                                                <?php $keluhan = json_decode($kunjungan['keluhan']['keluhan'], true) ?? []; ?>
                                                <ul class="list-unstyled">
                                                    <?php foreach($keluhan as $k): ?>
                                                    <li>• <?= esc($k) ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Suplementasi -->
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-primary"><i class="ti ti-pill"></i> Suplementasi</h6>
                                            <?php if($kunjungan['suplementasi']): ?>
                                            <table class="table table-sm">
                                                <tr><td>Suplemen</td><td><strong><?= esc($kunjungan['suplementasi']['nama_suplemen']) ?></strong></td></tr>
                                                <tr><td>Status</td><td><span class="badge bg-success"><?= esc($kunjungan['suplementasi']['status_pemberian']) ?></span></td></tr>
                                                <tr><td>Jumlah</td><td><?= esc($kunjungan['suplementasi']['jumlah_tablet']) ?> tablet</td></tr>
                                                <tr><td>Frekuensi</td><td><?= esc($kunjungan['suplementasi']['frekuensi']) ?></td></tr>
                                            </table>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Etnomedisin -->
                                        <div class="col-md-6 mb-3">
                                            <h6 class="text-primary"><i class="ti ti-leaf"></i> Etnomedisin</h6>
                                            <?php if($kunjungan['etnomedisin']): ?>
                                                <?php if($kunjungan['etnomedisin']['menggunakan_obat_tradisional'] === 'ya'): ?>
                                                    <p><strong>Status:</strong> <span class="badge bg-success">Menggunakan</span></p>
                                                    <?php 
                                                    $jenisObat = json_decode($kunjungan['etnomedisin']['jenis_obat'], true) ?? [];
                                                    $tujuan = json_decode($kunjungan['etnomedisin']['tujuan_penggunaan'], true) ?? [];
                                                    ?>
                                                    <?php if(!empty($jenisObat)): ?>
                                                    <p><strong>Jenis:</strong> <?= implode(', ', $jenisObat) ?></p>
                                                    <?php endif; ?>
                                                    <?php if(!empty($tujuan)): ?>
                                                    <p><strong>Tujuan:</strong> <?= implode(', ', $tujuan) ?></p>
                                                    <?php endif; ?>
                                                    <p><strong>Edukasi:</strong> <span class="badge bg-<?= $kunjungan['etnomedisin']['edukasi_diberikan'] === 'sudah' ? 'success' : 'warning' ?>"><?= ucfirst($kunjungan['etnomedisin']['edukasi_diberikan']) ?></span></p>
                                                <?php else: ?>
                                                    <p class="text-muted">Tidak menggunakan obat tradisional</p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <?php if($kunjungan['catatan']): ?>
                                    <div class="alert alert-info">
                                        <strong>Catatan:</strong> <?= esc($kunjungan['catatan']) ?>
                                    </div>
                                    <?php endif; ?>

                                    <div class="text-end mt-3">
                                        <a href="<?= base_url('admin/monitoring/delete-kunjungan/'.$kunjungan['id']) ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Yakin ingin menghapus data kunjungan ini?')">
                                            <i class="ti ti-trash"></i> Hapus Kunjungan
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
