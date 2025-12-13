<?php $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Modul Edukasi<?= $this->endSection() ?>
<?= $this->section('content') ?>

<style>
.modul-card{transition:all .3s;}
.modul-card:hover{transform:translateY(-5px);box-shadow:0 8px 16px rgba(0,0,0,0.15);}
.btn-teal{background-color:#047d78;color:#fff;border:none;}
.btn-teal:hover{background-color:#036663;color:#fff;}
@media (max-width: 767.98px) {
    .breadcrumb-mobile {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 0.5rem !important;
    }
    .breadcrumb-links {
        font-size: 0.75rem !important;
        gap: 0.5rem !important;
    }
    .breadcrumb-links iconify-icon {
        font-size: 0.875rem !important;
    }
}
</style>

<!-- Breadcrumb -->
<section class="py-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between breadcrumb-mobile">
            <h3 class="fw-bold text-teal">Modul Edukasi</h3>
            <div class="d-flex align-items-center breadcrumb-links" style="gap: 0.5rem;">
                <a href="<?= base_url('/'); ?>" class="text-muted fw-bold link-primary text-uppercase" style="font-size: 0.875rem;">
                    E-asfarm
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="text-muted" style="font-size: 1rem;"></iconify-icon>
                <a href="#" class="text-primary link-primary fw-bold text-uppercase" style="font-size: 0.875rem;">
                    Modul
                </a>
            </div>
        </div>
    </div>
</section>

<?php foreach($categories as $cat): ?>
<?php 
$slug = strtolower(str_replace(' ', '-', $cat['name']));
$moduls = $modulsByCategory[$cat['name']] ?? [];
?>
<!-- <?= esc($cat['name']) ?> Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row g-4 mb-3">
            <div class="col-12">
                <h4 class="fw-bold text-teal"><?= esc($cat['name']) ?></h4>
            </div>
            <?php if(!empty($moduls)): ?>
                <?php foreach($moduls as $index => $item): ?>
                <div class="col-12 col-md-4 col-lg-3 modul-item-<?= $slug ?> <?= ($index >= 1) ? 'd-none d-lg-block' : '' ?> <?= ($index >= 4) ? 'extra-modul-<?= $slug ?>' : '' ?>">
                    <div class="card h-100 border-0 shadow-sm rounded-8 modul-card">
                        <img src="<?= base_url('uploads/moduls/'.$item['thumbnail']) ?>" 
                             class="card-img-top" 
                             style="height: 320px; object-fit: cover; cursor: pointer; border-radius: 8px 8px 0 0;" 
                             onclick="showPreview('<?= base_url('uploads/moduls/'.$item['thumbnail']) ?>', '<?= esc($item['title']) ?>', '<?= esc($item['link_drive']) ?>')">
                        <div class="card-body p-2">
                            <h6 class="card-title fw-bold text-dark mb-2" style="font-size: 0.9rem;"><?= esc($item['title']) ?></h6>
                            <a href="<?= esc($item['link_drive']) ?>" target="_blank" class="btn btn-teal btn-sm w-100">
                                <i class="fas fa-download me-1"></i>Unduh
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open text-muted" style="font-size: 3rem;"></i>
                    <p class="text-muted mt-3">Belum ada modul tersedia</p>
                </div>
            <?php endif; ?>
        </div>
        <?php if(!empty($moduls) && count($moduls) > 1): ?>
        <div class="row mb-5">
            <div class="col-12 text-center">
                <button class="btn btn-outline-teal" onclick="toggleModuls('<?= $slug ?>')" id="toggleBtn<?= ucfirst($slug) ?>">
                    <span id="toggleText<?= ucfirst($slug) ?>">Lihat Lebih Banyak</span>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endforeach; ?>

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

const toggleStates = {};

function toggleModuls(category) {
    const allModuls = document.querySelectorAll('.modul-item-' + category);
    const extraModuls = document.querySelectorAll('.extra-modul-' + category);
    const toggleText = document.getElementById('toggleText' + category.charAt(0).toUpperCase() + category.slice(1));
    const isDesktop = window.innerWidth >= 992;
    
    if (!toggleStates[category]) toggleStates[category] = false;
    toggleStates[category] = !toggleStates[category];
    
    if (toggleStates[category]) {
        allModuls.forEach(modul => {
            modul.classList.remove('d-none');
            modul.classList.remove('d-lg-block');
        });
        toggleText.textContent = 'Lihat Lebih Sedikit';
    } else {
        allModuls.forEach((modul, index) => {
            if (isDesktop) {
                if (index >= 4) {
                    modul.classList.add('d-none');
                } else {
                    modul.classList.remove('d-none');
                }
            } else {
                if (index >= 1) {
                    modul.classList.add('d-none');
                } else {
                    modul.classList.remove('d-none');
                }
            }
        });
        toggleText.textContent = 'Lihat Lebih Banyak';
    }
}
</script>

<?= $this->endSection() ?>
