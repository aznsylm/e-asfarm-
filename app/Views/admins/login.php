<?= $this->extend('layouts/adminlogin') ?>
<?= $this->section('content') ?>

<div id="main-wrapper">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 w-100">
        <div class="position-relative z-index-5">
            <div class="row gx-0">

                <div class="col-lg-6 col-xl-5 col-xxl-4">
                    <div class="min-vh-100 bg-body row justify-content-center align-items-center p-5">
                        <div class="col-12 auth-card">
                            <a href="<?= base_url('default-sidebar/index.html'); ?>" class="text-nowrap logo-img d-block w-100">
                                <img src="<?= base_url('assets/images/logos/logo-icon.svg'); ?>" class="dark-logo" alt="Logo-Dark" />
                            </a>
                            <h2 class="mb-2 mt-4 fs-7 fw-bolder">Sign In</h2>
                            <p class="mb-9">Your Admin Dashboard E-Asfarm</p>
 
                            <form method="post" action="<?= base_url('admin/check-login'); ?>">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" />
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" />
                                </div>
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked />
                                        <label class="form-check-label text-dark" for="flexCheckChecked">
                                            Remeber this Device
                                        </label>
                                    </div>
                                    <a class="text-primary fw-medium" href="./authentication-forgot-password.html'); ?>">Forgot Password ?</a>
                                </div>
                                <input class="btn btn-primary w-100 py-8 mb-4 rounded-2" type="submit" value="login" name="submit">
                                <!-- <a href="./index.html'); ?>" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</a> -->

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-7 col-xxl-8 position-relative overflow-hidden bg-dark d-none d-lg-block">
                    <div class="circle-top"></div>
                    <div>
                        <img src="<?= base_url('assets/images/logos/logo-icon.svg'); ?>" class="circle-bottom" alt="Logo-Dark" />
                    </div>
                    <div class="d-lg-flex align-items-center z-index-5 position-relative h-n80">
                        <div class="row justify-content-center w-100">
                            <div class="col-lg-6">
                                <h2 class="text-white fs-10 mb-3 lh-sm">
                                    Welcome to
                                    <br />
                                    E-Asfarm
                                </h2>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>