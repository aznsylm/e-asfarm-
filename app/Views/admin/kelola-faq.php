<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Kelola Tanya Jawab</h2>
            <p class="text-muted">Manajemen pertanyaan dan jawaban</p>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Data Tanya Jawab</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFaq">
                <i class="bi bi-plus"></i> Tambah
            </button>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                    foreach($faqs as $f): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc(substr($f['pertanyaan'], 0, 50)) ?>...</td>
                        <td><span class="badge bg-success"><?= esc($f['category']) ?></span></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editFaq(<?= $f['id'] ?>)"><i class="bi bi-pencil"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="hapusFaq(<?= $f['id'] ?>)"><i class="bi bi-trash"></i></button>
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
