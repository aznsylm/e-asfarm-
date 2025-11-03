<?= $this->extend('layouts/app'); ?>

<?= $this->section('head'); ?>
<!-- SEO Meta Tags -->
<title><?= esc($artikel['seo_title'] ?: $artikel['title']); ?> - E-Asfarm</title>
<meta name="description" content="<?= esc($artikel['meta_description'] ?: substr(strip_tags($artikel['content']), 0, 160)); ?>">
<meta name="keywords" content="<?= esc($artikel['category']); ?>, kesehatan, E-Asfarm">
<meta name="author" content="<?= esc($artikel['author_name']); ?>">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="article">
<meta property="og:url" content="<?= current_url(); ?>">
<meta property="og:title" content="<?= esc($artikel['seo_title'] ?: $artikel['title']); ?>">
<meta property="og:description" content="<?= esc($artikel['meta_description'] ?: substr(strip_tags($artikel['content']), 0, 160)); ?>">
<?php 
$imgPath = file_exists(FCPATH.'uploads/articles/'.$artikel['image']) ? 'uploads/articles/'.$artikel['image'] : 'assets/images/blog/'.$artikel['image'];
?>
<meta property="og:image" content="<?= base_url($imgPath); ?>">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?= current_url(); ?>">
<meta property="twitter:title" content="<?= esc($artikel['seo_title'] ?: $artikel['title']); ?>">
<meta property="twitter:description" content="<?= esc($artikel['meta_description'] ?: substr(strip_tags($artikel['content']), 0, 160)); ?>">
<meta property="twitter:image" content="<?= base_url($imgPath); ?>">

<!-- Canonical URL -->
<link rel="canonical" href="<?= current_url(); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="main-wrapper overflow-hidden">
    <!-- ------------------------------------- -->
    <!-- Banner Start -->
    <!-- ------------------------------------- -->
    <section class="pt-5 bg-light-gray">
        <div class="container-fluid">
            <div class="text-center">
                <div class="d-flex align-items-center justify-content-center gap-6">
                    <a href="<?= base_url('/'); ?>" class="text-muted fw-bolder link-primary fs-3 text-uppercase">
                        E-Asfarm
                    </a>
                    <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-5 text-muted"></iconify-icon>
                    <a href="#" class="text-muted link-primary fw-bolder fs-3 text-uppercase">
                        Artikel
                    </a>
                    <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-5 text-muted"></iconify-icon>
                    <a href="#" class="text-primary link-primary fw-bolder fs-3 text-uppercase">
                        <?= esc($artikel['category']); ?>
                    </a>
                </div>
                <h2 class="fs-15 fw-bolder my-9">
                    <?= esc($artikel['title']); ?>
                </h2>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-circle fs-2"></i>
                        <p class="mb-0 fs-2 fw-semibold"><?= date('d M Y', strtotime($artikel['created_at'])); ?></p>
                    </div>
                </div>
            </div>
            <div class="mt-5 d-lg-block">
                <?php 
                $imgPath = file_exists(FCPATH.'uploads/articles/'.$artikel['image']) ? 'uploads/articles/'.$artikel['image'] : 'assets/images/blog/'.$artikel['image'];
                ?>
                <img src="<?= base_url($imgPath); ?>" alt="<?= esc($artikel['title']); ?>" class="rounded-3 img-fluid" style="width: 100%; max-height: 500px; object-fit: cover;">
            </div>
        </div>
    </section>
    <!-- ------------------------------------- -->
    <!-- Banner End -->
    <!-- ------------------------------------- -->

    <?php if (session()->getFlashdata('update')) : ?>
        <p class="alert alert-success"><?php echo session()->getFlashdata('update'); ?></p>
    <?php endif; ?>
    <!-- ------------------------------------- -->
    <!-- Details Start -->
    <!-- ------------------------------------- -->
    <section class="pt-md-13 pb-md-11 bg-light-gray">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content - First on Mobile -->
                <div class="col-lg-8 order-1 order-lg-2 mt-2 mb-4">
                    <div class="bg-white rounded-3 shadow-sm">
                        <div class="p-4 p-md-5 text-dark" style="text-align: justify; line-height: 1.7;">
                            <?php
                            $content = $artikel['content'] ?? $artikel['body'] ?? '';
                            $content = str_replace('contenteditable="true"', '', $content);
                            $content = str_replace('data-gramm="false"', '', $content);
                            $content = strip_tags($content, '<p><strong><em><u><a><ol><ul><li><br><h1><h2><h3><h4><h5><h6><img><blockquote><pre><code>');
                            ?>
                            <?= $content; ?>
                        </div>
                    </div>
                    <?php if (isset(auth()->user()->id)) : ?>
                        <?php if ($artikel['author_id'] == auth()->user()->id) : ?>
                            <div class="mt-3">
                                <a href="<?= route_to('artikel.hapus', $artikel['id']); ?>" class="btn btn-danger me-2" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</a>
                                <a href="<?= route_to('artikel.edit', $artikel['id']); ?>" class="btn btn-warning">Edit</a>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                
                <!-- Sidebar - Second on Mobile -->
                <div class="col-lg-4 order-2 order-lg-1 mt-2 mb-2">
                    <div class="bg-white rounded-3 shadow-sm">
                        <!-- Author Section -->
                        <div class="p-4 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <i class="ti ti-user-circle fs-6 text-primary"></i>
                                <div>
                                    <p class="mb-0 text-dark fs-4 fw-semibold">Penulis</p>
                                    <p class="mb-0 text-muted fs-3"><?= esc($artikel['author_name']); ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Categories Section -->
                        <div class="p-4 border-bottom">
                            <h5 class="fs-4 fw-bold text-dark mb-3">Kategori Artikel</h5>
                            <div class="d-flex flex-column gap-2">
                                <?php foreach ($numCategories as $category) : ?>
                                    <a href="<?= base_url('artikel/' . strtolower($category['name'])); ?>" class="d-flex justify-content-between align-items-center text-decoration-none p-2 rounded hover-bg-light">
                                        <span class="text-dark fs-3"><?= esc($category['name']); ?></span>
                                        <span class="badge bg-light-primary text-primary"><?= $category['count_posts']; ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <!-- Share Section -->
                        <div class="p-4">
                            <h5 class="fs-4 fw-bold text-dark mb-3">Bagikan Artikel</h5>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()); ?>" target="_blank" class="btn btn-light-primary btn-sm d-flex align-items-center gap-2" data-bs-toggle="tooltip" data-bs-title="Facebook">
                                    <i class="ti ti-brand-facebook fs-4"></i>
                                    <span class="d-none d-sm-inline">Facebook</span>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()); ?>&text=<?= urlencode($artikel['title']); ?>" target="_blank" class="btn btn-light-info btn-sm d-flex align-items-center gap-2" data-bs-toggle="tooltip" data-bs-title="Twitter">
                                    <i class="ti ti-brand-twitter fs-4"></i>
                                    <span class="d-none d-sm-inline">Twitter</span>
                                </a>
                                <a href="https://wa.me/?text=<?= urlencode($artikel['title'] . ' - ' . current_url()); ?>" target="_blank" class="btn btn-light-success btn-sm d-flex align-items-center gap-2" data-bs-toggle="tooltip" data-bs-title="WhatsApp">
                                    <i class="ti ti-brand-whatsapp fs-4"></i>
                                    <span class="d-none d-sm-inline">WhatsApp</span>
                                </a>
                                <a href="https://www.instagram.com/" target="_blank" class="btn btn-light-danger btn-sm d-flex align-items-center gap-2" data-bs-toggle="tooltip" data-bs-title="Instagram" onclick="navigator.clipboard.writeText('<?= $artikel['title'] . ' - ' . current_url(); ?>'); alert('Link artikel telah disalin! Silakan paste di Instagram.');">
                                    <i class="ti ti-brand-instagram fs-4"></i>
                                    <span class="d-none d-sm-inline">Instagram</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Menghapus elemen Quill yang tidak diinginkan setelah halaman dimuat
        document.addEventListener("DOMContentLoaded", function() {
            var unwantedElements = document.querySelectorAll('.ql-clipboard, .ql-tooltip');
            unwantedElements.forEach(function(element) {
                element.remove();
            });
        });
    </script>
    <!-- ------------------------------------- -->
    <!-- Details End -->
    <!-- ------------------------------------- -->


</div>

<?= $this->endSection(); ?>