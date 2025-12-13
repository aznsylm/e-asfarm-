<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Data Poster</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPoster">
            <i class="fas fa-plus"></i> Tambah
        </button>
    </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Thumbnail</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Link</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                    foreach($posters as $p): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><img src="<?= base_url('uploads/posters/'.$p['thumbnail']) ?>" width="50" class="rounded" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2250%22 height=%2250%22%3E%3Crect fill=%22%23ddd%22 width=%2250%22 height=%2250%22/%3E%3C/svg%3E'"></td>
                        <td><?= esc($p['title']) ?></td>
                        <td>
                            <?php if(!empty($p['categories'])): ?>
                                <?php foreach($p['categories'] as $cat): ?>
                                    <span class="badge bg-secondary"><?= esc($cat['name']) ?></span>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="badge bg-secondary"><?= esc($p['category']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td><a href="<?= esc($p['link_drive']) ?>" target="_blank" class="btn btn-sm btn-info"><i class="bi bi-link"></i></a></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editPoster(<?= $p['id'] ?>)"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="hapusPoster(<?= $p['id'] ?>)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if($pager): ?>
        <div class="card-footer">
            <?= $pager->links() ?>
        </div>
        <?php endif; ?>
    </div>

<!-- MODALS -->
<?php include 'modals.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>

<?= $this->endSection() ?>
