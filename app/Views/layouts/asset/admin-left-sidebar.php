<aside class="left-sidebar with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div>

        <div class="brand-logo d-flex align-items-center">
            <a href="/admin/dashboard" class="text-nowrap logo-img">
                <img src="<?= base_url('assets/images/logos/logo.svg'); ?>" alt="Logo" />
            </a>

        </div>

        <!-- ---------------------------------- -->
        <!-- Dashboard -->
        <!-- ---------------------------------- -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul class="sidebar-menu" id="sidebarnav">
                <!-- ---------------------------------- -->
                <!-- Home -->
                <!-- ---------------------------------- -->
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="mini-icon"></iconify-icon>
                    <span class="hide-menu">Dashboards</span>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/dashboard" aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/semua-admin" aria-expanded="false">
                        <iconify-icon icon="solar:shield-user-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Daftar User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/semua-kategori" aria-expanded="false">
                        <iconify-icon icon="solar:screencast-2-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Daftar Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/semua-artikel" aria-expanded="false">
                        <iconify-icon icon="solar:widget-4-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Daftar Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/kelola-pdf" aria-expanded="false">
                        <iconify-icon icon="solar:document-text-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Modul unduhan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/semua-tanya-jawab" aria-expanded="false">
                        <iconify-icon icon="solar:question-circle-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">FAQ</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/logout" aria-expanded="false">
                        <iconify-icon icon="solar:login-3-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Sign Out</span>
                    </a>
                </li>
            </ul>
        </nav>

    </div>
</aside>