<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Kelola Unduhan</h2>
            <p class="text-muted">Manajemen file unduhan</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Data Unduhan</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUnduhan">
                <i class="bi bi-plus"></i> Tambah
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
                    foreach($downloads as $d): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><img src="<?= base_url('uploads/downloads/'.$d['thumbnail']) ?>" width="50" class="rounded" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2250%22 height=%2250%22%3E%3Crect fill=%22%23ddd%22 width=%2250%22 height=%2250%22/%3E%3C/svg%3E'"></td>
                        <td><?= esc($d['title']) ?></td>
                        <td><span class="badge bg-secondary"><?= esc($d['category']) ?></span></td>
                        <td><a href="<?= esc($d['link_drive']) ?>" target="_blank" class="btn btn-sm btn-info"><i class="bi bi-link"></i></a></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editUnduhan(<?= $d['id'] ?>)"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="hapusUnduhan(<?= $d['id'] ?>)"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php if($pager): ?>
            <div class="mt-3">
                <?= $pager->links() ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODALS -->
<?php include 'modals.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>

<?= $this->endSection() ?>
