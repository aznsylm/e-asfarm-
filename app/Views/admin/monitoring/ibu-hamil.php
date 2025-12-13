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
        <h3 class="card-title">Data Monitoring Ibu Hamil & Menyusui</h3>
        <a href="<?= base_url('admin/monitoring/input') ?>" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <form method="GET" action="<?= base_url('admin/monitoring/ibu-hamil') ?>">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama ibu atau username..." value="<?= esc($search ?? '') ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                        <?php if(!empty($search)): ?>
                            <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="btn btn-secondary"><i class="fas fa-times"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        <?php if(empty($monitoringList)): ?>
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                <p class="text-muted">Belum ada data monitoring</p>
                <a href="<?= base_url('admin/monitoring/input') ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah Data Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama Ibu</th>
                            <th>No. Telepon</th>
                            <th>Padukuhan</th>
                            <th>Usia Kehamilan</th>
                            <th>Kunjungan Terakhir</th>
                            <th width="200">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                        foreach($monitoringList as $m): 
                            $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
                            $lastKunjungan = $kunjunganModel->where('monitoring_id', $m['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($m['nama_ibu'] ?? '-') ?></td>
                            <td><?= esc($m['nomor_telepon'] ?? '-') ?></td>
                            <td><?= esc($m['nama_padukuhan'] ?? '-') ?></td>
                            <td><?= esc($m['usia_kehamilan'] ?? '-') ?> minggu</td>
                            <td><?= $lastKunjungan ? date('d/m/Y', strtotime($lastKunjungan['tanggal_kunjungan'])) : '-' ?></td>
                            <td>
                                <a href="<?= base_url('admin/monitoring/riwayat/'.$m['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= base_url('admin/monitoring/input-kunjungan/'.$m['id']) ?>" class="btn btn-sm btn-success" title="Tambah Kunjungan">
                                    <i class="fas fa-plus"></i>
                                </a>
                                <a href="<?= base_url('admin/monitoring/delete-monitoring/'.$m['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus semua data monitoring pasien ini?')" title="Hapus Monitoring">
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
    <?php if(!empty($monitoringList)): ?>
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
                <h5 class="modal-title">Detail Alert Kesehatan - Ibu Hamil</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Kriteria Alert:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Tekanan Darah Tinggi: Sistolik ≥140 atau Diastolik ≥90</li>
                        <li>LILA Rendah: <23.5 cm (risiko KEK)</li>
                        <li>Anemia: Keluhan pucat, pusing, atau lemas</li>
                        <li>HPL Dekat: Rencana persalinan <14 hari lagi</li>
                    </ul>
                </div>

                <?php if(!empty($alertData['td_tinggi'])): ?>
                <h6 class="mt-3">Tekanan Darah Tinggi (<?= count($alertData['td_tinggi']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA</th><th>Tekanan Darah</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['td_tinggi'] as $item): ?>
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

                <?php if(!empty($alertData['lila_rendah'])): ?>
                <h6 class="mt-3">LILA Rendah (<?= count($alertData['lila_rendah']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA</th><th>LILA</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['lila_rendah'] as $item): ?>
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

                <?php if(!empty($alertData['anemia'])): ?>
                <h6 class="mt-3">Anemia (<?= count($alertData['anemia']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA</th><th>Gejala</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['anemia'] as $item): ?>
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

                <?php if(!empty($alertData['hpl_dekat'])): ?>
                <h6 class="mt-3">HPL Dekat (<?= count($alertData['hpl_dekat']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA</th><th>Sisa Waktu</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['hpl_dekat'] as $item): ?>
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


