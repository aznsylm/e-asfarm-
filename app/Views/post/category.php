<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="main-wrapper overflow-hidden">
    <!-- Breadcrumb -->
    <section class="py-4 py-md-5 bg-light-gray">
        <div class="container">
            <div class="d-flex justify-content-between flex-md-nowrap flex-wrap">
                <h2 class="fs-6 fs-md-4 fw-bolder">
                    Artikel <?php 
                        if ($name == 'farmasi') echo 'Farmasi';
                        elseif ($name == 'bidan') echo 'Kebidanan';
                        elseif ($name == 'gizi') echo 'Gizi';
                        else echo ucfirst($name);
                    ?>
                </h2>
                <div class="d-flex align-items-center gap-3 gap-md-6">
                    <a href="<?= base_url('/'); ?>" class="text-muted fw-bolder link-primary fs-2 fs-md-3 text-uppercase">
                        E-asfarm
                    </a>
                    <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-6 fs-md-5 text-muted"></iconify-icon>
                    <a href="#" class="text-muted fw-bolder link-primary fs-2 fs-md-3 text-uppercase">
                        Artikel
                    </a>
                    <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-6 fs-md-5 text-muted"></iconify-icon>
                    <a href="#" class="text-primary link-primary fw-bolder fs-2 fs-md-3 text-uppercase">
                        <?php 
                            if ($name == 'farmasi') echo 'Farmasi';
                            elseif ($name == 'bidan') echo 'Kebidanan';
                            elseif ($name == 'gizi') echo 'Gizi';
                            else echo ucfirst($name);
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="bg-light-gray pb-4 pb-md-5">
        <div class="container">
            <div class="card border-0 shadow-sm mb-7">
                <div class="row g-0">
                    <?php foreach ($popPosts as $post) : ?>
                        <div class="col-lg-6 order-last order-lg-first">
                            <div class="card-body p-5 d-flex flex-column h-100">
                                <span class="badge bg-primary mb-3 align-self-start"><?= esc(ucfirst($post->category)); ?></span>
                                <h2 class="card-title fw-bolder mb-3"><?= esc($post->title); ?></h2>
                                <p class="card-text text-muted flex-grow-1" style="text-align: justify;"><?php 
                                    $content = $post->content ?? $post->body ?? '';
                                    $cleanText = strip_tags($content);
                                    $textLength = strlen($cleanText);
                                    if ($textLength > 400) {
                                        echo substr($cleanText, 0, 400) . '...';
                                    } else {
                                        echo $cleanText;
                                    }
                                ?></p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted"><?= date('d M Y', strtotime($post->created_at)); ?></small>
                                    <a href="<?= base_url('artikel/baca/' . ($post->slug ?: $post->id)); ?>" class="btn btn-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 order-first order-lg-last">
                            <?php if (!empty($post->image)): ?>
                                <?php 
                                $imgPath = file_exists(FCPATH.'uploads/articles/'.$post->image) ? 'uploads/articles/'.$post->image : 'assets/images/blog/'.$post->image;
                                ?>
                                <img src="<?= base_url($imgPath); ?>" alt="<?= $post->title; ?>" class="w-100 h-100" style="object-fit: cover; min-height: 250px; border-radius: 0 12px 12px 0;">
                            <?php else: ?>
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 250px; border-radius: 0 12px 12px 0;">
                                    <i class="fas fa-file-medical text-white" style="font-size: 4rem; opacity: 0.7;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row g-4">
                <?php foreach ($cArtikel as $post) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm">
                            <?php if (!empty($post['image'])): ?>
                                <?php 
                                $imgPath = file_exists(FCPATH.'uploads/articles/'.$post['image']) ? 'uploads/articles/'.$post['image'] : 'assets/images/blog/'.$post['image'];
                                ?>
                                <img src="<?= base_url($imgPath); ?>" class="card-img-top" alt="<?= $post['title']; ?>" style="height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-file-medical text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-primary mb-2 align-self-start"><?= esc(ucfirst($post['category'])); ?></span>
                                <h5 class="card-title fw-semibold"><?= esc($post['title']); ?></h5>
                                <p class="card-text text-muted flex-grow-1" style="text-align: justify;"><?= substr(strip_tags($post['content'] ?? $post['body'] ?? ''), 0, 120); ?>...</p>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <small class="text-muted"><?= date('d M Y', strtotime($post['created_at'])); ?></small>
                                    <a href="<?= base_url('artikel/baca/' . ($post['slug'] ?: $post['id'])); ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                <?= $pager->links('default', 'bootstrap_pagination'); ?>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>