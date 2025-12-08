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
            <a href="<?= base_url('admin/monitoring/balita') ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Monitoring Balita & Anak</h2>
                    <p class="text-muted">Pasien: <strong><?= esc($identitas['nama_anak'] ?? 'N/A') ?></strong></p>
                    <p class="mb-0">
                        <span class="badge bg-info fs-6">
                            Total Kunjungan: <?= count($kunjungan) ?>
                        </span>
                    </p>
                </div>
                <div>
                    <a href="<?= base_url('admin/monitoring/balita/edit-master/'.$monitoring['id']) ?>" class="btn btn-warning">
                        <i class="ti ti-edit"></i> Edit Data Master
                    </a>
                    <a href="<?= base_url('admin/monitoring/balita/input-kunjungan/'.$monitoring['id']) ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Kunjungan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Identitas -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Identitas Balita</h5>
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

    <!-- Riwayat Kunjungan -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Riwayat Kunjungan (<?= count($kunjungan) ?> kunjungan)</h5>
        </div>
        <div class="card-body">
            <?php if(empty($kunjungan)): ?>
                <p class="text-muted">Belum ada data kunjungan</p>
            <?php else: ?>
                <div class="accordion" id="accordionBalita">
                <?php foreach($kunjungan as $index => $k): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button<?= $k['kunjungan_ke'] > 1 ? ' collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#kunjungan<?= $k['id'] ?>">
                            Kunjungan ke-<?= $k['kunjungan_ke'] ?> <small class="text-muted ms-2">(<?= date('d-m-Y', strtotime($k['tanggal_kunjungan'])) ?>)</small>
                        </button>
                    </h2>
                    <div id="kunjungan<?= $k['id'] ?>" class="accordion-collapse collapse<?= $k['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-bs-parent="#accordionBalita">
                        <div class="accordion-body">
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

                            <div class="text-end mt-3">
                                <a href="<?= base_url('admin/monitoring/balita/edit-kunjungan/'.$monitoring['id'].'/'.$k['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="ti ti-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/monitoring/balita/delete-kunjungan/'.$k['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="ti ti-trash"></i> Hapus
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
