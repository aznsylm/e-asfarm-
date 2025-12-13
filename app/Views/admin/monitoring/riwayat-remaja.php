<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <?= session()->getFlashdata('success') ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
</div>
<?php endif; ?>

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/remaja') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <p class="mb-1">Pasien: <strong><?= esc($identitas['nama_lengkap'] ?? 'N/A') ?></strong></p>
        <span class="badge badge-info">Total Kunjungan: <?= $totalKunjungan ?></span>
    </div>
    <div class="col-md-6 text-right">
        <a href="<?= base_url('admin/monitoring/laporan/export-detail-excel/remaja/'.$monitoring['id']) ?>" class="btn btn-success btn-sm">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="<?= base_url('admin/monitoring/laporan/export-detail-pdf/remaja/'.$monitoring['id']) ?>" class="btn btn-danger btn-sm">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
        <a href="<?= base_url('admin/monitoring/remaja/edit-master/'.$monitoring['id']) ?>" class="btn btn-warning btn-sm">
            <i class="fas fa-edit"></i> Edit Data Identitas
        </a>
        <a href="<?= base_url('admin/monitoring/remaja/input-kunjungan/'.$monitoring['id']) ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Kunjungan
        </a>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title">Data Identitas Remaja</h3>
    </div>
        <div class="card-body">
            <?php if($identitas): ?>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th width="200">Nama Lengkap</th><td>: <?= esc($identitas['nama_lengkap']) ?></td></tr>
                        <tr><th>NIK</th><td>: <?= esc($identitas['nik'] ?: '-') ?></td></tr>
                        <tr><th>Tanggal Lahir</th><td>: <?= date('d-m-Y', strtotime($identitas['tanggal_lahir'])) ?></td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr><th width="200">Jenis Kelamin</th><td>: <?= $identitas['jenis_kelamin'] ? ucfirst(strtolower($identitas['jenis_kelamin'])) : '-' ?></td></tr>
                        <tr><th>Nama Wali</th><td>: <?= esc($identitas['nama_wali']) ?></td></tr>
                        <tr><th>No. HP Wali</th><td>: <?= esc($identitas['no_hp_wali']) ?></td></tr>
                    </table>
                </div>
            </div>
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
                <div class="accordion" id="accordionRemaja">
                <?php foreach($kunjunganList as $index => $kunjungan): ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" href="#kunjungan<?= $kunjungan['id'] ?>" class="<?= $kunjungan['kunjungan_ke'] > 1 ? 'collapsed' : '' ?>">
                                Kunjungan ke-<?= $kunjungan['kunjungan_ke'] ?> <small class="text-muted">(<?= date('d-m-Y', strtotime($kunjungan['tanggal_kunjungan'])) ?>)</small>
                            </a>
                        </h4>
                    </div>
                    <div id="kunjungan<?= $kunjungan['id'] ?>" class="collapse<?= $kunjungan['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-parent="#accordionRemaja">
                        <div class="card-body">
                            <?php if($kunjungan['antropometri']): ?>
                            <div class="mb-2">
                                <strong>Antropometri:</strong>
                                <?php 
                                $antropometriList = [];
                                if($kunjungan['antropometri']['berat_badan']) {
                                    $bb = floatval($kunjungan['antropometri']['berat_badan']);
                                    $antropometriList[] = 'BB: ' . ($bb == intval($bb) ? intval($bb) : $bb) . ' kg';
                                }
                                if($kunjungan['antropometri']['tinggi_badan']) {
                                    $tb = floatval($kunjungan['antropometri']['tinggi_badan']);
                                    $antropometriList[] = 'TB: ' . ($tb == intval($tb) ? intval($tb) : $tb) . ' cm';
                                }
                                if($kunjungan['antropometri']['lingkar_perut']) {
                                    $lp = floatval($kunjungan['antropometri']['lingkar_perut']);
                                    $antropometriList[] = 'LP: ' . ($lp == intval($lp) ? intval($lp) : $lp) . ' cm';
                                }
                                if($kunjungan['antropometri']['tekanan_darah']) {
                                    $antropometriList[] = 'TD: ' . esc($kunjungan['antropometri']['tekanan_darah']);
                                }
                                echo !empty($antropometriList) ? implode(', ', $antropometriList) : 'Tidak ada data';
                                ?>
                            </div>
                            <?php else: ?>
                            <div class="mb-2"><strong>Antropometri:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($kunjungan['anemia']): ?>
                            <div class="mb-2">
                                <strong>Gejala Anemia:</strong>
                                <?php if($kunjungan['anemia']['gejala_anemia']): ?>
                                <ul class="mb-1">
                                    <?php 
                                    $gejala = str_replace(['[', ']', '"'], '', $kunjungan['anemia']['gejala_anemia']);
                                    $gejalaArray = array_filter(array_map('trim', explode(',', $gejala)));
                                    foreach($gejalaArray as $item): 
                                    ?>
                                    <li><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                Tidak ada gejala
                                <?php endif; ?>
                            </div>
                            <?php else: ?>
                            <div class="mb-2"><strong>Gejala Anemia:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($kunjungan['haid']): ?>
                            <div class="mt-2">
                                <strong>Data Menstruasi:</strong>
                                <ul class="mb-1">
                                    <li>Sudah Menstruasi: <?= $kunjungan['haid']['sudah_menstruasi'] ? 'Ya' : 'Tidak' ?></li>
                                    <?php if($kunjungan['haid']['sudah_menstruasi']): ?>
                                    <li>Keteraturan Haid: <?= $kunjungan['haid']['keteraturan_haid'] ? esc($kunjungan['haid']['keteraturan_haid']) : 'Tidak ada data' ?></li>
                                    <li>Nyeri Haid: <?= $kunjungan['haid']['nyeri_haid'] ? esc($kunjungan['haid']['nyeri_haid']) : 'Tidak ada data' ?></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Data Menstruasi:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($kunjungan['suplementasi']): ?>
                            <div class="mt-2">
                                <strong>Suplementasi:</strong>
                                <?php 
                                $suplementasiList = [];
                                if($kunjungan['suplementasi']['dapat_ttd']) $suplementasiList[] = 'Dapat TTD';
                                if($kunjungan['suplementasi']['minum_ttd']) $suplementasiList[] = 'Minum TTD';
                                if($kunjungan['suplementasi']['kebiasaan_sarapan']) $suplementasiList[] = 'Sarapan: ' . esc($kunjungan['suplementasi']['kebiasaan_sarapan']);
                                echo !empty($suplementasiList) ? implode(', ', $suplementasiList) : 'Tidak ada data';
                                ?>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Suplementasi:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($kunjungan['gaya_hidup']): ?>
                            <div class="mt-2">
                                <strong>Gaya Hidup & Risiko PTM:</strong>
                                <?php if($kunjungan['gaya_hidup']['risiko_ptm']): ?>
                                <ul class="mb-1">
                                    <?php 
                                    $risiko = str_replace(['[', ']', '"'], '', $kunjungan['gaya_hidup']['risiko_ptm']);
                                    $risikoArray = array_filter(array_map('trim', explode(',', $risiko)));
                                    foreach($risikoArray as $item): 
                                    ?>
                                    <li><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                Tidak ada data
                                <?php endif; ?>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Gaya Hidup & Risiko PTM:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if($kunjungan['swamedikasi']): ?>
                            <div class="mt-2">
                                <strong>Perilaku Swamedikasi:</strong>
                                <?php if($kunjungan['swamedikasi']['perilaku_swamedikasi']): ?>
                                <ul class="mb-1">
                                    <?php 
                                    $swamed = str_replace(['[', ']', '"'], '', $kunjungan['swamedikasi']['perilaku_swamedikasi']);
                                    $swamedArray = array_filter(array_map('trim', explode(',', $swamed)));
                                    foreach($swamedArray as $item): 
                                    ?>
                                    <li><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php else: ?>
                                Tidak ada data
                                <?php endif; ?>
                            </div>
                            <?php else: ?>
                            <div class="mt-2"><strong>Perilaku Swamedikasi:</strong> Tidak ada data</div>
                            <?php endif; ?>
                            
                            <?php if(!empty($kunjungan['catatan'])): ?>
                            <div class="mt-2">
                                <strong>Catatan:</strong> <?= esc($kunjungan['catatan']) ?>
                            </div>
                            <?php endif; ?>

                            <div class="text-right mt-3">
                                <a href="<?= base_url('admin/monitoring/remaja/edit-kunjungan/'.$monitoring['id'].'/'.$kunjungan['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/monitoring/remaja/delete-kunjungan/'.$kunjungan['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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
