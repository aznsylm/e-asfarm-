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
                <h3 class="card-title">Export Data</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Cara Export Data</h5>
                        <p class="text-muted mb-3">Anda dapat mengexport data monitoring dalam format Excel (.xlsx) atau PDF</p>
                        
                        <h6 class="font-weight-bold">Export Semua Data (Laporan Bulanan)</h6>
                        <ol class="mb-3">
                            <li>Buka menu <strong>Laporan</strong></li>
                            <li>Pilih tab kategori (Ibu Hamil / Balita / Remaja)</li>
                            <li>Filter berdasarkan bulan & tahun</li>
                            <li>Klik tombol Export Excel atau Export PDF di atas tabel</li>
                        </ol>
                        
                        <h6 class="font-weight-bold">Export Detail Per Pasien</h6>
                        <ol>
                            <li><strong>Dari Halaman Laporan:</strong> Klik icon Excel (hijau) atau PDF (merah) di kolom Aksi</li>
                            <li><strong>Dari Halaman Riwayat:</strong> Klik tombol Export Excel/PDF di bagian atas halaman riwayat pasien</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <h5>Informasi Export</h5>
                        <div style="background-color: #f4f6f9; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                            <h6 class="font-weight-bold">Export Semua Data berisi:</h6>
                            <ul class="mb-0">
                                <li>Tabel ringkasan semua pasien</li>
                                <li>Data sesuai filter periode</li>
                                <li>Total kunjungan per pasien</li>
                            </ul>
                        </div>
                        <div style="background-color: #f4f6f9; padding: 15px; border-radius: 5px; margin-bottom: 15px;">
                            <h6 class="font-weight-bold">Export Detail Per Pasien berisi:</h6>
                            <ul class="mb-0">
                                <li>Data identitas lengkap pasien</li>
                                <li>Semua riwayat kunjungan</li>
                                <li>Detail antropometri & pemeriksaan</li>
                                <li>Catatan setiap kunjungan</li>
                            </ul>
                        </div>
                        <div class="text-center mt-3">
                            <a href="<?= base_url('admin/monitoring/laporan') ?>" class="btn btn-primary">
                                Mulai Export Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
