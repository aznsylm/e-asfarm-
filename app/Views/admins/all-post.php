<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Tabel Artikel</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="<?= base_url('/admin/dashboard'); ?>">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <a href="<?= url_to('admin.buat.artikel'); ?>" class="text-muted text-decoration-none d-flex btn" role="button">
                                        <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                            Tambah Artikel Baru
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
                <h4 class="card-title mb-0">List Artikel</h4>
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
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Authors</h6>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allPost as $data) : ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('assets/images/blog/' . $data['image']) ?>" alt="<?= esc($data['title']) ?>" class="rounded-2" width="42" height="42">

                                            <div class="ms-3">
                                                <h6 class="fw-semibold mb-1"><?= esc(substr($data['title'], 0, 40)); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-primary-subtle text-primary"><?= esc($data['category']); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal"><?= esc($data['user_name']); ?></p>
                                    </td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <a href="" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots fs-5"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="<?= url_to('admin.pinjau.artikel', $data['id']); ?>">
                                                        <i class="fs-4 ti ti-eye"></i>Pinjau
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="<?= url_to('admin.edit.artikel', $data['id']); ?>">
                                                        <i class="fs-4 ti ti-edit"></i>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="<?= url_to('admin.hapus.artikel', $data['id']); ?>">
                                                        <i class="fs-4 ti ti-trash"></i>Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection(); ?>