<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<section class="py-4 py-md-5 bg-light-gray">
    <div class="container">
        <h2 class="fs-8 fs-md-15 fw-bolder mb-3">Unduhan Kesehatan</h2>
        <p class="text-muted">Akses materi edukasi dan panduan kesehatan</p>
    </div>
</section>

<section class="py-4 py-md-5">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-12"><h4 class="fw-bold"><i class="fas fa-book me-2 text-primary"></i>Materi Edukasi</h4></div>
            <?php if(!empty($edukasi)): ?>
                <?php foreach($edukasi as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= base_url('uploads/thumbnails/'.$item['thumbnail']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item['title']) ?></h5>
                            <a href="<?= esc($item['link_drive']) ?>" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fas fa-download me-1"></i>Unduh
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada materi edukasi tersedia</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="row g-4">
            <div class="col-12"><h4 class="fw-bold"><i class="fas fa-file-alt me-2 text-success"></i>Panduan Kesehatan</h4></div>
            <?php if(!empty($panduan)): ?>
                <?php foreach($panduan as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= base_url('uploads/thumbnails/'.$item['thumbnail']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($item['title']) ?></h5>
                            <a href="<?= esc($item['link_drive']) ?>" target="_blank" class="btn btn-success btn-sm">
                                <i class="fas fa-download me-1"></i>Unduh
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada panduan tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
