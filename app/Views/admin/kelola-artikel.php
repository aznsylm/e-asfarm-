<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2>Kelola Artikel</h2>
                    <p class="text-muted mb-0">Manajemen artikel dan approval</p>
                </div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalArtikel">
                    <i class="bi bi-plus-circle"></i> Tambah Artikel
                </button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab">
                                <i class="bi bi-check-circle"></i> Published 
                                <span class="badge bg-success"><?= count(array_filter($articles, fn($a) => ($a['status'] ?? 'approved') === 'approved')) ?></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab">
                                <i class="bi bi-clock"></i> Pending 
                                <span class="badge bg-warning"><?= count($pending_articles) ?></span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab">
                                <i class="bi bi-x-circle"></i> Rejected 
                                <span class="badge bg-danger"><?= count(array_filter($articles, fn($a) => ($a['status'] ?? '') === 'rejected')) ?></span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Tab Published -->
                        <div class="tab-pane fade show active" id="approved" role="tabpanel">
                            <?php 
                            $approvedArticles = array_filter($articles, fn($a) => ($a['status'] ?? 'approved') === 'approved');
                            if(empty($approvedArticles)): 
                            ?>
                                <p class="text-muted text-center py-4"><i class="bi bi-inbox"></i> Tidak ada artikel yang dipublish</p>
                            <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">No</th>
                                            <th width="80">Gambar</th>
                                            <th>Judul</th>
                                            <th width="120">Kategori</th>
                                            <th width="150">Penulis</th>
                                            <th width="100">Tanggal</th>
                                            <th width="180">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($approvedArticles as $a): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php 
                                                $imgPath = file_exists(FCPATH.'uploads/articles/'.$a['image']) ? 'uploads/articles/'.$a['image'] : 'uploads/posts/'.$a['image'];
                                                ?>
                                                <img src="<?= base_url($imgPath) ?>" width="60" class="rounded" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2260%22%3E%3Crect fill=%22%23ddd%22 width=%2260%22 height=%2260%22/%3E%3C/svg%3E'">
                                            </td>
                                            <td>
                                                <strong><?= esc($a['title']) ?></strong>
                                                <br><small class="text-muted"><i class="bi bi-eye"></i> <?= number_format($a['views'] ?? 0) ?> views</small>
                                            </td>
                                            <td><span class="badge bg-info"><?= esc($a['category']) ?></span></td>
                                            <td><?= esc($a['author_name']) ?></td>
                                            <td><small><?= date('d/m/Y', strtotime($a['created_at'] ?? 'now')) ?></small></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="previewArtikel(<?= $a['id'] ?>)" title="Preview"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-warning btn-sm" onclick="editArtikel(<?= $a['id'] ?>)" title="Edit"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="hapusArtikel(<?= $a['id'] ?>)" title="Hapus"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Tab Pending -->
                        <div class="tab-pane fade" id="pending" role="tabpanel">
                            <?php if(empty($pending_articles)): ?>
                                <p class="text-muted text-center py-4"><i class="bi bi-inbox"></i> Tidak ada artikel yang menunggu persetujuan</p>
                            <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">No</th>
                                            <th width="80">Gambar</th>
                                            <th>Judul</th>
                                            <th width="120">Kategori</th>
                                            <th width="150">Penulis</th>
                                            <th width="100">Tanggal</th>
                                            <th width="220">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($pending_articles as $p): ?>
                                        <tr class="table-warning">
                                            <td><?= $no++ ?></td>
                                            <td><img src="<?= base_url('uploads/articles/'.$p['image']) ?>" width="60" class="rounded" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2260%22%3E%3Crect fill=%22%23ddd%22 width=%2260%22 height=%2260%22/%3E%3C/svg%3E'"></td>
                                            <td><strong><?= esc($p['title']) ?></strong></td>
                                            <td><span class="badge bg-warning text-dark"><?= esc($p['category']) ?></span></td>
                                            <td><?= esc($p['author_name']) ?></td>
                                            <td><small><?= date('d/m/Y', strtotime($p['created_at'] ?? 'now')) ?></small></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="previewArtikel(<?= $p['id'] ?>)" title="Preview"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-success btn-sm" onclick="setujuiArtikel(<?= $p['id'] ?>)" title="Setujui"><i class="bi bi-check"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="tolakArtikel(<?= $p['id'] ?>)" title="Tolak"><i class="bi bi-x"></i></button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Tab Rejected -->
                        <div class="tab-pane fade" id="rejected" role="tabpanel">
                            <?php 
                            $rejectedArticles = array_filter($articles, fn($a) => ($a['status'] ?? '') === 'rejected');
                            if(empty($rejectedArticles)): 
                            ?>
                                <p class="text-muted text-center py-4"><i class="bi bi-inbox"></i> Tidak ada artikel yang ditolak</p>
                            <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="50">No</th>
                                            <th width="80">Gambar</th>
                                            <th>Judul</th>
                                            <th width="120">Kategori</th>
                                            <th width="150">Penulis</th>
                                            <th width="100">Tanggal</th>
                                            <th width="180">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($rejectedArticles as $r): ?>
                                        <tr class="table-danger">
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?php 
                                                $imgPath = file_exists(FCPATH.'uploads/articles/'.$r['image']) ? 'uploads/articles/'.$r['image'] : 'uploads/posts/'.$r['image'];
                                                ?>
                                                <img src="<?= base_url($imgPath) ?>" width="60" class="rounded" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2260%22 height=%2260%22%3E%3Crect fill=%22%23ddd%22 width=%2260%22 height=%2260%22/%3E%3C/svg%3E'">
                                            </td>
                                            <td><strong><?= esc($r['title']) ?></strong></td>
                                            <td><span class="badge bg-danger"><?= esc($r['category']) ?></span></td>
                                            <td><?= esc($r['author_name']) ?></td>
                                            <td><small><?= date('d/m/Y', strtotime($r['created_at'] ?? 'now')) ?></small></td>
                                            <td>
                                                <button class="btn btn-info btn-sm" onclick="previewArtikel(<?= $r['id'] ?>)" title="Preview"><i class="bi bi-eye"></i></button>
                                                <button class="btn btn-warning btn-sm" onclick="editArtikel(<?= $r['id'] ?>)" title="Edit"><i class="bi bi-pencil"></i></button>
                                                <button class="btn btn-danger btn-sm" onclick="hapusArtikel(<?= $r['id'] ?>)" title="Hapus"><i class="bi bi-trash"></i></button>
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
    </div>
</div>

<!-- MODALS -->
<?php include 'modals.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>

<style>
.nav-tabs .nav-link {
    color: #6c757d;
    font-weight: 500;
}
.nav-tabs .nav-link.active {
    color: #0d6efd;
    font-weight: 600;
}
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.02);
}
</style>

<?= $this->endSection() ?>
