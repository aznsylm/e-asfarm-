    <!-- -------------------------------------------- -->
    <!-- Header start -->
    <!-- -------------------------------------------- -->
    <header class="header-fp p-0 w-100 bg-light-gray">
        <nav class="navbar navbar-expand-lg py-10">
            <div class="container-fluid d-flex justify-content-between">
                <a href="<?= base_url('/'); ?>" class="text-nowrap logo-img">
                    <img src="<?= base_url('assets/images/logos/logo.svg'); ?>" alt="Logo" />
                </a>
                <button class="navbar-toggler border-0 p-0 shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="ti ti-menu-2 fs-8"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 gap-xl-7 gap-8 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fs-4 fw-bold text-dark link-primary" href="<?= url_to('beranda'); ?>">Beranda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-4 fw-bold text-dark link-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Info
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= url_to('tentang.kami'); ?>" class="dropdown-item">Tentang Kami</a></li>
                                <li><a href="<?= url_to('layanan'); ?>" class="dropdown-item">Layanan</a></li>
                                <li><a href="<?= url_to('kontak'); ?>" class="dropdown-item">Kontak</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-4 fw-bold text-dark link-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Artikel
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('artikel/farmasi'); ?>" class="dropdown-item">Farmasi</a></li>
                                <li><a href="<?= base_url('artikel/kebidanan'); ?>" class="dropdown-item">Kebidanan</a></li>
                                <li><a href="<?= base_url('artikel/gizi'); ?>" class="dropdown-item">Gizi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-4 fw-bold text-dark link-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tanya Jawab
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('tanya-jawab/kehamilan'); ?>" class="dropdown-item">Kehamilan</a></li>
                                <li><a href="<?= base_url('tanya-jawab/menyusui'); ?>" class="dropdown-item">Menyusui</a></li>
                                <li><a href="<?= base_url('tanya-jawab/persalinan'); ?>" class="dropdown-item">Persalinan</a></li>
                                <li><a href="<?= base_url('tanya-jawab/vaksin'); ?>" class="dropdown-item">Vaksin</a></li>
                                <li><a href="<?= base_url('tanya-jawab/nutrisi'); ?>" class="dropdown-item">Nutrisi</a></li>
                                <li><a href="<?= base_url('tanya-jawab/etnomedisin'); ?>" class="dropdown-item">Etnomedisin</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-4 fw-bold text-dark link-primary" href="<?= base_url('unduhan'); ?>">
                                Unduhan
                            </a>
                        </li>
                        <?php if (isset(auth()->user()->id)) : ?>
                            <li><a href="<?= base_url('artikel/buat'); ?>" class="nav-link fs-4 fw-bold text-dark link-primary">Buat Artikel</a></li>
                        <?php endif; ?>

                        <?php if (!isset(auth()->user()->username)) : ?>
                            <!-- <li><a href="<?= base_url('login'); ?>" class="btn btn-dark btn-sm py-2 px-9">Login</a></li>
                            <li><a href="<?= base_url('register'); ?>" class="btn btn-primary btn-sm py-2 px-9">Register</a></li> -->
                        <?php else : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?= esc(auth()->user()->username); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="<?= url_to('pengguna.artikel'); ?>">Artikel Saya</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Log Out</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                    </ul>


                    <div class="col-4 text-end">
                        <a href="<?= base_url('cari'); ?>" class="burger ms-auto float-end site-menu-toggle js-menu-toggle d-inline-block d-lg-none light"><span></span></a>
                        <div class="d-flex align-items-center justify-content-end d-none d-lg-flex gap-2">
                            <form action="<?= base_url('cari'); ?>" method="get" class="search-form">
                                <input name="q" type="text" class="form-control" placeholder="Cari artikel, FAQ, unduhan..." />
                                <span class="bi-search"></span>
                            </form>
                            <i class="fas fa-question-circle text-muted" 
                               data-bs-toggle="tooltip" 
                               data-bs-placement="bottom" 
                               data-bs-title="Pencarian ini dapat menemukan artikel kesehatan, FAQ seputar kehamilan & persalinan, serta file unduhan modul dan flayer. Ketik kata kunci apapun untuk mencari di seluruh website."
                               style="cursor: help; font-size: 16px;"></i>
                            <?php if (!session()->get('logged_in')): ?>
                                <a href="<?= base_url('login'); ?>" class="btn btn-primary btn-sm px-3 py-2">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            <?php else: ?>
                                <?php 
                                    $userRole = session()->get('role') ?? 'pengguna';
                                    $isAdmin = in_array($userRole, ['admin', 'superadmin']);
                                ?>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle me-1"></i><?= esc(session()->get('username') ?? 'User') ?> <span class="badge bg-secondary"><?= ucfirst($userRole) ?></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php if($isAdmin): ?>
                                            <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                        <?php endif; ?>
                                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- -------------------------------------------- -->
    <!-- Header End -->
    <!-- -------------------------------------------- -->

    <!-- ------------------------------------- -->
    <!-- Responsive Header Start -->
    <!-- ------------------------------------- -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <a href="<?= base_url('/'); ?>" class="text-nowrap logo-img">
                <img src="<?= base_url('assets/images/logos/logo.svg'); ?>" alt="Logo" />
            </a>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        
            <?php if (!session()->get('logged_in')): ?>
                <div class="d-lg-none px-3 mb-2">
                    <a href="<?= base_url('login'); ?>" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </a>
                </div>
            <?php endif; ?>
            
            <div class="d-flex align-items-center d-lg-none w-100 px-3 gap-2">
                <form action="<?= base_url('cari'); ?>" method="get" class="search-form flex-grow-1">
                    <input name="q" type="text" class="form-control" placeholder="Cari artikel, FAQ, unduhan..." />
                    <span class="bi-search"></span>
                </form>
                <i class="fas fa-question-circle text-muted" 
                   data-bs-toggle="tooltip" 
                   data-bs-placement="bottom" 
                   data-bs-title="Pencarian ini dapat menemukan artikel kesehatan, FAQ seputar kehamilan & persalinan, serta file unduhan modul dan flayer. Ketik kata kunci apapun untuk mencari di seluruh website."
                   style="cursor: help; font-size: 16px;"></i>
                <?php if (!session()->get('logged_in')): ?>
                    <a href="<?= base_url('login'); ?>" class="btn btn-primary btn-sm px-2 py-1">
                        <i class="fas fa-sign-in-alt"></i>
                    </a>
                <?php endif; ?>
            </div>
            
            <div class="d-flex align-items-center d-lg-none mt-2 w-100 px-3" style="display:none; font-size: 16px;"></i>
            </div>
        
        <div class="offcanvas-body">
            <ul class="list-unstyled ps-0">
                <li class="mb-1">
                    <a href="<?= url_to('beranda'); ?>" class="px-0 fs-4 d-block text-dark link-primary w-100 py-2">
                        Beranda
                    </a>
                </li>

                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded px-0 fs-4 d-block w-100 py-2 text-dark link-primary text-start"
                        data-bs-toggle="collapse"
                        data-bs-target="#info-collapse"
                        aria-expanded="false">
                        Info <i class="fas fa-chevron-down float-end mt-1 fs-5"></i>
                    </button>
                    <div class="collapse" id="info-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ps-3">
                            <li class="my-2">
                                <a href="<?= url_to('tentang.kami'); ?>" class="link-dark rounded">
                                    Tentang Kami
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= url_to('layanan'); ?>" class="link-dark rounded">
                                    Layanan
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= url_to('kontak'); ?>" class="link-dark rounded">
                                    Kontak
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded px-0 fs-4 d-block w-100 py-2 text-dark link-primary text-start"
                        data-bs-toggle="collapse"
                        data-bs-target="#artikel-collapse"
                        aria-expanded="false">
                        Artikel <i class="fas fa-chevron-down float-end mt-1 fs-5"></i>
                    </button>
                    <div class="collapse" id="artikel-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ps-3">
                            <li class="my-2">
                                <a href="<?= base_url('artikel/farmasi'); ?>" class="link-dark rounded">
                                    Farmasi
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= base_url('artikel/kebidanan'); ?>" class="link-dark rounded">
                                    Kebidanan
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= base_url('artikel/gizi'); ?>" class="link-dark rounded">
                                    Gizi
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded px-0 fs-4 d-block w-100 py-2 text-dark link-primary text-start"
                        data-bs-toggle="collapse"
                        data-bs-target="#tanya-collapse"
                        aria-expanded="false">
                        Tanya <i class="fas fa-chevron-down float-end mt-1 fs-5"></i>
                    </button>
                    <div class="collapse" id="tanya-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 ps-3">
                            <li class="my-2">
                                <a href="<?= base_url('tanya-jawab/kehamilan'); ?>" class="link-dark rounded">
                                    Kehamilan
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= base_url('tanya-jawab/menyusui'); ?>" class="link-dark rounded">
                                    Menyusui
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= base_url('tanya-jawab/persalinan'); ?>" class="link-dark rounded">
                                    Persalinan
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= base_url('tanya-jawab/vaksin'); ?>" class="link-dark rounded">
                                    Vaksin
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= base_url('tanya-jawab/nutrisi'); ?>" class="link-dark rounded">
                                    Nutrisi
                                </a>
                            </li>
                            <li class="my-2">
                                <a href="<?= base_url('tanya-jawab/etnomedisin'); ?>" class="link-dark rounded">
                                    Etnomedisin
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="mb-1">
                    <a href="<?= base_url('unduhan'); ?>" class="px-0 fs-4 d-block text-dark link-primary w-100 py-2">
                        Unduhan
                    </a>
                </li>
 
            </ul>

        </div>

    </div>
    <!-- ------------------------------------- -->
    <!-- Responsive Header End -->
    <!-- ------------------------------------- -->