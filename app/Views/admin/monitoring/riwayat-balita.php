<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php endif; ?>

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/balita') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <p class="mb-1">Pasien: <strong><?= esc($identitas['nama_anak'] ?? 'N/A') ?></strong></p>
        <span class="badge badge-info">Total Kunjungan: <?= count($kunjungan) ?></span>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?= base_url('admin/monitoring/laporan/export-detail-excel/balita/'.$monitoring['id']) ?>" class="btn btn-success btn-sm">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="<?= base_url('admin/monitoring/laporan/export-detail-pdf/balita/'.$monitoring['id']) ?>" class="btn btn-danger btn-sm">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="<?= base_url('admin/monitoring/balita/edit-master/'.$monitoring['id']) ?>" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit Data Master
        </a>
        <a href="<?= base_url('admin/monitoring/balita/input-kunjungan/'.$monitoring['id']) ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Kunjungan
        </a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Data Identitas Balita</h3>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th width="200">Nama Anak</th><td>: <?= esc($identitas['nama_anak']) ?></td></tr>
                        <tr><th>Tanggal Lahir</th><td>: <?= date('d-m-Y', strtotime($identitas['tanggal_lahir'])) ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th width="200">Nama Wali</th><td>: <?= esc($identitas['nama_wali']) ?></td></tr>
                        <tr><th>No. HP Wali</th><td>: <?= esc($identitas['no_hp_wali']) ?></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Kunjungan (<?= count($kunjungan) ?> kunjungan)</h3>
    </div>
        <div class="card-body">
            <?php if(empty($kunjungan)): ?>
                <p class="text-muted">Belum ada data kunjungan</p>
            <?php else: ?>
                <div class="accordion" id="accordionBalita">
                <?php foreach($kunjungan as $index => $k): ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" href="#kunjungan<?= $k['id'] ?>" class="<?= $k['kunjungan_ke'] > 1 ? 'collapsed' : '' ?>">
                                Kunjungan ke-<?= $k['kunjungan_ke'] ?> <small class="text-muted">(<?= date('d-m-Y', strtotime($k['tanggal_kunjungan'])) ?>)</small>
                            </a>
                        </h4>
                    </div>
                    <div id="kunjungan<?= $k['id'] ?>" class="collapse<?= $k['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-parent="#accordionBalita">
                        <div class="card-body">
                            <?php if($k['antropometri']): ?>
                            <div class="mb-2">
                                <strong>Antropometri:</strong>
                                <?php 
                                $antropometriList = [];
                                if($k['antropometri']['berat_badan']) {
                                    $bb = floatval($k['antropometri']['berat_badan']);
                                    $antropometriList[] = 'BB: ' . ($bb == intval($bb) ? intval($bb) : $bb) . ' kg';
                                }
                                if($k['antropometri']['tinggi_badan']) {
                                    $tb = floatval($k['antropometri']['tinggi_badan']);
                                    $antropometriList[] = 'TB: ' . ($tb == intval($tb) ? intval($tb) : $tb) . ' cm';
                                }
                                if($k['antropometri']['lingkar_kepala']) {
                                    $lk = floatval($k['antropometri']['lingkar_kepala']);
                                    $antropometriList[] = 'LK: ' . ($lk == intval($lk) ? intval($lk) : $lk) . ' cm';
                                }
                                echo !empty($antropometriList) ? implode(', ', $antropometriList) : 'Tidak ada data';
                                ?>
                            </div>
                            <?php else: ?>
                            <div class="mb-2"><strong>Antropometri:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($k['keluhan']): ?>
                            <div class="mt-2">
                                <strong>Keluhan:</strong>
                                <?php 
                                $keluhanList = [];
                                if($k['keluhan']['batuk']) $keluhanList[] = 'Batuk';
                                if($k['keluhan']['pilek']) $keluhanList[] = 'Pilek';
                                if($k['keluhan']['demam']) $keluhanList[] = 'Demam';
                                if($k['keluhan']['diare']) $keluhanList[] = 'Diare';
                                if($k['keluhan']['sembelit']) $keluhanList[] = 'Sembelit';
                                if($k['keluhan']['gtm']) $keluhanList[] = 'GTM';
                                if($k['keluhan']['lainnya']) $keluhanList[] = esc($k['keluhan']['lainnya']);
                                echo !empty($keluhanList) ? implode(', ', $keluhanList) : 'Tidak ada keluhan';
                                ?>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Keluhan:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($k['imunisasi']): ?>
                            <div class="mt-2">
                                <strong>Imunisasi & Alergi:</strong>
                                <?php 
                                $imunisasiList = [];
                                if($k['imunisasi']['status_imunisasi']) $imunisasiList[] = 'Status: ' . esc($k['imunisasi']['status_imunisasi']);
                                if($k['imunisasi']['riwayat_alergi']) $imunisasiList[] = 'Alergi: ' . esc($k['imunisasi']['riwayat_alergi']);
                                echo !empty($imunisasiList) ? implode(', ', $imunisasiList) : 'Tidak ada data';
                                ?>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Imunisasi & Alergi:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($k['swamedikasi']): ?>
                            <div class="mt-2">
                                <strong>Swamedikasi:</strong>
                                <?php 
                                $swamedList = [];
                                if($k['swamedikasi']['ke_nakes']) $swamedList[] = 'Ke Nakes';
                                if($k['swamedikasi']['obat_modern']) $swamedList[] = 'Obat Modern';
                                if($k['swamedikasi']['antibiotik']) $swamedList[] = 'Antibiotik';
                                if($k['swamedikasi']['etnomedisin']) $swamedList[] = 'Etnomedisin';
                                echo !empty($swamedList) ? implode(', ', $swamedList) : 'Tidak ada';
                                ?>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Swamedikasi:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($k['gizi']): ?>
                            <div class="mt-2">
                                <strong>Data Gizi:</strong>
                                <ul class="mb-1">
                                    <li>Vitamin A: <?= $k['gizi']['vitamin_a'] ? 'Ya' : 'Tidak' ?></li>
                                    <li>Obat Cacing: <?= $k['gizi']['obat_cacing'] ? 'Ya' : 'Tidak' ?></li>
                                    <?php if($k['gizi']['pola_makan']): ?>
                                    <li>Pola Makan: <?= esc(str_replace(['[', ']', '"'], '', $k['gizi']['pola_makan'])) ?></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Data Gizi:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($k['kpsp']): ?>
                            <div class="mt-2">
                                <strong>Hasil KPSP:</strong> <?= esc($k['kpsp']['hasil_skrining']) ?>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Hasil KPSP:</strong> Tidak ada data</div>
                            <?php endif; ?>

                            <div class="text-right mt-3">
                                <a href="<?= base_url('admin/monitoring/balita/edit-kunjungan/'.$monitoring['id'].'/'.$k['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/monitoring/balita/delete-kunjungan/'.$k['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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
