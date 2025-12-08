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
                    <p class="mb-0">
                        <span class="badge bg-<?= $totalKunjungan >= 13 ? 'warning' : 'info' ?> fs-6">
                            Kunjungan: <?= $totalKunjungan ?> dari maksimal <?= $maxKunjungan ?>
                        </span>
                    </p>
                </div>
                <div>
                    <a href="<?= base_url('admin/monitoring/edit-master/'.$monitoring['id']) ?>" class="btn btn-warning">
                        <i class="ti ti-edit"></i> Edit Data Master
                    </a>
                    <?php if($canAddKunjungan): ?>
                        <a href="<?= base_url('admin/monitoring/input-kunjungan/'.$monitoring['id']) ?>" class="btn btn-primary">
                            <i class="ti ti-plus"></i> Tambah Kunjungan
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled title="Maksimal kunjungan tercapai">
                            <i class="ti ti-lock"></i> Maksimal Tercapai
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Identitas Ibu Hamil -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Identitas Ibu Hamil</h5>
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

    <!-- Riwayat Kunjungan -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Riwayat Kunjungan (<?= $totalKunjungan ?> kunjungan)</h5>
        </div>
        <div class="card-body">
            <?php if(empty($kunjunganList)): ?>
                <p class="text-muted">Belum ada data kunjungan</p>
            <?php else: ?>
                <div class="accordion" id="accordionKunjungan">
                <?php foreach($kunjunganList as $index => $kunjungan): ?>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button<?= $kunjungan['kunjungan_ke'] > 1 ? ' collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#kunjungan<?= $kunjungan['id'] ?>">
                            Kunjungan ke-<?= $kunjungan['kunjungan_ke'] ?> <small class="text-muted ms-2">(<?= date('d-m-Y', strtotime($kunjungan['tanggal_kunjungan'])) ?>)</small>
                        </button>
                    </h2>
                    <div id="kunjungan<?= $kunjungan['id'] ?>" class="accordion-collapse collapse<?= $kunjungan['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-bs-parent="#accordionKunjungan">
                        <div class="accordion-body">
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

                            <div class="text-end mt-3">
                                <a href="<?= base_url('admin/monitoring/edit-kunjungan/'.$monitoring['id'].'/'.$kunjungan['id']) ?>" class="btn btn-sm btn-warning">
                                    <i class="ti ti-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/monitoring/delete-kunjungan/'.$kunjungan['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
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
