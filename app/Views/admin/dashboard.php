<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Dashboard <?= session()->get('role') === 'superadmin' ? 'Super Admin' : 'Admin' ?></h2>
            <p class="text-muted">Kelola data pengguna, artikel, FAQ, dan unduhan</p>
        </div>
    </div>

    <div class="container-fluid">
        <ul class="nav nav-tabs" id="adminTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active" id="pengguna-tab" data-bs-toggle="tab" data-bs-target="#pengguna">
                    <i class="bi bi-people"></i> Pengguna
                </button>
            </li>
            <?php if(session()->get('role') === 'superadmin'): ?>
            <li class="nav-item">
                <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin">
                    <i class="bi bi-shield-check"></i> Admin
                </button>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <button class="nav-link" id="artikel-tab" data-bs-toggle="tab" data-bs-target="#artikel">
                    <i class="bi bi-file-text"></i> Artikel
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="approval-tab" data-bs-toggle="tab" data-bs-target="#approval">
                    <i class="bi bi-check-circle"></i> Approval <span class="badge bg-danger"><?= count($pending_articles) ?></span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq">
                    <i class="bi bi-question-circle"></i> FAQ
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" id="unduhan-tab" data-bs-toggle="tab" data-bs-target="#unduhan">
                    <i class="bi bi-download"></i> Unduhan
                </button>
            </li>
        </ul>

        <div class="tab-content mt-3" id="adminTabContent">
            <!-- TAB PENGGUNA -->
            <div class="tab-pane fade show active" id="pengguna">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Data Pengguna</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPengguna" onclick="setModalTitle('Tambah Pengguna')">
                            <i class="bi bi-plus"></i> Tambah
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
                                <?php if($u['role'] === 'pengguna'): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($u['username']) ?> <?php if($u['role'] !== 'pengguna'): ?><span class="badge bg-<?= $u['role'] === 'superadmin' ? 'danger' : 'warning' ?>"><?= ucfirst($u['role']) ?></span><?php endif; ?></td>
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
                                        <?php if ($u['role'] === 'superadmin' && session()->get('role') !== 'superadmin'): ?>
                                            <span class="badge bg-secondary">Protected</span>
                                        <?php else: ?>
                                            <a href="<?= base_url('admin/user-detail/'.$u['id']) ?>" class="btn btn-info btn-sm" title="Lihat Detail"><i class="bi bi-eye"></i></a>
                                            <button class="btn btn-warning btn-sm" onclick="editPengguna(<?= $u['id'] ?>)"><i class="bi bi-pencil"></i></button>
                                            <?php if ($u['role'] !== 'superadmin'): ?>
                                                <button class="btn btn-danger btn-sm" onclick="hapusPengguna(<?= $u['id'] ?>)"><i class="bi bi-trash"></i></button>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Cannot Delete</span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TAB ADMIN (SuperAdmin Only) -->
            <?php if(session()->get('role') === 'superadmin'): ?>
            <div class="tab-pane fade" id="admin">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Data Admin</h5>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPengguna" onclick="setModalTitle('Tambah Admin')">
                            <i class="bi bi-plus"></i> Tambah Admin
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
            </div>
            <?php endif; ?>

            <!-- TAB ARTIKEL -->
            <div class="tab-pane fade" id="artikel">
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

            <!-- TAB APPROVAL -->
            <div class="tab-pane fade" id="approval">
                <div class="card">
                    <div class="card-header">
                        <h5>Artikel Menunggu Persetujuan</h5>
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

            <!-- TAB FAQ -->
            <div class="tab-pane fade" id="faq">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>Data FAQ</h5>
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
                                <?php $no=1; foreach($faqs as $f): ?>
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
                </div>
            </div>

            <!-- TAB UNDUHAN -->
            <div class="tab-pane fade" id="unduhan">
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
                                <?php $no=1; foreach($downloads as $d): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img src="<?= base_url('uploads/thumbnails/'.$d['thumbnail']) ?>" width="50" class="rounded" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2250%22 height=%2250%22%3E%3Crect fill=%22%23ddd%22 width=%2250%22 height=%2250%22/%3E%3C/svg%3E'"></td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- MODALS -->
<?php include 'modals.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/admin-tab.js') ?>"></script>
<script src="<?= base_url('assets/js/admin-dashboard.js') ?>"></script>

<?= $this->endSection() ?>
