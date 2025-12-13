<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>
<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
    </div>
<?php endif; ?>

<?php if(!empty($alertCount) && $alertCount > 0): ?>
<div class="alert alert-warning alert-dismissible fade show d-flex justify-content-between align-items-center">
    <div>
        <strong><i class="fas fa-exclamation-triangle"></i> Alert Kesehatan:</strong> Ditemukan <?= $alertCount ?> kondisi yang perlu perhatian
    </div>
    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#alertModal">Lihat Detail</button>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Data Monitoring Balita & Anak</h3>
        <a href="<?= base_url('admin/monitoring/balita/input') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <form method="GET" action="<?= base_url('admin/monitoring/balita') ?>">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama anak atau username..." value="<?= esc($search ?? '') ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                        <?php if(!empty($search)): ?>
                            <a href="<?= base_url('admin/monitoring/balita') ?>" class="btn btn-secondary"><i class="fas fa-times"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        <?php if(empty($dataBalita)): ?>
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <p class="text-muted">Belum ada data monitoring balita & anak</p>
                <a href="<?= base_url('admin/monitoring/balita/input') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Data Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Anak</th>
                            <th>Tanggal Lahir</th>
                            <th>Padukuhan</th>
                            <th>Usia</th>
                            <th>Kunjungan Terakhir</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                        foreach($dataBalita as $m): 
                            $kunjunganModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
                            $lastKunjungan = $kunjunganModel->where('monitoring_balita_id', $m['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
                            $usia = '-';
                            if(isset($m['tanggal_lahir'])) {
                                $tglLahir = new DateTime($m['tanggal_lahir']);
                                $today = new DateTime();
                                $diff = $today->diff($tglLahir);
                                $usia = $diff->y . ' thn ' . $diff->m . ' bln';
                            }
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($m['nama_anak'] ?? '-') ?></td>
                            <td><?= isset($m['tanggal_lahir']) ? date('d/m/Y', strtotime($m['tanggal_lahir'])) : '-' ?></td>
                            <td><?= esc($m['nama_padukuhan'] ?? '-') ?></td>
                            <td><?= $usia ?></td>
                            <td><?= $lastKunjungan ? date('d/m/Y', strtotime($lastKunjungan['tanggal_kunjungan'])) : '-' ?></td>
                            <td>
                                <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$m['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/monitoring/balita/input-kunjungan/'.$m['id']) ?>" class="btn btn-sm btn-success" title="Tambah Kunjungan">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="<?= base_url('admin/monitoring/balita/delete-monitoring/'.$m['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus semua data monitoring balita ini?')" title="Hapus Monitoring">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <?php if(!empty($dataBalita)): ?>
    <div class="card-footer">
        <?= $pager->links() ?>
    </div>
    <?php endif; ?>
</div>

<!-- Modal Alert Detail -->
<div class="modal fade" id="alertModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Alert Kesehatan - Balita & Anak</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Kriteria Alert:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Imunisasi Belum Lengkap</li>
                        <li>Berat Badan Kurang: <10 kg</li>
                        <li>Tidak Dapat Vitamin A</li>
                        <li>Keluhan Serius: Demam atau Diare</li>
                    </ul>
                </div>

                <?php if(!empty($alertData['imunisasi'])): ?>
                <h6 class="mt-3">Imunisasi Belum Lengkap (<?= count($alertData['imunisasi']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama Anak</th><th>No HP/WA Wali</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['imunisasi'] as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama']) ?></td>
                            <td><a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $item['hp']) ?>" target="_blank" class="text-success"><?= esc($item['hp']) ?></a></td>
                            <td><?= esc($item['detail']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <?php if(!empty($alertData['bb_kurang'])): ?>
                <h6 class="mt-3">Berat Badan Kurang (<?= count($alertData['bb_kurang']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama Anak</th><th>No HP/WA Wali</th><th>Berat Badan</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['bb_kurang'] as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama']) ?></td>
                            <td><a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $item['hp']) ?>" target="_blank" class="text-success"><?= esc($item['hp']) ?></a></td>
                            <td><?= esc($item['detail']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <?php if(!empty($alertData['vitamin_a'])): ?>
                <h6 class="mt-3">Tidak Dapat Vitamin A (<?= count($alertData['vitamin_a']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama Anak</th><th>No HP/WA Wali</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['vitamin_a'] as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama']) ?></td>
                            <td><a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $item['hp']) ?>" target="_blank" class="text-success"><?= esc($item['hp']) ?></a></td>
                            <td><?= esc($item['detail']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <?php if(!empty($alertData['keluhan'])): ?>
                <h6 class="mt-3">Keluhan Serius (<?= count($alertData['keluhan']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama Anak</th><th>No HP/WA Wali</th><th>Keluhan</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['keluhan'] as $item): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($item['nama']) ?></td>
                            <td><a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $item['hp']) ?>" target="_blank" class="text-success"><?= esc($item['hp']) ?></a></td>
                            <td><?= esc($item['detail']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>


