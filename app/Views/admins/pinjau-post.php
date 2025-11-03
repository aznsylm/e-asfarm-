<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>


<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Pinjau Artikel</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="./">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Pinjau Artikel
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="card rounded-2 overflow-hidden">
            <div class="position-relative">
                <a href="javascript:void(0)">
                    <img src="<?= base_url('assets/images/blog/' . $artikel['image'] . ''); ?>" class="card-img-top rounded-0 object-fit-cover" alt="matdash-img" height="440">
                </a>
                <!-- Menampilkan badge "Read Time" hanya jika waktu masih dalam batas 5 jam -->


                <span class="badge text-bg-light mb-9 me-9 position-absolute bottom-0 end-0"></span>
                <img src="<?= base_url('assets/images/profile/user-5.jpg'); ?>" alt="matdash-img" class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9" width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Esther Lindsey">
            </div>
            <div class="card-body p-4">
                <span class="badge text-bg-light mt-3"><?= $artikel['category']; ?></span>
                <h2 class="fs-9 fw-semibold my-4"><?= $artikel['title']; ?></h2>
                <div class="d-flex align-items-center gap-4">
                    <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-eye text-dark fs-5"></i>0
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <i class="ti ti-message-2 text-dark fs-5"></i>0
                    </div>
                    <div class="d-flex align-items-center fs-2 ms-auto">
                        <i class="ti ti-point text-dark"></i><?= $artikel['created_at']; ?>
                    </div>
                </div>
            </div>
            <div class="card-body border-top p-4 text-dark">

                <?php
                $body = $artikel['body'];
                $body = str_replace('contenteditable="true"', '', $body);
                $body = str_replace('data-gramm="false"', '', $body);
                ?>
                <?= $body; ?>

            </div>
        </div>



    </div>
</div>

<script>
    // Menghapus elemen Quill yang tidak diinginkan setelah halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        var unwantedElements = document.querySelectorAll('.ql-clipboard, .ql-tooltip');
        unwantedElements.forEach(function(element) {
            element.remove();
        });
    });
</script>

<?= $this->endSection(); ?>