<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Kelola Artikel</h2>
            <p class="text-muted">Manajemen artikel dan approval</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Data Artikel</h5>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalArtikel">
                        <i class="bi bi-plus"></i> Tambah
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($articles as $a): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php 
                                    $imgPath = file_exists(FCPATH.'uploads/articles/'.$a['image']) ? 'uploads/articles/'.$a['image'] : 'uploads/posts/'.$a['image'];
                                    ?>
                                    <img src="<?= base_url($imgPath) ?>" width="50" class="rounded" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2250%22 height=%2250%22%3E%3Crect fill=%22%23ddd%22 width=%2250%22 height=%2250%22/%3E%3C/svg%3E'">
                                </td>
                                <td><?= esc($a['title']) ?></td>
                                <td><span class="badge bg-info"><?= esc($a['category']) ?></span></td>
                                <td><?= esc($a['author_name']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editArtikel(<?= $a['id'] ?>)"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btn-danger btn-sm" onclick="hapusArtikel(<?= $a['id'] ?>)"><i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Artikel Menunggu Persetujuan <span class="badge bg-danger"><?= count($pending_articles) ?></span></h5>
                </div>
                <div class="card-body">
                    <?php if(empty($pending_articles)): ?>
                        <p class="text-muted">Tidak ada artikel yang menunggu persetujuan</p>
                    <?php else: ?>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($pending_articles as $p): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><img src="<?= base_url('uploads/articles/'.$p['image']) ?>" width="50" class="rounded" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2250%22 height=%2250%22%3E%3Crect fill=%22%23ddd%22 width=%2250%22 height=%2250%22/%3E%3C/svg%3E'"></td>
                                <td><?= esc($p['title']) ?></td>
                                <td><span class="badge bg-warning"><?= esc($p['category']) ?></span></td>
                                <td><?= esc($p['author_name']) ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="setujuiArtikel(<?= $p['id'] ?>)"><i class="bi bi-check"></i> Setujui</button>
                                    <button class="btn btn-danger btn-sm" onclick="tolakArtikel(<?= $p['id'] ?>)"><i class="bi bi-x"></i> Tolak</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODALS -->
<?php include 'modals.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>

<?= $this->endSection() ?>
