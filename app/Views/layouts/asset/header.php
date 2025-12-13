
    <!-- Header start -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
    .header-top {
        background-color: #047d78;
    }
    .header-bottom {
        background-color: #f5f5f5;
    }
    .header-bottom .navbar-nav .nav-link {
        font-family: 'Poppins', sans-serif;
        letter-spacing: 0.3px;
    }
    .navbar .dropdown-item {
        font-family: 'Poppins', sans-serif;
    }
    .search-modal-btn {
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
        transition: all 0.3s;
    }
    .search-modal-btn:hover {
        background: rgba(255,255,255,0.2);
        border-color: rgba(255,255,255,0.5);
    }
    .btn-teal {
        background-color: #047d78;
        border-color: #047d78;
        color: white;
    }
    .btn-teal:hover {
        background-color: #036661;
        border-color: #036661;
        color: white;
    }
    .nav-link:focus,
    .nav-link:active {
        outline: none !important;
        box-shadow: none !important;
    }
    .navbar .dropdown-menu {
        border-radius: 0;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 0;
        margin-top: 0;
        min-width: 200px;
    }
    .navbar .dropdown-item {
        padding: 12px 20px;
        color: #333;
        font-weight: 500;
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s;
    }
    .navbar .dropdown-item:last-child {
        border-bottom: none;
    }
    .navbar .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #047d78;
        padding-left: 25px;
    }
    </style>

    <header class="header-fp p-0 w-100">
        <!-- Header Top -->
        <div class="header-top py-2">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-6 col-lg-3">
                        <a href="<?= base_url('/'); ?>" class="text-nowrap logo-img">
                            <img src="<?= base_url('assets/images/logos/E-Asfarm-Logo.png'); ?>" alt="Logo" style="height: 45px; width: auto;" />
                        </a>
                    </div>
                    <div class="col-6 col-lg-9 text-end">
                        <div class="d-flex align-items-center justify-content-end gap-2 gap-lg-3">
                            <span class="text-white fw-semibold d-lg-none" style="font-size: 0.7rem; font-style: italic; font-family: 'Georgia', serif; line-height: 1.2; max-width: 110px; text-align: right;">Pendampingan Tepat, Generasi Hebat</span>
                            <span class="text-white fw-semibold d-none d-lg-inline" style="font-size: 0.95rem; font-style: italic; font-family: 'Georgia', serif;">Pendampingan Tepat, Generasi Hebat</span>
                            <button class="btn search-modal-btn btn-sm d-none d-lg-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#searchModal">
                                <i class="fas fa-search me-2"></i> Cari
                            </button>
                            <i class="fas fa-question-circle text-white d-none d-lg-inline" 
                               data-bs-toggle="tooltip" 
                               data-bs-placement="bottom" 
                               data-bs-title="Cari artikel kesehatan, tanya jawab, poster, dan modul edukasi"
                               style="cursor: help; opacity: 0.8;"></i>
                            <?php if (!session()->get('logged_in')): ?>
                                <a href="<?= base_url('login'); ?>" class="btn btn-light btn-sm d-none d-lg-inline-flex align-items-center">
                                    <i class="fas fa-sign-in-alt me-1"></i> Login
                                </a>
                            <?php else: ?>
                                <?php 
                                    $userRole = session()->get('role') ?? 'pengguna';
                                    $isAdmin = in_array($userRole, ['admin', 'superadmin']);
                                ?>
                                <div class="dropdown d-none d-lg-block">
                                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-user-circle me-1"></i><?= esc(session()->get('username') ?? 'User') ?>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <?php if($isAdmin): ?>
                                            <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</a></li>
                                        <?php else: ?>
                                            <li><a class="dropdown-item" href="<?= base_url('pengguna/dashboard') ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                        <?php endif; ?>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <button class="btn btn-light d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Bottom -->
        <div class="header-bottom d-none d-lg-block">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg py-0">
                    <ul class="navbar-nav gap-4">
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-dark py-3" href="<?= url_to('beranda'); ?>">Beranda</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold text-dark py-3" href="#" data-bs-toggle="dropdown">Informasi</a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= url_to('tentang.kami'); ?>" class="dropdown-item">Tentang Kami</a></li>
                                <li><a href="<?= url_to('layanan'); ?>" class="dropdown-item">Layanan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold text-dark py-3" href="#" data-bs-toggle="dropdown">Artikel</a>
                            <ul class="dropdown-menu">
                                <?php 
                                $categoryModel = new \App\Models\CategoryModel();
                                $artikelCategories = $categoryModel->where(['type' => 'artikel', 'is_active' => 1])->findAll();
                                foreach($artikelCategories as $cat): 
                                ?>
                                <li><a href="<?= base_url('artikel/' . strtolower($cat['slug'])); ?>" class="dropdown-item"><?= esc($cat['name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold text-dark py-3" href="#" data-bs-toggle="dropdown">Tanya Jawab</a>
                            <ul class="dropdown-menu">
                                <?php 
                                $categoryModel = new \App\Models\CategoryModel();
                                $faqCategories = $categoryModel->where(['type' => 'tanya_jawab', 'is_active' => 1])->findAll();
                                foreach($faqCategories as $cat): 
                                ?>
                                <li><a href="<?= base_url('tanya-jawab/' . strtolower($cat['slug'])); ?>" class="dropdown-item"><?= esc($cat['name']) ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-dark py-3" href="<?= base_url('poster'); ?>">Poster</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold text-dark py-3" href="<?= base_url('modul'); ?>">Modul</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <form action="<?= base_url('cari'); ?>" method="get">
                        <div class="input-group input-group-lg">
                            <input name="q" type="text" class="form-control" placeholder="Cari artikel, tanya jawab, poster, modul..." autofocus />
                            <button class="btn btn-teal" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Header End -->

    <!-- Responsive Header Start -->
    <style>
    #offcanvasRight {
        background-color: #f5f5f5;
    }
    .btn-teal {
        background-color: #047d78;
        border-color: #047d78;
        color: white;
    }
    .btn-teal:hover {
        background-color: #036661;
        border-color: #036661;
        color: white;
    }
    .btn-outline-teal {
        border-color: #047d78;
        color: #047d78;
    }
    .btn-outline-teal:hover {
        background-color: #047d78;
        border-color: #047d78;
        color: white;
    }
    .btn-toggle:focus,
    .btn-toggle:active,
    .btn-toggle:focus-visible {
        outline: none !important;
        box-shadow: none !important;
        background-color: transparent !important;
    }
    .offcanvas-body ul li a,
    .offcanvas-body ul li button {
        font-size: 0.95rem;
    }
    .offcanvas-body > ul > li > a,
    .offcanvas-body > ul > li > button {
        padding-left: 0;
    }
    .offcanvas-body .collapse ul {
        background-color: #fff;
        border-left: 3px solid #047d78;
        margin-left: 10px;
    }
    .offcanvas-body .collapse ul li a {
        padding: 10px 15px;
        display: block;
        transition: all 0.3s;
    }
    .offcanvas-body .collapse ul li a:hover {
        background-color: #f8f9fa;
        color: #047d78;
        padding-left: 20px;
    }
    </style>
    
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight">
        <div class="offcanvas-header py-3 px-3" style="background-color: #047d78;">
            <a href="<?= base_url('/'); ?>" class="text-nowrap logo-img">
                <img src="<?= base_url('assets/images/logos/E-Asfarm-Logo.png'); ?>" alt="Logo" style="height: 45px; width: auto;" />
            </a>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        
        <div class="px-3 py-3 border-bottom bg-white">
            <form action="<?= base_url('cari'); ?>" method="get">
                <div class="input-group">
                    <input name="q" type="text" class="form-control" placeholder="Cari artikel, tanya jawab, poster, modul..." />
                    <button class="btn btn-teal" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
        
        <?php if (!session()->get('logged_in')): ?>
            <div class="px-3 py-3 bg-white border-bottom">
                <a href="<?= base_url('login'); ?>" class="btn btn-teal w-100">
                    <i class="fas fa-sign-in-alt me-1"></i> Login
                </a>
            </div>
        <?php else: ?>
            <?php 
                $userRole = session()->get('role') ?? 'pengguna';
                $isAdmin = in_array($userRole, ['admin', 'superadmin']);
            ?>
            <div class="px-3 py-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="fas fa-user-circle fs-4" style="color: #047d78;"></i>
                    <div>
                        <div class="fw-semibold"><?= esc(session()->get('username') ?? 'User') ?></div>
                        <small class="text-muted"><?= ucfirst($userRole) ?></small>
                    </div>
                </div>
                <a href="<?= $isAdmin ? base_url('admin/dashboard') : base_url('pengguna/dashboard') ?>" class="btn btn-sm btn-outline-teal w-100 mb-2">
                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                </a>
                <a href="<?= base_url('logout') ?>" class="btn btn-sm btn-outline-danger w-100">
                    <i class="fas fa-sign-out-alt me-1"></i> Keluar
                </a>
            </div>
        <?php endif; ?>
        
        <div class="offcanvas-body">
            <ul class="list-unstyled ps-0">
                <li class="mb-2">
                    <a href="<?= url_to('beranda'); ?>" class="d-block text-dark py-2 text-decoration-none fw-semibold">Beranda</a>
                </li>
                <li class="mb-2">
                    <button class="btn btn-toggle w-100 text-start py-2 text-dark fw-semibold border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#info-collapse">
                        Informasi
                    </button>
                    <div class="collapse" id="info-collapse">
                        <ul class="list-unstyled ps-3">
                            <li class="my-2"><a href="<?= url_to('tentang.kami'); ?>" class="text-dark text-decoration-none">Tentang Kami</a></li>
                            <li class="my-2"><a href="<?= url_to('layanan'); ?>" class="text-dark text-decoration-none">Layanan</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-2">
                    <button class="btn btn-toggle w-100 text-start py-2 text-dark fw-semibold border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#artikel-collapse">
                        Artikel
                    </button>
                    <div class="collapse" id="artikel-collapse">
                        <ul class="list-unstyled ps-3">
                            <?php 
                            $categoryModel = new \App\Models\CategoryModel();
                            $artikelCategories = $categoryModel->where(['type' => 'artikel', 'is_active' => 1])->findAll();
                            foreach($artikelCategories as $cat): 
                            ?>
                            <li class="my-2"><a href="<?= base_url('artikel/' . strtolower($cat['slug'])); ?>" class="text-dark text-decoration-none"><?= esc($cat['name']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="mb-2">
                    <button class="btn btn-toggle w-100 text-start py-2 text-dark fw-semibold border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#tanya-collapse">
                        Tanya Jawab
                    </button>
                    <div class="collapse" id="tanya-collapse">
                        <ul class="list-unstyled ps-3">
                            <?php 
                            $categoryModel = new \App\Models\CategoryModel();
                            $faqCategories = $categoryModel->where(['type' => 'tanya_jawab', 'is_active' => 1])->findAll();
                            foreach($faqCategories as $cat): 
                            ?>
                            <li class="my-2"><a href="<?= base_url('tanya-jawab/' . strtolower($cat['slug'])); ?>" class="text-dark text-decoration-none"><?= esc($cat['name']) ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </li>
                <li class="mb-2">
                    <a href="<?= base_url('poster'); ?>" class="d-block text-dark py-2 text-decoration-none fw-semibold">Poster</a>
                </li>
                <li class="mb-2">
                    <a href="<?= base_url('modul'); ?>" class="d-block text-dark py-2 text-decoration-none fw-semibold">Modul</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Responsive Header End -->