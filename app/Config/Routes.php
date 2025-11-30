<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::beranda', ['as' => 'beranda']);
$routes->get('/tentang-kami', 'Home::tentangKami', ['as' => 'tentang.kami']);
$routes->get('/kontak', 'Home::kontak', ['as' => 'kontak']);
$routes->post('/kontak/kirim-email', 'Contact::kirimEmail');

$routes->get('/layanan', 'Home::layanan', ['as' => 'layanan']);
$routes->get('/syarat-ketentuan', 'Home::syaratKetentuan', ['as' => 'syarat.ketentuan']);
$routes->get('/kebijakan-privasi', 'Home::kebijakanPrivasi', ['as' => 'kebijakan.privasi']);


$routes->get('/tanya-jawab/(:any)', 'Faq\FaqController::index/$1', ['as' => 'tanya.jawab']);
$routes->get('/petunjuk-penggunaan', 'Home::petunjukPenggunaan', ['as' => 'petunjuk.penggunaan']);


// Custom Auth Routes
$routes->get('login', 'Auth\AuthController::login', ['as' => 'login']);
$routes->post('auth/login', 'Auth\AuthController::attemptLogin', ['as' => 'auth.login']);
$routes->get('logout', 'Auth\AuthController::logout', ['as' => 'logout']);

$routes->group('unduhan', function($routes) {
    $routes->get('/', 'Unduhan\Unduhan::index');
    $routes->get('(:any)', 'Unduhan\Unduhan::index/$1');
});

// artikel publik (baca artikel)
$routes->group('artikel', function ($routes) {
    $routes->get('/', 'Posts\PostsController::index', ['as' => 'artikel']);
    $routes->get('farmasi', 'Posts\PostsController::kategori/farmasi', ['as' => 'artikel.farmasi']);
    $routes->get('kebidanan', 'Posts\PostsController::kategori/bidan', ['as' => 'artikel.kebidanan']);
    $routes->get('gizi', 'Posts\PostsController::kategori/gizi', ['as' => 'artikel.gizi']);
    $routes->get('baca/(:segment)', 'Posts\PostsController::bacaArtikel/$1', ['as' => 'artikel.baca']);
    $routes->post('komentar/(:num)', 'Posts\PostsController::simpanKomentar/$1', ['as' => 'artikel.komentar']);
    $routes->post('cari', 'Posts\PostsController::cariArtikel', ['as' => 'artikel.cari']);
});

// artikel untuk pengguna terdaftar (dengan filter auth)
$routes->group('pengguna', ['filter' => 'auth'], function ($routes) {
    $routes->post('artikel/tambah', 'Users\UsersController::tambahArtikel', ['as' => 'pengguna.artikel.tambah']);
    $routes->post('artikel/ubah/(:num)', 'Users\UsersController::ubahArtikel/$1', ['as' => 'pengguna.artikel.ubah']);
    $routes->post('artikel/hapus/(:num)', 'Users\UsersController::hapusArtikel/$1', ['as' => 'pengguna.artikel.hapus']);
});

// pencarian artikel
$routes->post('cari-artikel', 'Posts\PostsController::searchPosts', ['as' => 'cari.artikel']);

// pencarian global
$routes->get('cari', 'Search\SearchController::index', ['as' => 'cari.global']);
$routes->post('cari', 'Search\SearchController::search', ['as' => 'cari.global.post']);

// artikel berdasarkan kategori untuk homepage
$routes->post('artikel-kategori', 'Home::getArtikelByKategori', ['as' => 'artikel.kategori.ajax']);


// dashboard pengguna
$routes->group('pengguna', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Users\UsersController::dashboard', ['as' => 'pengguna.dashboard']);
    $routes->get('artikel-saya', 'Users\UsersController::artikelSaya', ['as' => 'pengguna.artikel']);
    $routes->get('monitoring', 'Users\UsersController::monitoring', ['as' => 'pengguna.monitoring']);
});
// email

// Redirect admin login ke Shield login
$routes->get('/admin/login', function() {
    return redirect()->to('/login')->with('message', 'Silakan login dengan akun admin Anda');
});

// Admin routes dengan filter baru
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    // Dashboard Baru
    $routes->get('dashboard', 'Admin\Dashboard::index', ['as' => 'admin.dashboard']);
    
    // Kelola Pengguna & Admin
    $routes->get('kelola-pengguna', 'Admin\Dashboard::kelolaPengguna', ['as' => 'admin.kelola.pengguna']);
    $routes->get('kelola-admin', 'Admin\Dashboard::kelolaAdmin', ['as' => 'admin.kelola.admin']);
    $routes->get('kelola-artikel', 'Admin\Dashboard::kelolaArtikel', ['as' => 'admin.kelola.artikel']);
    $routes->get('kelola-faq', 'Admin\Dashboard::kelolaFaq', ['as' => 'admin.kelola.faq']);
    $routes->get('kelola-unduhan', 'Admin\Dashboard::kelolaUnduhan', ['as' => 'admin.kelola.unduhan']);
    
    // Pengguna
    $routes->post('pengguna/tambah', 'Admin\Dashboard::tambahPengguna');
    $routes->post('pengguna/ubah/(:num)', 'Admin\Dashboard::ubahPengguna/$1');
    $routes->post('pengguna/hapus/(:num)', 'Admin\Dashboard::hapusPengguna/$1');
    
    // Artikel
    $routes->post('artikel/tambah', 'Admin\Dashboard::tambahArtikel');
    $routes->post('artikel/ubah/(:num)', 'Admin\Dashboard::ubahArtikel/$1');
    $routes->post('artikel/hapus/(:num)', 'Admin\Dashboard::hapusArtikel/$1');
    $routes->post('artikel/setujui/(:num)', 'Admin\Dashboard::setujuiArtikel/$1');
    $routes->post('artikel/tolak/(:num)', 'Admin\Dashboard::tolakArtikel/$1');
    $routes->post('artikel/update-status/(:num)', 'Admin\Dashboard::updateStatusArtikel/$1');
    
    // FAQ
    $routes->post('faq/tambah', 'Admin\Dashboard::tambahFaq');
    $routes->post('faq/ubah/(:num)', 'Admin\Dashboard::ubahFaq/$1');
    $routes->post('faq/hapus/(:num)', 'Admin\Dashboard::hapusFaq/$1');
    
    // Unduhan
    $routes->post('unduhan/tambah', 'Admin\Dashboard::tambahUnduhan');
    $routes->post('unduhan/ubah/(:num)', 'Admin\Dashboard::ubahUnduhan/$1');
    $routes->post('unduhan/hapus/(:num)', 'Admin\Dashboard::hapusUnduhan/$1');
    
    // Old routes (keep for compatibility)
    $routes->get('dashboard-old', 'Admins\AdminsController::dashboard', ['as' => 'admin.dashboard.old']);
    
    // CRUD Pengguna
    $routes->post('dashboard/user/create', 'Admins\DashboardController::createUser');
    $routes->post('dashboard/user/update/(:num)', 'Admins\DashboardController::updateUser/$1');
    $routes->post('dashboard/user/delete/(:num)', 'Admins\DashboardController::deleteUser/$1');
    
    // CRUD Artikel
    $routes->post('dashboard/post/create', 'Admins\DashboardController::createPost');
    $routes->post('dashboard/post/update/(:num)', 'Admins\DashboardController::updatePost/$1');
    $routes->post('dashboard/post/delete/(:num)', 'Admins\DashboardController::deletePost/$1');
    
    // CRUD FAQ
    $routes->post('dashboard/faq/create', 'Admins\DashboardController::createFaq');
    $routes->post('dashboard/faq/update/(:num)', 'Admins\DashboardController::updateFaq/$1');
    $routes->post('dashboard/faq/delete/(:num)', 'Admins\DashboardController::deleteFaq/$1');
    
    // CRUD Unduhan
    $routes->post('dashboard/file/create', 'Admins\DashboardController::createFile');
    $routes->post('dashboard/file/update/(:num)', 'Admins\DashboardController::updateFile/$1');
    $routes->post('dashboard/file/delete/(:num)', 'Admins\DashboardController::deleteFile/$1');
    
    // Old dashboard route
    $routes->get('dashboard-old', 'Admins\AdminsController::dashboard', ['as' => 'admin.dashboard.old']);

    $routes->get('keluar', function() {
        return redirect()->to('/logout');
    }, ['as' => 'admin.keluar']);

    // kelola admin
    $routes->get('semua-admin', 'Admins\AdminsController::allAdmin', ['as' => 'admin.semua.admin']);
    $routes->get('buat-admin', 'Admins\AdminsController::createAdmin', ['as' => 'admin.buat']);
    $routes->post('simpan-admin', 'Admins\AdminsController::storeAdmin', ['as' => 'admin.simpan']);

    // kelola kategori
    $routes->get('semua-kategori', 'Admins\AdminsController::allCategories', ['as' => 'admin.semua.kategori']);
    $routes->get('buat-kategori', 'Admins\AdminsController::createCategories', ['as' => 'admin.buat.kategori']);
    $routes->post('simpan-kategori', 'Admins\AdminsController::storeCategories', ['as' => 'admin.simpan.kategori']);
    $routes->get('edit-kategori/(:num)', 'Admins\AdminsController::editCategories/$1', ['as' => 'admin.edit.kategori']);
    $routes->post('update-kategori/(:num)', 'Admins\AdminsController::updateCategories/$1', ['as' => 'admin.update.kategori']);
    $routes->get('hapus-kategori/(:num)', 'Admins\AdminsController::deleteCategories/$1', ['as' => 'admin.hapus.kategori']);

    // kelola artikel
    $routes->get('semua-artikel', 'Admins\AdminsController::allPosts', ['as' => 'admin.semua.artikel']);
    $routes->get('buat-artikel', 'Admins\AdminsController::createPost', ['as' => 'admin.buat.artikel']);
    $routes->post('simpan-artikel', 'Admins\AdminsController::storePost', ['as' => 'admin.simpan.artikel']);
    $routes->get('edit-artikel/(:num)', 'Admins\AdminsController::editPost/$1', ['as' => 'admin.edit.artikel']);
    $routes->post('update-artikel/(:num)', 'Admins\AdminsController::updatePost/$1', ['as' => 'admin.update.artikel']);
    $routes->get('hapus-artikel/(:num)', 'Admins\AdminsController::deletePost/$1', ['as' => 'admin.hapus.artikel']);
    $routes->get('pinjau-artikel/(:num)', 'Admins\AdminsController::pinjauPost/$1', ['as' => 'admin.pinjau.artikel']);
    $routes->post('setujui-artikel/(:num)', 'Admins\AdminsController::approvePost/$1', ['as' => 'admin.setujui.artikel']);
    $routes->post('tolak-artikel/(:num)', 'Admins\AdminsController::rejectPost/$1', ['as' => 'admin.tolak.artikel']);
    $routes->post('update-status-artikel/(:num)', 'Admins\AdminsController::updateStatusPost/$1', ['as' => 'admin.update.status.artikel']);

    // kelola tanya jawab
    $routes->get('semua-tanya-jawab', 'Admins\AdminsFaqController::index',['as' => 'admin.semua.tanya.jawab']);
    $routes->get('buat-tanya-jawab', 'Admins\AdminsFaqController::create', ['as' => 'admin.buat.tanya.jawab']);
    $routes->post('simpan-tanya-jawab', 'Admins\AdminsFaqController::store', ['as' => 'admin.simpan.tanya.jawab']);
    $routes->get('tanya-jawab-kategori/(:any)', 'Admins\AdminsFaqController::category/$1', ['as' => 'admin.tanya.jawab.kategori']);
    $routes->get('hapus-tanya-jawab/(:num)', 'Admins\AdminsFaqController::deleted/$1',['as' => 'admin.hapus.tanya.jawab']);

    // kelola unduhan pdf
    $routes->get('kelola-pdf', 'Admins\PdfController::index', ['as' => 'admin.kelola.pdf']);
    $routes->get('upload-pdf', 'Admins\PdfController::uploadPdfForm', ['as' => 'admin.upload.pdf']);
    $routes->post('simpan-pdf', 'Admins\PdfController::uploadPdf', ['as' => 'admin.simpan.pdf']);
    $routes->get('hapus-pdf/(:num)', 'Admins\PdfController::deletePdf/$1', ['as' => 'admin.hapus.pdf']);

    // database kader
    $routes->get('database-kader', 'Admins\AdminsController::databaseKader', ['as' => 'admin.database.kader']);
    $routes->get('tambah-kader', 'Admins\AdminsController::tambahKader', ['as' => 'admin.tambah.kader']);
    $routes->post('simpan-kader', 'Admins\AdminsController::simpanKader', ['as' => 'admin.simpan.kader']);
    $routes->get('edit-kader/(:num)', 'Admins\AdminsController::editKader/$1', ['as' => 'admin.edit.kader']);
    $routes->post('update-kader/(:num)', 'Admins\AdminsController::updateKader/$1', ['as' => 'admin.update.kader']);
    $routes->get('hapus-kader/(:num)', 'Admins\AdminsController::hapusKader/$1', ['as' => 'admin.hapus.kader']);

    // user detail
    $routes->get('user-detail/(:num)', 'Admin\UserDetailController::index/$1', ['as' => 'admin.user.detail']);
    
    // kelola padukuhan
    $routes->get('padukuhan', 'Admin\PadukuhanController::index', ['as' => 'admin.padukuhan']);
    $routes->post('padukuhan/store', 'Admin\PadukuhanController::store', ['as' => 'admin.padukuhan.store']);
    $routes->post('padukuhan/update/(:num)', 'Admin\PadukuhanController::update/$1', ['as' => 'admin.padukuhan.update']);
    $routes->get('padukuhan/delete/(:num)', 'Admin\PadukuhanController::delete/$1', ['as' => 'admin.padukuhan.delete']);
    
    // monitoring kesehatan
    $routes->get('monitoring/dashboard', 'Admin\Monitoring\MonitoringController::dashboard', ['as' => 'admin.monitoring.dashboard']);
    $routes->get('monitoring/ibu-hamil', 'Admin\Monitoring\MonitoringController::ibuHamil', ['as' => 'admin.monitoring.ibu.hamil']);
    $routes->get('monitoring/balita', 'Admin\Monitoring\MonitoringController::balita', ['as' => 'admin.monitoring.balita']);
    $routes->get('monitoring/remaja', 'Admin\Monitoring\MonitoringController::remaja', ['as' => 'admin.monitoring.remaja']);
    $routes->get('monitoring/input', 'Admin\Monitoring\MonitoringController::input', ['as' => 'admin.monitoring.input']);
    $routes->get('monitoring/input/(:num)', 'Admin\Monitoring\MonitoringController::input/$1', ['as' => 'admin.monitoring.input.user']);
    $routes->post('monitoring/store', 'Admin\Monitoring\MonitoringController::store', ['as' => 'admin.monitoring.store']);
    $routes->get('monitoring/riwayat/(:num)', 'Admin\Monitoring\MonitoringController::riwayat/$1', ['as' => 'admin.monitoring.riwayat']);
    
    // laporan
    $routes->get('monitoring/laporan', 'Admin\Monitoring\LaporanController::index', ['as' => 'admin.monitoring.laporan']);
    $routes->get('laporan/ibu-hamil', 'Admin\Monitoring\LaporanController::ibuHamil', ['as' => 'admin.laporan.ibu.hamil']);
    $routes->get('laporan/balita', 'Admin\Monitoring\LaporanController::balita', ['as' => 'admin.laporan.balita']);
    $routes->get('laporan/remaja', 'Admin\Monitoring\LaporanController::remaja', ['as' => 'admin.laporan.remaja']);
    
    // kunjungan rutin
    $routes->get('monitoring/input-kunjungan/(:num)', 'Admin\Monitoring\MonitoringController::inputKunjungan/$1', ['as' => 'admin.monitoring.input.kunjungan']);
    $routes->post('monitoring/store-kunjungan/(:num)', 'Admin\Monitoring\MonitoringController::storeKunjungan/$1', ['as' => 'admin.monitoring.store.kunjungan']);
    
    // edit & delete
    $routes->get('monitoring/edit-master/(:num)', 'Admin\Monitoring\MonitoringController::editMaster/$1', ['as' => 'admin.monitoring.edit.master']);
    $routes->post('monitoring/update-master/(:num)', 'Admin\Monitoring\MonitoringController::updateMaster/$1', ['as' => 'admin.monitoring.update.master']);
    $routes->get('monitoring/delete-kunjungan/(:num)', 'Admin\Monitoring\MonitoringController::deleteKunjungan/$1', ['as' => 'admin.monitoring.delete.kunjungan']);
    $routes->get('monitoring/delete-monitoring/(:num)', 'Admin\Monitoring\MonitoringController::deleteMonitoring/$1', ['as' => 'admin.monitoring.delete.monitoring']);

});

// Super Admin routes
$routes->group('superadmin', ['filter' => 'superadmin'], function ($routes) {
    $routes->get('dashboard', 'SuperAdmin\SuperAdminController::dashboard', ['as' => 'superadmin.dashboard']);
    
    // kelola admin
    $routes->get('kelola-admin', 'SuperAdmin\SuperAdminController::kelolaAdmin', ['as' => 'superadmin.kelola.admin']);
    $routes->get('tambah-admin', 'SuperAdmin\SuperAdminController::tambahAdmin', ['as' => 'superadmin.tambah.admin']);
    $routes->post('simpan-admin', 'SuperAdmin\SuperAdminController::simpanAdmin', ['as' => 'superadmin.simpan.admin']);
    $routes->get('edit-admin/(:num)', 'SuperAdmin\SuperAdminController::editAdmin/$1', ['as' => 'superadmin.edit.admin']);
    $routes->post('update-admin/(:num)', 'SuperAdmin\SuperAdminController::updateAdmin/$1', ['as' => 'superadmin.update.admin']);
    $routes->get('hapus-admin/(:num)', 'SuperAdmin\SuperAdminController::hapusAdmin/$1', ['as' => 'superadmin.hapus.admin']);
    
    // kelola pengguna
    $routes->get('kelola-pengguna', 'SuperAdmin\SuperAdminController::kelolaPengguna', ['as' => 'superadmin.kelola.pengguna']);
    $routes->get('hapus-pengguna/(:num)', 'SuperAdmin\SuperAdminController::hapusPengguna/$1', ['as' => 'superadmin.hapus.pengguna']);
    
    // sistem
    $routes->get('pengaturan-sistem', 'SuperAdmin\SuperAdminController::pengaturanSistem', ['as' => 'superadmin.pengaturan.sistem']);
    $routes->post('simpan-pengaturan', 'SuperAdmin\SuperAdminController::simpanPengaturan', ['as' => 'superadmin.simpan.pengaturan']);
    
    $routes->get('keluar', function() {
        return redirect()->to('/logout');
    }, ['as' => 'superadmin.keluar']);
});
