<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
.download-card{transition:all .3s;}
.download-card:hover{transform:translateY(-5px);box-shadow:0 8px 16px rgba(0,0,0,0.15);}
.btn-teal{background-color:#047d78;color:#fff;border:none;}
.btn-teal:hover{background-color:#036663;color:#fff;}
</style>

<!-- Header Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h3 class="fw-bold text-teal">Unduhan Kesehatan</h3>
            </div>
        </div>
    </div>
</section>

<!-- Materi Edukasi Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row g-4 mb-5">
            <div class="col-12">
                <h4 class="fw-bold text-teal"><i class="fas fa-book me-2"></i>Materi Edukasi</h4>
            </div>
            <?php if(!empty($edukasi)): ?>
                <?php foreach($edukasi as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-8 download-card">
                        <img src="<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>" 
                             class="card-img-top" 
                             style="height: 220px; object-fit: cover; cursor: pointer; border-radius: 8px 8px 0 0;" 
                             onclick="showPreview('<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>', '<?= esc($item['title']) ?>', '<?= esc($item['link_drive']) ?>')">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold text-dark mb-3"><?= esc($item['title']) ?></h5>
                            <a href="<?= esc($item['link_drive']) ?>" target="_blank" class="btn btn-teal btn-sm">
                                <i class="fas fa-download me-1"></i>Unduh
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">Belum ada materi edukasi tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Panduan Kesehatan Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <h4 class="fw-bold text-teal"><i class="fas fa-file-alt me-2"></i>Panduan Kesehatan</h4>
            </div>
            <?php if(!empty($panduan)): ?>
                <?php foreach($panduan as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-8 download-card">
                        <img src="<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>" 
                             class="card-img-top" 
                             style="height: 220px; object-fit: cover; cursor: pointer; border-radius: 8px 8px 0 0;" 
                             onclick="showPreview('<?= base_url('uploads/downloads/'.$item['thumbnail']) ?>', '<?= esc($item['title']) ?>', '<?= esc($item['link_drive']) ?>')">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold text-dark mb-3"><?= esc($item['title']) ?></h5>
                            <a href="<?= esc($item['link_drive']) ?>" target="_blank" class="btn btn-teal btn-sm">
                                <i class="fas fa-download me-1"></i>Unduh
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">Belum ada panduan tersedia</p>
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
                <img id="previewImage" src="" class="img-fluid rounded-8 shadow-lg mb-3" style="max-height: 80vh; width: auto;">
                <h4 class="text-white fw-bold" id="previewTitle"></h4>
                <a id="downloadLink" href="" target="_blank" class="btn btn-teal mt-2">
                    <i class="fas fa-download me-1"></i>Unduh File
                </a>
            </div>
        </div>
    </div>
</div>

<style>
#previewModal .modal-dialog{display:flex;align-items:center;min-height:calc(100% - 1rem);}
#previewModal .modal-content{background:rgba(0,0,0,0.9)!important;}
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
