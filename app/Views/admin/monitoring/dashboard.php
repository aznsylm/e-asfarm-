<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h4>Kesehatan Ibu Hamil</h4>
                <p>Monitoring kesehatan ibu hamil</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-nurse"></i>
            </div>
            <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="small-box-footer">
                Kelola Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h4>Kesehatan Balita & Anak</h4>
                <p>Monitoring tumbuh kembang balita</p>
            </div>
            <div class="icon">
                <i class="fas fa-baby"></i>
            </div>
            <a href="<?= base_url('admin/monitoring/balita') ?>" class="small-box-footer">
                Kelola Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h4>Kesehatan Remaja</h4>
                <p>Monitoring kesehatan remaja</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="<?= base_url('admin/monitoring/remaja') ?>" class="small-box-footer">
                Kelola Data <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header" style="background-color: #047d78; color: white;">
                <h3 class="card-title">Panduan Export Data</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <strong>Informasi:</strong> Sistem menyediakan 3 cara export data dalam format <strong>PDF</strong> (siap cetak) atau <strong>Excel</strong> (dapat diolah)
                </div>

                <div class="row">
                    <!-- Card 1: Export Data Pengguna -->
                    <div class="col-md-4">
                        <div class="card" style="border: 2px solid #047d78;">
                            <div class="card-header" style="background-color: #047d78; color: white;">
                                <h5 class="mb-0">1. Export Data Pengguna</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-2"><strong>Fungsi:</strong> Cetak data kesehatan lengkap 1 pengguna</p>
                                <p class="font-weight-bold mb-2">Cara Menggunakan:</p>
                                <ol class="small mb-3">
                                    <li>Buka menu <strong>Kelola Pengguna</strong></li>
                                    <li>Klik tombol <span class="badge badge-info">Detail</span></li>
                                    <li>Klik tombol export di pojok kanan atas</li>
                                    <li>Pilih: <strong>Kunjungan Terakhir</strong> atau <strong>Semua Kategori</strong></li>
                                </ol>
                                <div class="bg-light p-2 rounded small mb-3">
                                    <strong>Kapan digunakan:</strong><br>
                                    • Rujukan ke dokter/RS<br>
                                    • Pasien pindah puskesmas<br>
                                    • Arsip rekam medis
                                </div>
                                <button class="btn btn-sm btn-outline-secondary btn-block" data-toggle="modal" data-target="#contohModal1">Lihat Contoh Format</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Export Laporan Bulanan -->
                    <div class="col-md-4">
                        <div class="card" style="border: 2px solid #047d78;">
                            <div class="card-header" style="background-color: #047d78; color: white;">
                                <h5 class="mb-0">2. Export Laporan Bulanan</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-2"><strong>Fungsi:</strong> Cetak ringkasan semua pasien per periode</p>
                                <p class="font-weight-bold mb-2">Cara Menggunakan:</p>
                                <ol class="small mb-3">
                                    <li>Buka menu <strong>Data Statistik & Laporan</strong></li>
                                    <li>Pilih <strong>Bulan</strong> dan <strong>Tahun</strong></li>
                                    <li>Klik tombol <span class="badge badge-primary">Filter</span></li>
                                    <li>Klik <span class="badge badge-success">Export Excel</span> atau <span class="badge badge-danger">Export PDF</span></li>
                                </ol>
                                <div class="bg-light p-2 rounded small mb-3">
                                    <strong>Kapan digunakan:</strong><br>
                                    • Laporan ke Puskesmas/Dinkes<br>
                                    • Evaluasi program kesehatan<br>
                                    • Dokumentasi posyandu
                                </div>
                                <button class="btn btn-sm btn-outline-secondary btn-block" data-toggle="modal" data-target="#contohModal2">Lihat Contoh Format</button>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Export Detail Per Pasien -->
                    <div class="col-md-4">
                        <div class="card" style="border: 2px solid #047d78;">
                            <div class="card-header" style="background-color: #047d78; color: white;">
                                <h5 class="mb-0">3. Export Detail Pasien</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-2"><strong>Fungsi:</strong> Cetak riwayat lengkap 1 pasien dari tabel</p>
                                <p class="font-weight-bold mb-2">Cara Menggunakan:</p>
                                <ol class="small mb-3">
                                    <li>Buka menu <strong>Data Statistik & Laporan</strong></li>
                                    <li>Pilih tab: <strong>Ibu Hamil</strong>, <strong>Balita</strong>, atau <strong>Remaja</strong></li>
                                    <li>Cari nama pasien di tabel</li>
                                    <li>Klik ikon <span class="badge badge-success">Excel</span> atau <span class="badge badge-danger">PDF</span> di kolom Aksi</li>
                                </ol>
                                <div class="bg-light p-2 rounded small mb-3">
                                    <strong>Kapan digunakan:</strong><br>
                                    • Konsultasi dengan bidan/dokter<br>
                                    • Monitoring perkembangan<br>
                                    • Dokumentasi kasus khusus
                                </div>
                                <button class="btn btn-sm btn-outline-secondary btn-block" data-toggle="modal" data-target="#contohModal3">Lihat Contoh Format</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Contoh 1: Export Data Pengguna -->
<div class="modal fade" id="contohModal1" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #047d78; color: white;">
                <h5 class="modal-title">Contoh Format: Export Data Pengguna</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">File berisi data identitas lengkap + riwayat kunjungan per kategori (Ibu Hamil, Balita, Remaja)</div>
                <div class="text-center mb-3">
                    <!-- UPDATE LINK INI DENGAN URL CONTOH FILE ANDA -->
                    <a href="#" target="_blank" class="btn btn-lg" style="background-color: #047d78; color: white;">Buka Contoh File PDF</a>
                    <p class="text-muted small mt-2">Link akan dibuka di tab baru</p>
                </div>
                <div class="mt-3">
                    <strong>Isi File:</strong>
                    <ul>
                        <li>Header: Logo sistem, nama padukuhan, admin, tanggal</li>
                        <li>Data Identitas: Nama lengkap, alamat, nomor telepon, dll</li>
                        <li>Riwayat Kunjungan: Semua kunjungan dengan detail antropometri, keluhan, pemeriksaan</li>
                        <li>Footer: Informasi kontak sistem</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Contoh 2: Export Laporan Bulanan -->
<div class="modal fade" id="contohModal2" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #047d78; color: white;">
                <h5 class="modal-title">Contoh Format: Export Laporan Bulanan</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">File berisi tabel ringkasan semua pasien dari 3 kategori sekaligus</div>
                <div class="text-center mb-3">
                    <!-- UPDATE LINK INI DENGAN URL CONTOH FILE ANDA -->
                    <a href="#" target="_blank" class="btn btn-lg" style="background-color: #047d78; color: white;">Buka Contoh File PDF</a>
                    <p class="text-muted small mt-2">Link akan dibuka di tab baru</p>
                </div>
                <div class="mt-3">
                    <strong>Isi File:</strong>
                    <ul>
                        <li>Header: Periode laporan (bulan & tahun), info admin</li>
                        <li>Tabel Ibu Hamil: Nama, usia kehamilan, trimester, jumlah kunjungan, status</li>
                        <li>Tabel Balita: Nama, usia, jumlah kunjungan, status gizi</li>
                        <li>Tabel Remaja: Nama, usia, jenis kelamin, jumlah kunjungan, status anemia</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Contoh 3: Export Detail Pasien -->
<div class="modal fade" id="contohModal3" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #047d78; color: white;">
                <h5 class="modal-title">Contoh Format: Export Detail Pasien</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">File berisi data lengkap 1 pasien dengan semua riwayat kunjungan</div>
                <div class="text-center mb-3">
                    <!-- UPDATE LINK INI DENGAN URL CONTOH FILE ANDA -->
                    <a href="#" target="_blank" class="btn btn-lg" style="background-color: #047d78; color: white;">Buka Contoh File PDF</a>
                    <p class="text-muted small mt-2">Link akan dibuka di tab baru</p>
                </div>
                <div class="mt-3">
                    <strong>Isi File:</strong>
                    <ul>
                        <li>Header: Nama pasien, kategori monitoring</li>
                        <li>Data Identitas: Lengkap sesuai kategori (Ibu Hamil/Balita/Remaja)</li>
                        <li>Riwayat Penyakit: Jika ada</li>
                        <li>Detail Setiap Kunjungan: Tanggal, antropometri, keluhan, pemeriksaan, catatan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
