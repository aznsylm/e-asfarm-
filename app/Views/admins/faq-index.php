<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>


<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Kategori FAQ</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="<?= base_url('/admin/dashboard'); ?>">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="<?= site_url('admin/buat-tanya-jawab') ?>" class="text-muted text-decoration-none d-flex btn" role="button">
                                        <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                            Tambah Tanya Jawab
                                        </span>
                                    </a>

                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('create')) : ?>
            <p class="alert alert-success"><?php echo session()->getFlashdata('create'); ?></p>
        <?php endif; ?>
        <?php if (session()->getFlashdata('update')) : ?>
            <p class="alert alert-success"><?php echo session()->getFlashdata('update'); ?></p>
        <?php endif; ?>
        <?php if (session()->getFlashdata('delete')) : ?>
            <p class="alert alert-success"><?php echo session()->getFlashdata('delete'); ?></p>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <p class="alert alert-danger"><?php echo session()->getFlashdata('error'); ?></p>
        <?php endif; ?>


        <div class="col-12">
            <div class="card">
                <div class="card-body p-4 pb-0" data-simplebar="">
                    <div class="row flex-nowrap">
                        <div class="col">
                            <div class="card primary-gradient">
                            
                                <div class="card-body text-center px-9 pb-4">
                                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="solar:dollar-minimalistic-linear" class="fs-7 text-white"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1"></td>Kehamilan</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        16,689</h4>
                                    <a href="<?= base_url('admin/tanya-jawab-kategori') . '/Kehamilan'; ?>" class="btn btn-white fs-2 fw-semibold text-nowrap">Lihat Detail</a>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="card warning-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-warning flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="solar:recive-twice-square-linear" class="fs-7 text-white"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Menyusui</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        148</h4>
                                    <a href="<?= base_url('admin/tanya-jawab-kategori') . '/Menyusui'; ?>" class="btn btn-white fs-2 fw-semibold text-nowrap">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card secondary-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="ic:outline-backpack" class="fs-7 text-white"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Persalinan</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $156K</h4>
                                    <a href="<?= base_url('admin/tanya-jawab-kategori') . '/Persalinan'; ?>" class="btn btn-white fs-2 fw-semibold text-nowrap">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card danger-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="ic:baseline-sync-problem" class="fs-7 text-white"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Vaksin</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        64</h4>
                                    <a href="<?= base_url('admin/tanya-jawab-kategori') . '/Vaksin'; ?>" class="btn btn-white fs-2 fw-semibold text-nowrap">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card success-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="ic:outline-forest" class="fs-7 text-white"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Tumbuh Kembang</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="<?= base_url('admin/tanya-jawab-kategori') . '/Tumbuh Kembang'; ?>" class="btn btn-white fs-2 fw-semibold text-nowrap">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card info-gradient">
                                <div class="card-body text-center px-9 pb-4">
                                    <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-info flex-shrink-0 mb-3 mx-auto">
                                        <iconify-icon icon="ic:outline-forest" class="fs-7 text-white"></iconify-icon>
                                    </div>
                                    <h6 class="fw-normal fs-3 mb-1">Nutrisi</h6>
                                    <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">
                                        $36,715</h4>
                                    <a href="<?= base_url('admin/tanya-jawab-kategori') . '/Nutrisi'; ?>" class="btn btn-white fs-2 fw-semibold text-nowrap">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <!-- app/Views/admin/faq_list.php -->
            <h1>Daftar Tanya Jawab</h1>
            <a href="<?= site_url('admin/buat-tanya-jawab') ?>">Tambah Tanya Jawab Baru</a>
            <table border="1">
                <thead>
                    <tr>
                        <th>Pertanyaan</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tanyaJawab as $item): ?>
                        <tr>
                            <td><?= $item['pertanyaan'] ?></td>
                            <td><?= $tanyaJawabKategori[$item['category_id'] - 1]['name'] ?></td>
                            <td>
                                <a href="<?= site_url('admin/edit-tanya-jawab/' . $item['id']) ?>">Edit</a>
                                <a href="<?= site_url('admin/hapus-tanya-jawab/' . $item['id']) ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>



<?= $this->endSection(); ?>