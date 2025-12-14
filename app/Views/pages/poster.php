<?php $this->extend('layouts/app') ?>
<?= $this->section('title') ?>Poster Kesehatan<?= $this->endSection() ?>
<?= $this->section('content') ?>

<style>
.poster-card{transition:all .3s;}
.poster-card:hover{transform:translateY(-5px);box-shadow:0 8px 16px rgba(0,0,0,0.15);}
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
            <h3 class="fw-bold text-teal">Poster Kesehatan</h3>
            <div class="d-flex align-items-center breadcrumb-links" style="gap: 0.5rem;">
                <a href="<?= base_url('/'); ?>" class="text-muted fw-bold link-primary text-uppercase" style="font-size: 0.875rem;">
                    E-asfarm
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="text-muted" style="font-size: 1rem;"></iconify-icon>
                <a href="#" class="text-primary link-primary fw-bold text-uppercase" style="font-size: 0.875rem;">
                    Poster
                </a>
            </div>
        </div>
    </div>
</section>

<?php foreach($categories as $cat): ?>
<?php 
$slug = strtolower(str_replace([' ', '&'], ['-', ''], $cat['name']));
$posters = $postersByCategory[$cat['name']] ?? [];
?>
<!-- <?= esc($cat['name']) ?> Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row g-4 mb-3">
            <div class="col-12">
                <h4 class="fw-bold text-teal"><?= esc($cat['name']) ?></h4>
            </div>
            <?php if(!empty($posters)): ?>
                <?php foreach($posters as $index => $item): ?>
                <div class="col-12 col-md-4 col-lg-3 poster-item-<?= $slug ?> <?= ($index >= 1) ? 'd-none d-lg-block' : '' ?> <?= ($index >= 4) ? 'extra-poster-<?= $slug ?>' : '' ?>">
                    <div class="card h-100 border-0 shadow-sm rounded-8 poster-card">
                        <img src="<?= base_url('uploads/posters/'.$item['thumbnail']) ?>" 
                             class="card-img-top" 
                             style="height: 320px; object-fit: cover; cursor: pointer; border-radius: 8px 8px 0 0;" 
                             onclick="openImageModal(this.src)">
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
                    <p class="text-muted mt-3">Belum ada poster tersedia</p>
                </div>
            <?php endif; ?>
        </div>
        <?php if(!empty($posters) && count($posters) > 1): ?>
        <div class="row mb-5">
            <div class="col-12 text-center">
                <button class="btn btn-outline-teal" onclick="togglePosters('<?= $slug ?>')" id="toggleBtn<?= ucfirst($slug) ?>">
                    <span id="toggleText<?= ucfirst($slug) ?>">Lihat Lebih Banyak</span>
                </button>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php endforeach; ?>

<!-- Image Modal -->
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <span class="image-modal-close">&times;</span>
    <img id="modalImage" src="" alt="Detail">
</div>

<style>
.image-modal{display:none;position:fixed;z-index:9999;left:0;top:0;width:100%;height:100%;background:rgba(0,0,0,0.9);cursor:zoom-out;}
.image-modal img{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);max-width:90%;max-height:90%;object-fit:contain;}
.image-modal-close{position:absolute;top:20px;right:30px;color:#fff;font-size:40px;font-weight:bold;cursor:pointer;z-index:10000;}
.image-modal-close:hover{color:#ccc;}
</style>

<script>
function openImageModal(src) {
    document.getElementById('imageModal').style.display = 'block';
    document.getElementById('modalImage').src = src;
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeImageModal();
});

const toggleStates = {};

function togglePosters(category) {
    const allPosters = document.querySelectorAll('.poster-item-' + category);
    const extraPosters = document.querySelectorAll('.extra-poster-' + category);
    const toggleText = document.getElementById('toggleText' + category.charAt(0).toUpperCase() + category.slice(1));
    const isDesktop = window.innerWidth >= 992;
    
    if (!toggleStates[category]) toggleStates[category] = false;
    toggleStates[category] = !toggleStates[category];
    
    if (toggleStates[category]) {
        // Show all
        allPosters.forEach(poster => {
            poster.classList.remove('d-none');
            poster.classList.remove('d-lg-block');
        });
        toggleText.textContent = 'Lihat Lebih Sedikit';
    } else {
        // Reset to default (1 mobile, 4 desktop)
        allPosters.forEach((poster, index) => {
            if (isDesktop) {
                // Desktop: show first 4
                if (index >= 4) {
                    poster.classList.add('d-none');
                } else {
                    poster.classList.remove('d-none');
                }
            } else {
                // Mobile: show only first 1
                if (index >= 1) {
                    poster.classList.add('d-none');
                } else {
                    poster.classList.remove('d-none');
                }
            }
        });
        toggleText.textContent = 'Lihat Lebih Banyak';
    }
}
</script>

<?= $this->endSection() ?>
