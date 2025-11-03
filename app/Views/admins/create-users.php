<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>User Table</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('/admin/dashboard'); ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a href="<?= base_url('/admin/semua-admin'); ?>">User </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Create
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- horizontal Basic Forms Start -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Create New User</h4>
            <p class="mb-30"></p>
        </div>
    </div>
    <form method="post" action="<?= url_to('store.admin'); ?>">
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" type="text" placeholder="JohnnyBrown" name="username" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" value="bootstrap@example.com" type="email" name="email" />
        </div>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" value="password" type="password" name="password" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Add user" class="btn btn-primary">
        </div>




    </form>
    <div class="collapse collapse-box" id="horizontal-basic-form1">
        <div class="code-box">
            <div class="clearfix">
                <a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left" data-clipboard-target="#horizontal-basic"><i class="fa fa-clipboard"></i> Copy Code</a>
                <a href="#horizontal-basic-form1" class="btn btn-primary btn-sm pull-right" rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
            </div>
            <pre><code class="xml copy-pre" id="horizontal-basic">
                    <form>
                        <div class="form-group">
                            <label>Text</label>
                            <input class="form-control" type="text" placeholder="Johnny Brown">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="bootstrap@example.com" type="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" value="password" type="password">
                        </div>
                    </form>

            </code></pre>
        </div>
    </div>
</div>
<!-- horizontal Basic Forms End -->

<?= $this->endSection(); ?>