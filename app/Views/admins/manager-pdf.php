<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Tabel Files</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="<?= base_url('/admin/dashboard'); ?>">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="<?= url_to('admin.upload.pdf'); ?>" class="text-muted text-decoration-none d-flex btn" role="button">
                                        <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                            Tambah file baru
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

        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">List Files</h4>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive border rounded-1">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Judul</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Kategori</h6>
                                </th>
                                
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($files)): ?>
                                <?php foreach ($files as $file): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                            <img src="<?= base_url('assets/uploadfile/images/' . $file['image']) ?>" alt="<?= esc($file['title']) ?>" style="width: 100px;">
                                                <div class="ms-3">
                                                    <h6 class="fw-semibold mb-1"><?= esc(substr($file['title'], 0, 40)) ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="badge bg-primary-subtle text-primary"><?= esc($file['category_name']) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown dropstart">
                                                <a href="" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-dots fs-5"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center gap-3" href="#">
                                                            <i class="fs-4 ti ti-edit"></i>Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center gap-3" href="<?= url_to('admin.hapus.pdf', $file['id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus file ini?')">
                                                            <i class="fs-4 ti ti-trash"></i>Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Belum ada file yang diupload.</p>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>