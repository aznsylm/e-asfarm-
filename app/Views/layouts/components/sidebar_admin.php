<?php $role = session()->get('role'); ?>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="<?= base_url('/') ?>" class="text-decoration-none text-white">
            <h4>E-Asfarm</h4>
        </a>
        <p class="text-muted small mb-0">Panel <?= $role === 'superadmin' ? 'Super Admin' : 'Admin' ?></p>
    </div>
    
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="<?= base_url('/') ?>">
                <i class="ti ti-home"></i>
                <span>Halaman Beranda</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('admin/dashboard') && !url_is('admin/dashboard/*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/dashboard') ?>">
                <i class="ti ti-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('admin/kelola-pengguna*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kelola-pengguna') ?>">
                <i class="ti ti-users"></i>
                <span>Kelola Pengguna</span>
            </a>
        </li>
        
        <?php if ($role === 'superadmin'): ?>
        <li class="menu-item <?= url_is('admin/kelola-admin*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kelola-admin') ?>">
                <i class="ti ti-user-shield"></i>
                <span>Kelola Admin</span>
            </a>
        </li>
        <?php endif; ?>
        
        <li class="menu-item <?= url_is('admin/kelola-artikel*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kelola-artikel') ?>">
                <i class="ti ti-article"></i>
                <span>Kelola Artikel</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('admin/kelola-faq*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kelola-faq') ?>">
                <i class="ti ti-help"></i>
                <span>Kelola FAQ</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('admin/kelola-unduhan*') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/kelola-unduhan') ?>">
                <i class="ti ti-download"></i>
                <span>Kelola Unduhan</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('admin/monitoring*') || url_is('admin/laporan*') ? 'active' : '' ?>">
            <a href="#" class="has-submenu" data-bs-toggle="collapse" data-bs-target="#monitoringParentMenu">
                <i class="ti ti-heart-rate-monitor"></i>
                <span>Monitoring Kesehatan</span>
                <i class="ti ti-chevron-down ms-auto"></i>
            </a>
            <ul class="submenu collapse" id="monitoringParentMenu">
                <li>
                    <a href="#" class="has-submenu" data-bs-toggle="collapse" data-bs-target="#dashboardMonitoringMenu">
                        <span>Dashboard Monitoring</span>
                        <i class="ti ti-chevron-down ms-auto"></i>
                    </a>
                    <ul class="submenu collapse" id="dashboardMonitoringMenu">
                        <li><a href="<?= base_url('admin/monitoring/ibu-hamil') ?>">Ibu Hamil & Menyusui</a></li>
                        <li><a href="<?= base_url('admin/monitoring/balita') ?>">Balita & Anak</a></li>
                        <li><a href="<?= base_url('admin/monitoring/remaja') ?>">Remaja</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-submenu" data-bs-toggle="collapse" data-bs-target="#laporanMenu">
                        <span>Data Statistik & Laporan</span>
                        <i class="ti ti-chevron-down ms-auto"></i>
                    </a>
                    <ul class="submenu collapse" id="laporanMenu">
                        <li><a href="<?= base_url('admin/laporan/ibu-hamil') ?>">Laporan Ibu Hamil & Menyusui</a></li>
                        <li><a href="<?= base_url('admin/laporan/balita') ?>">Laporan Balita & Anak</a></li>
                        <li><a href="<?= base_url('admin/laporan/remaja') ?>">Laporan Remaja</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        
        <li class="menu-item mt-auto">
            <a href="<?= base_url('logout') ?>">
                <i class="ti ti-logout"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>
