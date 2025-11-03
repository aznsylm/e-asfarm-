<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<!-- Responsive tables Start -->

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Tabel User</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('/admin/dashboard'); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        User
                    </li>
                </ol>
            </nav>
        </div>

    </div>
</div>
<?php if (session()->getFlashdata('create')) : ?>
    <p class="alert alert-success"><?php echo session()->getFlashdata('create'); ?></p>
<?php endif; ?>

<div class="pd-20 card-box mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="text-blue h4">User Table</h4>

        </div>
        <!-- <div class="pull-right">
            <a href="<?= url_to('create.admin'); ?>" class="btn btn-primary" role="button"><i class="fa fa-user-circle-o"></i> Add User</a>
        </div> -->
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataUser as $data) : ?>
                    <tr>
                        <th scope="row"><?= $data->id; ?></th>
                        <td><?= $data->username; ?></td>
                        <td><?= $data->email; ?></td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                    <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="collapse collapse-box" id="responsive-table">
        <div class="code-box">
            <div class="clearfix">
                <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left" data-clipboard-target="#responsive-table-code"><i class="fa fa-clipboard"></i> Copy Code</a>
                <a href="#responsive-table" class="btn btn-primary btn-sm pull-right" rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
            </div>
            <pre><code class="xml copy-pre" id="responsive-table-code">
                        <div class="table-responsive">
                            <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                </tr>
                            </tbody>
                            </table>
                        </div>
			</code></pre>
        </div>
    </div>
</div>
<!-- Responsive tables End -->

<?= $this->endSection(); ?>