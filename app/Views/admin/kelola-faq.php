<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Data Tanya Jawab</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalFaq">
            <i class="fas fa-plus"></i> Tambah
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
