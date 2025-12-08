<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="row">
        <div class="col-12">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body p-4">
                    <h2 class="mb-2"><i class="bi bi-hand-wave"></i> Selamat Datang, <?= esc($user->username) ?>!</h2>
                    <p class="mb-0">Terima kasih telah bergabung dengan E-Asfarm. Mari berbagi pengetahuan kesehatan untuk masyarakat!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Artikel -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">
                    <i class="bi bi-file-text text-primary" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-0 text-primary"><?= $totalArtikel ?></h3>
                    <p class="text-muted mb-0">Total Artikel</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <i class="bi bi-clock-history text-warning" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-0 text-warning"><?= $artikelPending ?></h3>
                    <p class="text-muted mb-0">Menunggu Review</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                    <h3 class="mt-2 mb-0 text-success"><?= $artikelApproved ?></h3>
                    <p class="text-muted mb-0">Dipublikasikan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-lightning-charge"></i> Akses Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <a href="<?= route_to('pengguna.artikel') ?>" class="btn btn-primary w-100 py-3">
                                <i class="bi bi-plus-circle"></i> Buat Artikel Baru
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= route_to('pengguna.artikel') ?>" class="btn btn-outline-primary w-100 py-3">
                                <i class="bi bi-folder"></i> Kelola Artikel Saya
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= route_to('pengguna.monitoring') ?>" class="btn btn-outline-success w-100 py-3">
                                <i class="bi bi-heart-pulse"></i> Monitoring Kesehatan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Penting -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Informasi Penting</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-light border">
                        <h6 class="alert-heading"><i class="bi bi-shield-check"></i> Proses Review Artikel</h6>
                        <p class="mb-0 small">Setiap artikel yang Anda submit akan direview oleh admin untuk memastikan kualitas dan keakuratan informasi kesehatan sebelum dipublikasikan.</p>
                    </div>
                    <div class="alert alert-light border">
                        <h6 class="alert-heading"><i class="bi bi-clock"></i> Waktu Review</h6>
                        <p class="mb-0 small">Proses review biasanya memakan waktu 1-3 hari kerja. Anda akan melihat status artikel di halaman "Artikel Saya".</p>
                    </div>
                    <div class="alert alert-light border mb-0">
                        <h6 class="alert-heading"><i class="bi bi-pencil-square"></i> Edit Artikel</h6>
                        <p class="mb-0 small">Artikel yang ditolak atau pending dapat Anda edit dan submit ulang untuk direview kembali.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-lightbulb"></i> Tips Menulis Artikel</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <strong>Judul Menarik:</strong> Gunakan judul yang informatif dan mudah dipahami
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <strong>Konten Berkualitas:</strong> Minimal 300 kata dengan informasi yang bermanfaat
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <strong>Gambar Relevan:</strong> Gunakan gambar berkualitas (JPG/PNG/WEBP, max 2MB)
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <strong>Kategori Tepat:</strong> Pilih kategori yang sesuai (Farmasi/Gizi/Bidan)
                        </li>
                        <li class="mb-0">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <strong>Konten Original:</strong> Pastikan tidak melanggar hak cipta
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bantuan -->
    <div class="row">
        <div class="col-12">
            <div class="card border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-question-circle text-warning" style="font-size: 2rem;"></i>
                        <div class="ms-3">
                            <h6 class="mb-1">Butuh Bantuan?</h6>
                            <p class="mb-0 text-muted">Jika ada pertanyaan atau kendala, silakan hubungi admin melalui menu kontak atau WhatsApp.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>