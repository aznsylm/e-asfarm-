<!-- Sidebar Start -->
<aside class="left-sidebar with-vertical">
    <div>
        <!-- Brand -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url('/') ?>" class="text-nowrap logo-img">
                <img src="<?= base_url('assets/images/logos/logo.svg') ?>" alt="Logo" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- Dashboard -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Super Admin</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('/') ?>" aria-expanded="false">
                        <iconify-icon icon="solar:home-2-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Halaman Beranda</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="/superadmin/dashboard" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- Kelola Admin -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/kelola-admin" aria-expanded="false">
                        <iconify-icon icon="solar:user-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Kelola Admin</span>
                    </a>
                </li>

                <!-- Kelola Pengguna -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/kelola-pengguna" aria-expanded="false">
                        <iconify-icon icon="solar:users-group-two-rounded-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Kelola Pengguna</span>
                    </a>
                </li>

                <!-- Kelola Padukuhan -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/padukuhan" aria-expanded="false">
                        <iconify-icon icon="solar:map-point-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Kelola Padukuhan</span>
                    </a>
                </li>

                <!-- Kelola Artikel -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/kelola-artikel" aria-expanded="false">
                        <iconify-icon icon="solar:document-text-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Kelola Artikel</span>
                    </a>
                </li>

                <!-- Kelola FAQ -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/kelola-faq" aria-expanded="false">
                        <iconify-icon icon="solar:question-circle-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Kelola FAQ</span>
                    </a>
                </li>

                <!-- Kelola Unduhan -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/kelola-unduhan" aria-expanded="false">
                        <iconify-icon icon="solar:download-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Kelola Unduhan</span>
                    </a>
                </li>

                <!-- Pengaturan Sistem -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/superadmin/pengaturan-sistem" aria-expanded="false">
                        <iconify-icon icon="solar:settings-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Pengaturan Sistem</span>
                    </a>
                </li>

                <!-- Admin Panel Access -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Akses Admin</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/dashboard" aria-expanded="false">
                        <iconify-icon icon="solar:layers-minimalistic-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Panel Admin</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                        <iconify-icon icon="solar:heart-pulse-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Monitoring Kesehatan</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="hide-menu">Dashboard Monitoring</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item">
                                    <a href="/admin/monitoring/ibu-hamil" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Ibu Hamil & Menyusui</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/monitoring/balita" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Balita & Anak</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/monitoring/remaja" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Remaja</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                                <span class="hide-menu">Data Statistik & Laporan</span>
                            </a>
                            <ul aria-expanded="false" class="collapse second-level">
                                <li class="sidebar-item">
                                    <a href="/admin/laporan/ibu-hamil" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Laporan Ibu Hamil & Menyusui</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/laporan/balita" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Laporan Balita & Anak</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="/admin/laporan/remaja" class="sidebar-link">
                                        <div class="round-16 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-circle"></i>
                                        </div>
                                        <span class="hide-menu">Laporan Remaja</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Akun</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="/logout" aria-expanded="false">
                        <iconify-icon icon="solar:logout-3-bold-duotone"></iconify-icon>
                        <span class="hide-menu">Keluar</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</aside>
<!--  Sidebar End -->