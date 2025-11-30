<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h4>E-Asfarm</h4>
        <p class="text-muted small mb-0">Panel Pengguna</p>
    </div>
    
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="<?= base_url('/') ?>">
                <i class="ti ti-home"></i>
                <span>Halaman Beranda</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('pengguna/dashboard') ? 'active' : '' ?>">
            <a href="<?= base_url('pengguna/dashboard') ?>">
                <i class="ti ti-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('pengguna/artikel-saya') ? 'active' : '' ?>">
            <a href="<?= base_url('pengguna/artikel-saya') ?>">
                <i class="ti ti-article"></i>
                <span>Artikel Saya</span>
            </a>
        </li>
        
        <li class="menu-item <?= url_is('pengguna/monitoring') ? 'active' : '' ?>">
            <a href="<?= base_url('pengguna/monitoring') ?>">
                <i class="ti ti-heart-rate-monitor"></i>
                <span>Monitoring Kesehatan</span>
            </a>
        </li>
        
        <li class="menu-item mt-auto">
            <a href="<?= base_url('logout') ?>">
                <i class="ti ti-logout"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>
