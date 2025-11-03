<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="<?= base_url('admin/monitoring/dashboard') ?>" class="btn btn-outline-secondary btn-sm mb-2">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                    <h2>Monitoring Kesehatan Ibu Hamil dan Menyusui</h2>
                    <p class="text-muted">Kelola data monitoring kesehatan ibu hamil</p>
                </div>
                <a href="<?= base_url('admin/monitoring/input') ?>" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Input Data Baru
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Pasien Monitoring</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($monitoringList)): ?>
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada data monitoring</p>
                            <a href="<?= base_url('admin/monitoring/input') ?>" class="btn btn-primary">
                                <i class="ti ti-plus"></i> Tambah Data Pertama
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Username</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal Input</th>
                                        <th style="width: 250px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($monitoringList as $m): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($m['full_name']) ?></td>
                                        <td><?= esc($m['username']) ?></td>
                                        <td><span class="badge bg-primary">Ibu Hamil</span></td>
                                        <td>
                                            <span class="badge bg-<?= $m['status'] === 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($m['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($m['created_at'])) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('admin/monitoring/riwayat/'.$m['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="<?= base_url('admin/monitoring/input-kunjungan/'.$m['id']) ?>" class="btn btn-sm btn-success" title="Tambah Kunjungan">
                                                    <i class="ti ti-plus"></i>
                                                </a>
                                                <a href="<?= base_url('admin/monitoring/delete-monitoring/'.$m['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus semua data monitoring pasien ini?')" title="Hapus Monitoring">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
