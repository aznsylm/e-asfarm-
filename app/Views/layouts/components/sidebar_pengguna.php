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
        
        <li class="menu-item <?= url_is('pengguna/monitoring*') ? 'active' : '' ?> has-submenu">
            <a href="#" class="submenu-toggle">
                <i class="ti ti-heart-rate-monitor"></i>
                <span>Monitoring Kesehatan</span>
                <i class="ti ti-chevron-down ms-auto"></i>
            </a>
            <ul class="submenu <?= url_is('pengguna/monitoring*') ? 'show' : '' ?>">
                <li><a href="<?= base_url('pengguna/monitoring') ?>" class="<?= url_is('pengguna/monitoring') && !url_is('pengguna/monitoring-remaja') && !url_is('pengguna/monitoring-balita') ? 'active' : '' ?>">Ibu Hamil & Menyusui</a></li>
                <li><a href="<?= base_url('pengguna/monitoring-remaja') ?>" class="<?= url_is('pengguna/monitoring-remaja') ? 'active' : '' ?>">Remaja</a></li>
                <li><a href="<?= base_url('pengguna/monitoring-balita') ?>" class="<?= url_is('pengguna/monitoring-balita') ? 'active' : '' ?>">Balita & Anak</a></li>
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

<style>
.submenu {
    display: none;
    padding-left: 20px;
    background: rgba(0,0,0,0.05);
}
.submenu.show {
    display: block;
}
.submenu li {
    list-style: none;
}
.submenu li a {
    display: block;
    padding: 8px 15px;
    color: #666;
    text-decoration: none;
    font-size: 14px;
}
.submenu li a:hover, .submenu li a.active {
    color: #5d87ff;
    background: rgba(93, 135, 255, 0.1);
}
.submenu-toggle {
    cursor: pointer;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const submenuToggles = document.querySelectorAll('.submenu-toggle');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            const submenu = parent.querySelector('.submenu');
            if (submenu) {
                submenu.classList.toggle('show');
                const icon = this.querySelector('.ti-chevron-down');
                if (icon) {
                    icon.style.transform = submenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0deg)';
                }
            }
        });
    });
});
</script>
