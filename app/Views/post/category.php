<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<style>
.bg-primary-gradient{background:linear-gradient(135deg,#047d78 0%,#036663 100%);}
.article-card{transition:all .3s;}
.article-card:hover{transform:translateY(-5px);box-shadow:0 8px 16px rgba(0,0,0,0.15);}
.badge-teal{background-color:#047d78;color:#fff;}
.btn-teal{background-color:#047d78;color:#fff;border:none;}
.btn-teal:hover{background-color:#036663;color:#fff;}
</style>

<div class="main-wrapper overflow-hidden">
    <!-- Articles Section -->
    <section class="py-4">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h3 class="fw-bold text-teal">
                        Artikel <?php 
                            if ($name == 'farmasi') echo 'Farmasi';
                            elseif ($name == 'bidan') echo 'Kebidanan';
                            elseif ($name == 'gizi') echo 'Gizi';
                            else echo ucfirst($name);
                        ?>
                    </h3>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($cArtikel as $post) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm rounded-8 article-card">
                            <?php if (!empty($post['image'])): ?>
                                <?php 
                                $imgPath = file_exists(FCPATH.'uploads/articles/'.$post['image']) ? 'uploads/articles/'.$post['image'] : 'assets/images/blog/'.$post['image'];
                                ?>
                                <img src="<?= base_url($imgPath); ?>" class="card-img-top" alt="<?= $post['title']; ?>" style="height: 220px; object-fit: cover; border-radius: 8px 8px 0 0;">
                            <?php else: ?>
                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 220px; background: linear-gradient(135deg, #047d78 0%, #036663 100%); border-radius: 8px 8px 0 0;">
                                    <i class="fas fa-file-medical text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column p-4">
                                <span class="badge badge-teal mb-2 align-self-start"><?= esc(ucfirst($post['category'])); ?></span>
                                <h5 class="card-title fw-bold mb-2 text-dark"><?= esc($post['title']); ?></h5>
                                <p class="card-text text-gray flex-grow-1 mb-3" style="text-align: justify;"><?= substr(strip_tags($post['content'] ?? $post['body'] ?? ''), 0, 120); ?>...</p>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <small class="text-muted"><?= date('d M Y', strtotime($post['created_at'])); ?></small>
                                    <a href="<?= base_url('artikel/baca/' . ($post['slug'] ?: $post['id'])); ?>" class="btn btn-teal btn-sm">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination -->
            <?php if (!empty($cArtikel)): ?>
            <div class="d-flex justify-content-center mt-4">
                <?= $pager->links('default', 'bootstrap_pagination'); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>