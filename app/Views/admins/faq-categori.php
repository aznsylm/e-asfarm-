<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>


<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Tanya Jawab</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="./">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Tanya Jawab
                                    </span>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-7">
                    <h3 class="fw-semibold">Pertanyaan <?= esc($kategori['name']); ?> Yang Sering Diajukan</h3>
                    <p class="fw-normal mb-0 fs-4">Kenali lebih lanjut tentang <?= esc($kategori['name']); ?> pada pertanyaan di bawah ini</p>
                </div>
                <?php if (!empty($tanyaJawab)): ?>
                    
                    <div class="accordion accordion-flush mb-5 card position-relative overflow-hidden" id="accordionFlushExample">

                        <?php $i = 1; ?>
                        <?php foreach ($tanyaJawab as $item): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-heading<?= $i ?>">
                                    <button class="accordion-button collapsed fs-4 fw-semibold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $i ?>" aria-expanded="false" aria-controls="flush-collapse<?= $i ?>">
                                    <?= esc($item['pertanyaan']); ?>
                                    </button>
                                </h2>
                                <div id="flush-collapse<?= $i ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?= $i ?>" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body fw-normal">
                                    <?= esc($item['jawaban']); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>

                    </div>
                <?php else: ?>
                    <p>Tidak ada tanya jawab yang ditemukan untuk kategori ini.</p>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>