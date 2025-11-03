<?= $this->extend('layouts/app'); ?>
<?= $this->section('content'); ?>

<div class="main-wrapper overflow-hidden">
    <!-- ------------------------------------- -->
    <!-- Banner Start -->
    <!-- ------------------------------------- -->
    <section class="py-5 bg-light-gray">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-md-nowrap flex-wrap">
                <h2 class="fs-15 fw-bolder ">
                    Artikel Saya
                </h2>
                <div class="d-flex align-items-center gap-6">
                    <a href="../default-sidebar/frontend-landingpage.html" class="text-muted fw-bolder link-primary fs-3 text-uppercase">
                        Home
                    </a>
                    <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-5 text-muted"></iconify-icon>
                    <a href="#" class="text-primary link-primary fw-bolder fs-3 text-uppercase">
                        Blog posts
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- ------------------------------------- -->
    <!-- Banner End -->
    <!-- ------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- List Start -->
    <!-- ------------------------------------- -->
    <section class="bg-light-gray pb-3 pb-md-7 pb-lg-12">
        <div class="container-fluid">

            <div class="row">
                <?php foreach ($myPosts as $post) : ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="card rounded-3 overflow-hidden">
                            <a href="<?= base_url('posts/single/', $post['id']); ?>" class="position-relative">
                                <img src="<?php echo base_url('assets/images/blog/' . $post['image'] . ''); ?>" alt="blog image" class="w-100 img-fluid">
                                
                                <div class="position-absolute bottom-0 ms-7 mb-n9">
                                    <img src="../assets/images/profile/user-3.jpg" alt="user" class="rounded-circle" width="44px" height="44px">
                                </div>
                            </a>
                            <div class="mt-7 px-7 pb-7 h-100">
                                <div class="d-flex gap-3 flex-column h-100 justify-content-between">
                                    <div class="d-flex">
                                        <p class="fs-2 px-2 rounded-pill bg-muted bg-opacity-25 text-dark mb-0">
                                        <?= $post['category']; ?>
                                        </p>
                                    </div>
                                    <a href="<?= base_url('posts/single/', $post['id']); ?>" class="fs-5 fw-bolder">
                                    <?= $post['title']; ?>
                                    </a>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex gap-9">
                                            <!-- <div class="d-flex gap-2">
                                                <i class="ti ti-eye fs-5 text-dark"></i>
                                                <p class="mb-0 fs-2 fw-bold">6941</p>
                                            </div>
                                            <div class="d-flex gap-2">
                                                <i class="ti ti-message fs-5 text-dark"></i>
                                                <p class="mb-0 fs-2 fw-bold">3</p>
                                            </div> -->
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="ti ti-circle fs-2"></i>
                                            <p class="mb-0 fs-2 fw-bold"><?= $post['created_at']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- ------------------------------------- -->
    <!-- List End  -->
    <!-- ------------------------------------- -->


</div>

<?= $this->endSection(); ?>