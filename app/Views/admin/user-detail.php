<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Profil Pengguna -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-person-circle"></i> Profil Pengguna</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="150">Username</th>
                            <td>: <?= esc($user['username']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <?= esc($user['email']) ?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>: <?= esc($user['full_name'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>NIK</th>
                            <td>: <?= esc($user['nik'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>No. Telepon</th>
                            <td>: <?= esc($user['phone_number'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="150">Jenis Kelamin</th>
                            <td>: <?= esc($user['gender'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>: <?= $user['birth_date'] ? date('d-m-Y', strtotime($user['birth_date'])) : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Padukuhan</th>
                            <td>: <?= $padukuhan ? esc($padukuhan['nama_padukuhan']) : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: <?= esc($user['address'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>: <span class="badge bg-<?= $user['role'] === 'admin' ? 'warning' : 'info' ?>"><?= ucfirst($user['role']) ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php if ($monitoring): ?>
    <!-- Data Identitas Ibu Hamil -->
    <?php if ($identitas): ?>
    <div class="card mb-3">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-clipboard-data"></i> Data Identitas Ibu Hamil</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="200">Nama Ibu</th>
                            <td>: <?= esc($identitas['nama_ibu']) ?></td>
                        </tr>
                        <tr>
                            <th>Nama Suami</th>
                            <td>: <?= esc($identitas['nama_suami']) ?></td>
                        </tr>
                        <tr>
                            <th>Usia Ibu</th>
                            <td>: <?= esc($identitas['usia_ibu']) ?> tahun</td>
                        </tr>
                        <tr>
                            <th>Usia Suami</th>
                            <td>: <?= esc($identitas['usia_suami']) ?> tahun</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="200">Alamat</th>
                            <td>: <?= esc($identitas['alamat']) ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>: <?= esc($identitas['nomor_telepon']) ?></td>
                        </tr>
                        <tr>
                            <th>Usia Kehamilan</th>
                            <td>: <?= esc($identitas['usia_kehamilan']) ?> minggu</td>
                        </tr>
                        <tr>
                            <th>Rencana Persalinan</th>
                            <td>: <?= date('d-m-Y', strtotime($identitas['rencana_tanggal_persalinan'])) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Riwayat Penyakit -->
    <?php if ($riwayat): ?>
    <div class="card mb-3">
        <div class="card-header bg-warning">
            <h5 class="mb-0"><i class="bi bi-heart-pulse"></i> Riwayat Penyakit</h5>
        </div>
        <div class="card-body">
            <?php if ($riwayat['tidak_ada_riwayat'] === '1'): ?>
                <p class="text-success mb-0"><i class="bi bi-check-circle"></i> Tidak ada riwayat penyakit</p>
            <?php else: ?>
                <p class="mb-0"><?= esc($riwayat['riwayat_penyakit']) ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Skrining -->
    <?php if ($skrining): ?>
    <div class="card mb-3">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="bi bi-hospital"></i> Data Skrining</h5>
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless">
                <tr>
                    <th width="200">Tempat Persalinan</th>
                    <td>: <?= esc($skrining['tempat_persalinan']) ?></td>
                </tr>
                <tr>
                    <th>Penolong Persalinan</th>
                    <td>: <?= esc($skrining['penolong_persalinan']) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <!-- Riwayat Kunjungan -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="bi bi-calendar-check"></i> Riwayat Kunjungan (<?= count($kunjunganList) ?> kunjungan)</h5>
        </div>
        <div class="card-body">
            <?php if (empty($kunjunganList)): ?>
                <p class="text-muted">Belum ada data kunjungan</p>
            <?php else: ?>
                <?php foreach ($kunjunganList as $k): ?>
                <div class="border rounded p-3 mb-3">
                    <h6 class="text-primary">Kunjungan ke-<?= $k['kunjungan_ke'] ?> 
                        <small class="text-muted">(<?= date('d-m-Y', strtotime($k['tanggal_kunjungan'])) ?>)</small>
                    </h6>
                    
                    <?php if ($k['antropometri']): ?>
                    <div class="mt-2">
                        <strong>Antropometri:</strong>
                        <ul class="mb-1">
                            <li>Tekanan Darah: <?= esc($k['antropometri']['tekanan_darah']) ?></li>
                            <li>Berat Badan: <?= esc($k['antropometri']['berat_badan']) ?> kg</li>
                            <li>Tinggi Badan: <?= esc($k['antropometri']['tinggi_badan']) ?> cm</li>
                            <li>LILA: <?= esc($k['antropometri']['lila']) ?> cm</li>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if ($k['keluhan']): ?>
                    <div class="mt-2">
                        <strong>Keluhan:</strong> <?= esc($k['keluhan']['keluhan']) ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($k['suplementasi']): ?>
                    <div class="mt-2">
                        <strong>Suplementasi:</strong>
                        <ul class="mb-1">
                            <li>Suplemen: <?= esc($k['suplementasi']['nama_suplemen']) ?></li>
                            <li>Status: <?= esc($k['suplementasi']['status_pemberian']) ?></li>
                            <li>Jumlah: <?= esc($k['suplementasi']['jumlah_tablet']) ?> tablet</li>
                            <li>Frekuensi: <?= esc($k['suplementasi']['frekuensi']) ?></li>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if ($k['etnomedisin']): ?>
                    <div class="mt-2">
                        <strong>Etnomedisin:</strong>
                        <?php if ($k['etnomedisin']['menggunakan_obat_tradisional'] === '1'): ?>
                            <ul class="mb-1">
                                <li>Jenis: <?= esc($k['etnomedisin']['jenis_obat']) ?></li>
                                <li>Tujuan: <?= esc($k['etnomedisin']['tujuan_penggunaan']) ?></li>
                                <li>Dosis: <?= esc($k['etnomedisin']['dosis_frekuensi']) ?></li>
                            </ul>
                        <?php else: ?>
                            <span class="text-muted">Tidak menggunakan obat tradisional</span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php else: ?>
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i> Pengguna ini belum memiliki data monitoring kesehatan.
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
