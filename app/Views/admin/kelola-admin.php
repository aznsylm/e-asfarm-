<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Data Admin</h3>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalPengguna" onclick="setModalTitle('Tambah Admin')">
            <i class="fas fa-plus"></i> Tambah
        </button>
    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Padukuhan</th>
                                    <th style="width: 200px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($users as $u): ?>
                                <?php if($u['role'] === 'admin' || $u['role'] === 'superadmin'): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($u['username']) ?> <span class="badge bg-<?= $u['role'] === 'superadmin' ? 'danger' : 'warning' ?>"><?= ucfirst($u['role']) ?></span></td>
                                    <td><?= esc($u['email']) ?></td>
                                    <td><?= esc($u['full_name'] ?? '-') ?></td>
                                    <td>
                                        <?php 
                                        if($u['padukuhan_id']) {
                                            $padukuhanModel = new \App\Models\PadukuhanModel();
                                            $padukuhan = $padukuhanModel->find($u['padukuhan_id']);
                                            echo esc($padukuhan['nama_padukuhan'] ?? '-');
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($u['role'] === 'superadmin'): ?>
                                            <span class="badge bg-warning">Protected</span>
                                        <?php else: ?>
                                            <a href="<?= base_url('admin/user-detail/'.$u['id']) ?>" class="btn btn-info btn-sm" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                            <button class="btn btn-warning btn-sm" onclick="editPengguna(<?= $u['id'] ?>)"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btn-danger btn-sm" onclick="hapusPengguna(<?= $u['id'] ?>)"><i class="bi bi-trash"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

<!-- MODALS -->
<?php include 'modals.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/admin-tab.js') ?>"></script>
<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>

<?= $this->endSection() ?>

