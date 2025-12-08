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
    
    <?php if(!empty($alertCount) && $alertCount > 0): ?>
    <div class="alert alert-warning mb-3 d-flex justify-content-between align-items-center">
        <div>
            <strong>Alert Kesehatan:</strong> Ditemukan <?= $alertCount ?> kondisi yang perlu perhatian
        </div>
        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#alertModal">Lihat Detail</button>
    </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="<?= base_url('admin/monitoring/dashboard') ?>" class="btn btn-outline-secondary btn-sm mb-2">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                    <h2>Monitoring Kesehatan Remaja</h2>
                    <p class="text-muted">Kelola data monitoring kesehatan remaja (10-19 tahun)</p>
                </div>
                <a href="<?= base_url('admin/monitoring/remaja/input') ?>" class="btn btn-primary">
                    <i class="ti ti-plus"></i> Input Data Baru
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Daftar Remaja Monitoring</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <form method="GET" action="<?= base_url('admin/monitoring/remaja') ?>">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama remaja atau username..." value="<?= esc($search ?? '') ?>">
                                <button class="btn btn-primary" type="submit"><i class="ti ti-search"></i> Cari</button>
                                <?php if(!empty($search)): ?>
                                    <a href="<?= base_url('admin/monitoring/remaja') ?>" class="btn btn-secondary"><i class="ti ti-x"></i></a>
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                    <?php if(empty($monitoringList)): ?>
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada data monitoring remaja</p>
                            <a href="<?= base_url('admin/monitoring/remaja/input') ?>" class="btn btn-primary">
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
                                        <th>Padukuhan</th>
                                        <th>Tanggal Input</th>
                                        <th style="width: 250px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                                    foreach($monitoringList as $m): 
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($m['full_name']) ?></td>
                                        <td><?= esc($m['username']) ?></td>
                                        <td><?= esc($m['nama_padukuhan'] ?? '-') ?></td>
                                        <td><?= date('d/m/Y', strtotime($m['created_at'])) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('admin/monitoring/remaja/riwayat/'.$m['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="<?= base_url('admin/monitoring/remaja/input-kunjungan/'.$m['id']) ?>" class="btn btn-sm btn-success" title="Tambah Kunjungan">
                                                    <i class="ti ti-plus"></i>
                                                </a>
                                                <a href="<?= base_url('admin/monitoring/remaja/delete-monitoring/'.$m['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus semua data monitoring remaja ini?')" title="Hapus Monitoring">
                                                    <i class="ti ti-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if(!empty($monitoringList)): ?>
                            <div class="mt-3">
                                <?= $pager->links() ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Alert Detail -->
<div class="modal fade" id="alertModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Alert Kesehatan - Remaja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <strong>Kriteria Alert:</strong>
                    <ul class="mb-0 mt-2">
                        <li>Tekanan Darah Tinggi: Sistolik ≥140 atau Diastolik ≥90</li>
                        <li>Tidak Minum TTD: Dapat TTD tapi tidak diminum</li>
                        <li>Anemia: Ada gejala anemia</li>
                        <li>Tidak Sarapan: Tidak pernah sarapan</li>
                    </ul>
                </div>

                <?php if(!empty($alertData['td_tinggi'])): ?>
                <h6 class="mt-3">Tekanan Darah Tinggi (<?= count($alertData['td_tinggi']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA Wali</th><th>Tekanan Darah</th></tr></thead>
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

                <?php if(!empty($alertData['ttd'])): ?>
                <h6 class="mt-3">Tidak Minum TTD (<?= count($alertData['ttd']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA Wali</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['ttd'] as $item): ?>
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
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA Wali</th><th>Gejala</th></tr></thead>
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

                <?php if(!empty($alertData['sarapan'])): ?>
                <h6 class="mt-3">Tidak Sarapan (<?= count($alertData['sarapan']) ?>)</h6>
                <table class="table table-sm table-bordered">
                    <thead><tr><th>No</th><th>Nama</th><th>No HP/WA Wali</th><th>Kebiasaan</th></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($alertData['sarapan'] as $item): ?>
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


