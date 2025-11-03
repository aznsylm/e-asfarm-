<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Dashboard Pengguna</h2>
            <p>Selamat datang, <strong><?= esc($user->username) ?></strong>!</p>
        </div>
    </div>

    <!-- Statistik Artikel -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Artikel</h5>
                    <h3 class="text-primary"><?= $totalArtikel ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Menunggu Review</h5>
                    <h3 class="text-warning"><?= $artikelPending ?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Disetujui</h5>
                    <h3 class="text-success"><?= $artikelApproved ?></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <a href="<?= route_to('pengguna.artikel') ?>" class="btn btn-primary me-2">Buat Artikel Baru</a>
                    <a href="<?= route_to('pengguna.artikel') ?>" class="btn btn-outline-primary me-2">Lihat Artikel Saya</a>
                    <a href="/logout" class="btn btn-outline-danger">Keluar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Artikel Terbaru -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Artikel Terbaru Saya</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($artikelTerbaru)): ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($artikelTerbaru as $artikel): ?>
                                    <tr>
                                        <td><?= esc($artikel['title']) ?></td>
                                        <td>
                                            <?php
                                            $badgeClass = match($artikel['status']) {
                                                'draft' => 'bg-secondary',
                                                'pending' => 'bg-warning',
                                                'approved' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= ucfirst($artikel['status']) ?></span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($artikel['created_at'])) ?></td>
                                        <td>
                                            <?php if ($artikel['status'] === 'approved'): ?>
                                                <a href="<?= base_url('artikel/baca/' . ($artikel['slug'] ?: $artikel['id'])) ?>" class="btn btn-sm btn-outline-primary" target="_blank">Lihat</a>
                                            <?php else: ?>
                                                <a href="<?= route_to('pengguna.artikel') ?>" class="btn btn-sm btn-outline-primary">Kelola</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Belum ada artikel. <a href="<?= route_to('pengguna.artikel') ?>">Buat artikel pertama Anda!</a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Tips & Info -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Tips Menulis Artikel</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Gunakan judul yang menarik dan informatif</li>
                        <li>Tulis konten yang bermanfaat untuk pembaca</li>
                        <li>Gunakan gambar yang relevan dan berkualitas</li>
                        <li>Artikel akan direview oleh admin sebelum dipublikasi</li>
                        <li>Pastikan konten original dan tidak melanggar hak cipta</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>