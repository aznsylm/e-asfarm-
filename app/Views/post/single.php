<?= $this->extend('layouts/app'); ?>

<?= $this->section('head'); ?>
<title><?= esc($artikel['seo_title'] ?: $artikel['title']); ?></title>
<meta name="description" content="<?= esc($artikel['meta_description'] ?: substr(strip_tags($artikel['content']), 0, 160)); ?>">
<meta name="keywords" content="<?= esc($artikel['category']); ?>, kesehatan, E-Asfarm">
<meta name="author" content="<?= esc($artikel['author_name']); ?>">
<meta property="og:type" content="article">
<meta property="og:url" content="<?= current_url(); ?>">
<meta property="og:title" content="<?= esc($artikel['seo_title'] ?: $artikel['title']); ?>">
<?php 
$imgPath = file_exists(FCPATH.'uploads/articles/'.$artikel['image']) ? 'uploads/articles/'.$artikel['image'] : 'assets/images/blog/'.$artikel['image'];
?>
<meta property="og:image" content="<?= base_url($imgPath); ?>">
<link rel="canonical" href="<?= current_url(); ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<style>
    .card {
    border-radius: 0 !important;
}
.artikel-list-item{display:block;padding:12px 15px;border-bottom:1px solid #e9ecef;color:#333;text-decoration:none;transition:all .3s;}
.artikel-list-item:hover{background:#f8f9fa;color:#047d78;padding-left:20px;}
.btn-teal{background-color:#047d78;color:#fff;border:none;}
.btn-teal:hover{background-color:#036663;color:#fff;}
.article-content{text-align:justify;line-height:1.7;font-size:0.9rem;}
@media (max-width:767.98px){
    .article-content{padding:1rem !important;font-size:1rem;line-height:1.8;}
}
</style>

<div class="main-wrapper overflow-hidden">
    <?php if (session()->getFlashdata('update')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('update'); ?></div>
    <?php endif; ?>

    <section class="py-4">
        <div class="container-fluid">
            <div class="row g-4">
                <!-- Main Content 70% -->
                <div class="col-lg-8">
                    <!-- Gambar Artikel -->
                    <div class="mb-4">
                        <img src="<?= base_url($imgPath); ?>" alt="<?= esc($artikel['title']); ?>" class="w-100" style="max-height: 500px; object-fit: contain; background: #f8f9fa;">
                    </div>
                    
                    <!-- Judul Artikel -->
                    <h2 class="fw-bold text-teal mb-3"><?= esc($artikel['title']); ?></h2>
                    
                    <!-- Info: Tanggal + Penulis -->
                    <div class="d-flex align-items-center gap-3 mb-4 text-muted">
                        <small><i class="ti ti-calendar"></i> <?= date('d M Y', strtotime($artikel['created_at'])); ?></small>
                        <small><i class="ti ti-user"></i> <?= esc($artikel['author_name']); ?></small>
                    </div>
                    
                    <!-- Konten Artikel -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4 text-gray article-content">
                            <?php
                            $content = $artikel['content'] ?? $artikel['body'] ?? '';
                            $content = str_replace('contenteditable="true"', '', $content);
                            $content = str_replace('data-gramm="false"', '', $content);
                            $content = strip_tags($content, '<p><strong><em><u><a><ol><ul><li><br><h1><h2><h3><h4><h5><h6><img><blockquote><pre><code>');
                            echo $content;
                            ?>
                        </div>
                    </div>
                    
                    <!-- Button Edit/Hapus -->
                    <?php if (isset(auth()->user()->id) && $artikel['author_id'] == auth()->user()->id) : ?>
                        <div class="mt-3">
                            <a href="<?= route_to('artikel.hapus', $artikel['id']); ?>" class="btn btn-danger me-2" onclick="return confirm('Yakin ingin menghapus artikel ini?')">Hapus</a>
                            <a href="<?= route_to('artikel.edit', $artikel['id']); ?>" class="btn btn-warning">Edit</a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Sidebar 30% -->
                <div class="col-lg-4">
                    <!-- Artikel Terkait -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body p-0">
                            <div class="p-3 border-bottom">
                                <h5 class="fw-bold text-teal mb-0">Artikel Terkait</h5>
                            </div>
                            <div>
                                <?php if (!empty($relatedArticles)) : ?>
                                    <?php foreach (array_slice($relatedArticles, 0, 5) as $related) : ?>
                                        <a href="<?= base_url('artikel/baca/' . ($related['slug'] ?: $related['id'])); ?>" class="artikel-list-item">
                                            <?= esc($related['title']); ?>
                                        </a>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p class="text-muted p-3">Belum ada artikel terkait</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Poster -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-3">
                            <h5 class="fw-bold text-teal mb-3">Poster</h5>
                            <?php if (!empty($latestPosters)) : ?>
                                <?php foreach (array_slice($latestPosters, 0, 2) as $index => $poster) : ?>
                                    <div class="text-center mb-3 <?= $index === 0 ? 'pb-3 border-bottom' : '' ?> <?= $index === 1 ? 'd-none d-lg-block' : '' ?>">
                                        <img src="<?= base_url('uploads/posters/' . $poster['thumbnail']); ?>" alt="<?= esc($poster['title']); ?>" class="w-100 mb-2" style="max-height: 250px; object-fit: contain; background: #f8f9fa;">
                                        <p class="fw-semibold text-dark mb-2"><?= esc($poster['title']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                                <div class="text-center">
                                    <a href="<?= base_url('poster'); ?>" class="text-teal" style="text-decoration: none; font-weight: 600;">Lihat Semua →</a>
                                </div>
                            <?php else : ?>
                                <p class="text-muted">Belum ada poster</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var unwantedElements = document.querySelectorAll('.ql-clipboard, .ql-tooltip');
    unwantedElements.forEach(function(element) {
        element.remove();
    });
});
</script>

<?= $this->endSection(); ?>