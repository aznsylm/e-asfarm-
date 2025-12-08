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
                        <img src="<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover; cursor: pointer;" 
                             onclick="showPreview('<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>', '<?= esc($item['title']) ?>', '<?= esc($item['link_drive']) ?>')">
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
                        <img src="<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover; cursor: pointer;" 
                             onclick="showPreview('<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>', '<?= esc($item['title']) ?>', '<?= esc($item['link_drive']) ?>')">
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

<!-- Modal Preview -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 90%; max-height: 90vh;">
        <div class="modal-content bg-transparent border-0">
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1050;"></button>
            <div class="text-center p-3">
                <img id="previewImage" src="" class="img-fluid rounded shadow-lg mb-3" style="max-height: 80vh; width: auto;">
                <h4 class="text-white fw-bold" id="previewTitle"></h4>
                <a id="downloadLink" href="" target="_blank" class="btn btn-primary mt-2">
                    <i class="fas fa-download me-1"></i>Unduh File
                </a>
            </div>
        </div>
    </div>
</div>

<style>
#previewModal .modal-dialog {
    display: flex;
    align-items: center;
    min-height: calc(100% - 1rem);
}
#previewModal .modal-content {
    background: rgba(0, 0, 0, 0.9) !important;
}
</style>

<script>
function showPreview(imageUrl, title, downloadUrl) {
    document.getElementById('previewImage').src = imageUrl;
    document.getElementById('previewTitle').textContent = title;
    document.getElementById('downloadLink').href = downloadUrl;
    
    var modal = new bootstrap.Modal(document.getElementById('previewModal'));
    modal.show();
}
</script>

<?= $this->endSection() ?>
