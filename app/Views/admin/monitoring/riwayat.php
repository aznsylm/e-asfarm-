<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php endif; ?>

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <p class="mb-1">Pasien: <strong><?= esc($identitas['nama_ibu'] ?? 'N/A') ?></strong></p>
        <span class="badge badge-<?= $totalKunjungan >= 13 ? 'warning' : 'info' ?>">
            Kunjungan: <?= $totalKunjungan ?> dari maksimal <?= $maxKunjungan ?>
        </span>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?= base_url('admin/monitoring/laporan/export-detail-excel/ibu-hamil/'.$monitoring['id']) ?>" class="btn btn-success btn-sm">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="<?= base_url('admin/monitoring/laporan/export-detail-pdf/ibu-hamil/'.$monitoring['id']) ?>" class="btn btn-danger btn-sm">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="<?= base_url('admin/monitoring/edit-master/'.$monitoring['id']) ?>" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit Data Master
        </a>
        <?php if($canAddKunjungan): ?>
            <a href="<?= base_url('admin/monitoring/input-kunjungan/'.$monitoring['id']) ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kunjungan
            </a>
        <?php else: ?>
            <button class="btn btn-secondary btn-sm" disabled title="Maksimal kunjungan tercapai">
                <i class="fas fa-lock"></i> Maksimal Tercapai
            </button>
        <?php endif; ?>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Data Identitas Ibu Hamil</h3>
    </div>
        <div class="card-body">
            <?php if($identitas): ?>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th width="200">Nama Ibu</th><td>: <?= esc($identitas['nama_ibu']) ?></td></tr>
                        <tr><th>Nama Suami</th><td>: <?= esc($identitas['nama_suami']) ?></td></tr>
                        <tr><th>Usia Ibu</th><td>: <?= esc($identitas['usia_ibu']) ?> tahun</td></tr>
                        <tr><th>Usia Suami</th><td>: <?= esc($identitas['usia_suami'] ?? '-') ?> tahun</td></tr>
                        <tr><th>Usia Kehamilan</th><td>: <?= esc($identitas['usia_kehamilan']) ?> minggu</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th width="200">Alamat</th><td>: <?= esc($identitas['alamat']) ?></td></tr>
                        <tr><th>Nomor Telepon</th><td>: <?= esc($identitas['nomor_telepon']) ?></td></tr>
                        <tr><th>Rencana Persalinan</th><td>: <?= date('d-m-Y', strtotime($identitas['rencana_tanggal_persalinan'])) ?></td></tr>
                        <?php if($skrining): ?>
                        <tr><th>Tempat Persalinan</th><td>: <?= esc($skrining['tempat_persalinan']) ?></td></tr>
                        <tr><th>Penolong Persalinan</th><td>: <?= esc($skrining['penolong_persalinan']) ?></td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
            <?php if($riwayatPenyakit): ?>
            <div class="mt-3">
                <strong>Riwayat Penyakit:</strong>
                <?php if($riwayatPenyakit['tidak_ada_riwayat']): ?>
                    <span class="text-success"> Tidak ada riwayat penyakit</span>
                <?php else: ?>
                    <?php $riwayat = json_decode($riwayatPenyakit['riwayat_penyakit'], true) ?? []; ?>
                    <?php if(!empty($riwayat)): ?>
                    <p class="mb-0 mt-1"><?= implode(', ', array_map('esc', $riwayat)) ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <?php else: ?>
            <p class="text-muted">Data identitas belum lengkap</p>
            <?php endif; ?>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Kunjungan (<?= $totalKunjungan ?> kunjungan)</h3>
    </div>
        <div class="card-body">
            <?php if(empty($kunjunganList)): ?>
                <p class="text-muted">Belum ada data kunjungan</p>
            <?php else: ?>
                <div class="accordion" id="accordionKunjungan">
                <?php foreach($kunjunganList as $index => $kunjungan): ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" href="#kunjungan<?= $kunjungan['id'] ?>" class="<?= $kunjungan['kunjungan_ke'] > 1 ? 'collapsed' : '' ?>">
                                Kunjungan ke-<?= $kunjungan['kunjungan_ke'] ?> <small class="text-muted">(<?= date('d-m-Y', strtotime($kunjungan['tanggal_kunjungan'])) ?>)</small>
                            </a>
                        </h4>
                    </div>
                    <div id="kunjungan<?= $kunjungan['id'] ?>" class="collapse<?= $kunjungan['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-parent="#accordionKunjungan">
                        <div class="card-body">
                            <?php if($kunjungan['antropometri']): ?>
                            <div class="mt-2">
                                <strong>Antropometri:</strong>
                                <ul class="mb-1">
                                    <li>Tekanan Darah: <?= esc($kunjungan['antropometri']['tekanan_darah']) ?></li>
                                    <li>Berat Badan: <?= esc($kunjungan['antropometri']['berat_badan']) ?> kg</li>
                                    <li>Tinggi Badan: <?= esc($kunjungan['antropometri']['tinggi_badan']) ?> cm</li>
                                    <li>LILA: <?= esc($kunjungan['antropometri']['lila']) ?> cm</li>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <?php if($kunjungan['keluhan']): ?>
                            <div class="mt-2">
                                <strong>Keluhan:</strong>
                                <ul class="mb-1">
                                    <?php 
                                    $keluhan = str_replace(['[', ']', '"'], '', $kunjungan['keluhan']['keluhan']);
                                    $keluhanArray = array_filter(array_map('trim', explode(',', $keluhan)));
                                    foreach($keluhanArray as $item): 
                                    ?>
                                    <li><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <?php if($kunjungan['suplementasi']): ?>
                            <div class="mt-2">
                                <strong>Suplementasi:</strong>
                                <ul class="mb-1">
                                    <li>Suplemen: <?= esc($kunjungan['suplementasi']['nama_suplemen']) ?></li>
                                    <li>Status: <?= esc($kunjungan['suplementasi']['status_pemberian']) ?></li>
                                    <li>Jumlah: <?= esc($kunjungan['suplementasi']['jumlah_tablet']) ?> tablet</li>
                                    <li>Frekuensi: <?= esc($kunjungan['suplementasi']['frekuensi']) ?></li>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <?php if($kunjungan['etnomedisin']): ?>
                            <div class="mt-2">
                                <strong>Etnomedisin:</strong>
                                <?php 
                                $etnoList = [];
                                if($kunjungan['etnomedisin']['jenis_obat']) {
                                    $jenis = str_replace(['[', ']', '"'], '', $kunjungan['etnomedisin']['jenis_obat']);
                                    $etnoList[] = 'Jenis: ' . esc($jenis);
                                }
                                if($kunjungan['etnomedisin']['tujuan_penggunaan']) {
                                    $tujuan = str_replace(['[', ']', '"'], '', $kunjungan['etnomedisin']['tujuan_penggunaan']);
                                    $etnoList[] = 'Tujuan: ' . esc($tujuan);
                                }
                                if($kunjungan['etnomedisin']['edukasi_diberikan']) {
                                    $edukasi = str_replace(['[', ']', '"'], '', $kunjungan['etnomedisin']['edukasi_diberikan']);
                                    $etnoList[] = 'Edukasi: ' . esc($edukasi);
                                }
                                
                                if(!empty($etnoList)) {
                                    echo implode(', ', $etnoList);
                                } else {
                                    echo $kunjungan['etnomedisin']['menggunakan_obat_tradisional'] == '1' ? 'Menggunakan obat tradisional' : 'Tidak menggunakan obat tradisional';
                                }
                                ?>
                            </div>
                            <?php endif; ?>

                            <div class="text-right mt-3">
                                <a href="<?= base_url('admin/monitoring/edit-kunjungan/'.$monitoring['id'].'/'.$kunjungan['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/monitoring/delete-kunjungan/'.$kunjungan['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
