<aside class="left-sidebar with-horizontal">
	<!-- Sidebar scroll-->
	<div>
		<!-- Sidebar navigation-->
		<nav id="sidebarnavh" class="sidebar-nav scroll-sidebar container-fluid">
			<ul id="sidebarnav">
				<!-- ============================= -->
				<!-- Home -->
				<!-- ============================= -->
				<li class="nav-small-cap">
					<i class="ti ti-dots nav-small-cap-icon fs-4"></i>
					<span class="hide-menu">Home</span>
				</li>
				<!-- =================== -->
				<!-- Dashboard -->
				<!-- =================== -->
				<li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('/admin/dashboard'); ?>"  aria-expanded="false">
                        <iconify-icon icon="solar:widget-add-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('/admin/semua-admin'); ?>" aria-expanded="false">
                        <iconify-icon icon="solar:shield-user-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Daftar User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('/admin/semua-kategori'); ?>" aria-expanded="false">
                        <iconify-icon icon="solar:screencast-2-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Daftar Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('/admin/semua-artikel'); ?>" aria-expanded="false">
                        <iconify-icon icon="solar:widget-4-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Daftar Artikel</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('assets/default-sidebar/index3.html'); ?>" aria-expanded="false">
                        <iconify-icon icon="solar:document-text-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">Modul unduhan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('/admin/semua-tanya-jawab'); ?>" aria-expanded="false">
                        <iconify-icon icon="solar:question-circle-line-duotone" class=""></iconify-icon>
                        <span class="hide-menu">FAQ</span>
                    </a>
                </li>

			</ul>
		</nav>
		<!-- End Sidebar navigation -->
	</div>
	<!-- End Sidebar scroll-->
</aside>