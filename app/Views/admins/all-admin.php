<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="card card-body py-3">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="d-sm-flex align-items-center justify-space-between">
                        <h4 class="mb-4 mb-sm-0 card-title">Table User</h4>
                        <nav aria-label="breadcrumb" class="ms-auto">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item d-flex align-items-center">
                                    <a class="text-muted text-decoration-none d-flex" href="./">
                                        <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">
                                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                                        Table User
                                    </span>
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

        <div class="card w-100 position-relative overflow-hidden">
            <div class="px-4 py-3 border-bottom">
                <h4 class="card-title mb-0">Basic Table</h4>
            </div>
            <div class="card-body p-4">

                <div class="table-responsive mb-4 border rounded-1">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">No</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Username</h6>

                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataUser as $data) : ?>
                                <tr>
                                    
                                    <th scope="row">
                                        <p  class="mb-0 fw-normal"><?= $data['id']; ?></p></th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= base_url('assets/images/profile/user-10.jpg'); ?>" class="rounded-circle" width="40" height="40" />
                                            <div class="ms-3">
                                                <h6 class="fs-4 fw-semibold mb-0"><?= esc($data['username']); ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal"><?= esc($data['email']); ?></p>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary">active</span>
                                    </td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-6"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
                                                        <i class="fs-4 ti ti-plus"></i>Add
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
                                                        <i class="fs-4 ti ti-edit"></i>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center gap-3" href="javascript:void(0)">
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