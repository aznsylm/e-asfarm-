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
            <a href="<?= base_url('admin/monitoring/remaja') ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Detail Monitoring Remaja</h2>
                    <p class="text-muted">Pasien: <strong><?= esc($identitas['nama_lengkap'] ?? 'N/A') ?></strong></p>
                    <p class="mb-0">
                        <span class="badge bg-info fs-6">
                            Total Kunjungan: <?= $totalKunjungan ?>
                        </span>
                    </p>
                </div>
                <div>
                    <a href="<?= base_url('admin/monitoring/remaja/edit-master/'.$monitoring['id']) ?>" class="btn btn-warning">
                        <i class="ti ti-edit"></i> Edit Data Identitas
                    </a>
                    <a href="<?= base_url('admin/monitoring/remaja/input-kunjungan/'.$monitoring['id']) ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Kunjungan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Identitas Remaja -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Identitas Remaja</h5>
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

    <!-- Riwayat Kunjungan -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Riwayat Kunjungan (<?= $totalKunjungan ?> kunjungan)</h5>
        </div>
        <div class="card-body">
            <?php if(empty($kunjunganList)): ?>
                <p class="text-muted">Belum ada data kunjungan</p>
            <?php else: ?>
                <div class="accordion" id="accordionRemaja">
                <?php foreach($kunjunganList as $index => $kunjungan): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button<?= $kunjungan['kunjungan_ke'] > 1 ? ' collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#kunjungan<?= $kunjungan['id'] ?>">
                            Kunjungan ke-<?= $kunjungan['kunjungan_ke'] ?> <small class="text-muted ms-2">(<?= date('d-m-Y', strtotime($kunjungan['tanggal_kunjungan'])) ?>)</small>
                        </button>
                    </h2>
                    <div id="kunjungan<?= $kunjungan['id'] ?>" class="accordion-collapse collapse<?= $kunjungan['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-bs-parent="#accordionRemaja">
                        <div class="accordion-body">
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

                            <div class="text-end mt-3">
                                <a href="<?= base_url('admin/monitoring/remaja/edit-kunjungan/'.$monitoring['id'].'/'.$kunjungan['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="ti ti-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/monitoring/remaja/delete-kunjungan/'.$kunjungan['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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
