<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>
<div class="main-wrapper overflow-hidden">
    <section class="py-5 bg-light-gray">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-md-nowrap flex-wrap">
                <h2 class="fs-15 fw-bolder">
                    Pencarian untuk "<?= esc($keyword) ?>"
                </h2>
            </div>
        </div>
    </section>
    <section class="bg-light-gray pb-3 pb-md-7 pb-lg-12">
        <div class="container-fluid">
            <div class="row">
                <?php if (!empty($searches)) : ?>
                    <?php foreach ($searches as $post) : ?>
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card rounded-3 overflow-hidden h-100">
                                <a href="<?= base_url('posts/single/' . $post['id']); ?>" class="position-relative">
                                    <img src="<?= base_url('assets/images/blog/' . $post['image']); ?>" alt="<?= esc($post['title']); ?>" class="w-100 img-fluid">
                                    <div class="position-absolute bottom-0 ms-7 mb-n9">
                                        <img src="<?= base_url('assets/images/profile/user-3.jpg'); ?>" alt="user" class="rounded-circle" width="44px" height="44px">
                                    </div>
                                </a>
                                <div class="mt-7 px-7 pb-7 h-100">
                                    <div class="d-flex gap-3 flex-column h-100 justify-content-between">
                                        <div class="d-flex">
                                            <p class="fs-2 px-2 rounded-pill bg-muted bg-opacity-25 text-dark mb-0">
                                                <?= esc($post['category']); ?>
                                            </p>
                                        </div>
                                        <a href="<?= base_url('posts/single/' . $post['id']); ?>" class="fs-5 fw-bolder">
                                            <?= esc($post['title']); ?>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-9">
                                                <div class="d-flex gap-2">
                                                    <i class="ti ti-eye fs-5 text-dark"></i>
                                                    <p class="mb-0 fs-2 fw-bold"></p>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <i class="ti ti-message fs-5 text-dark"></i>
                                                    <p class="mb-0 fs-2 fw-bold"></p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="ti ti-circle fs-2"></i>
                                                <p class="mb-0 fs-2 fw-bold"><?= $post['created_at']; ?> &bullet;</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center py-5">
                            <i class="ti ti-search-off fs-1"></i>
                            <h3 class="mt-3">Hasil pencarian tidak ditemukan</h3>
                            <p class="mb-0">Tidak ada artikel yang sesuai dengan kata kunci "<?= esc($keyword) ?>"</p>
                            <a href="<?= base_url('posts'); ?>" class="btn btn-primary mt-3">Kembali ke Semua Artikel</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Pagination - hanya tampilkan jika ada hasil -->
            
        </div>
    </section>
</div>
<?= $this->endSection(); ?>