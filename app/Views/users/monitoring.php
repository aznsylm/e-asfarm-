<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Monitoring Kesehatan Saya</h2>
            <p class="text-muted">Data kesehatan yang diinput oleh tenaga kesehatan</p>
        </div>
    </div>

    <!-- Ringkasan Status -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Usia Kehamilan</h6>
                    <h3 class="text-primary">4 Bulan</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Berat Badan</h6>
                    <h3 class="text-primary">67 kg</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Tekanan Darah</h6>
                    <h3 class="text-primary">100/80</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6 class="text-muted">LILA</h6>
                    <h3 class="text-primary">21 cm</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Identitas -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-user"></i> Data Identitas</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%"><strong>Nama Ibu</strong></td>
                            <td>: Lala</td>
                        </tr>
                        <tr>
                            <td><strong>Nama Suami</strong></td>
                            <td>: Aizan</td>
                        </tr>
                        <tr>
                            <td><strong>Usia Ibu</strong></td>
                            <td>: 22 tahun</td>
                        </tr>
                        <tr>
                            <td><strong>Usia Suami</strong></td>
                            <td>: 25 tahun</td>
                        </tr>
                        <tr>
                            <td><strong>No. Telepon</strong></td>
                            <td>: 08212318822</td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>: Jalan Merdeka No. 123, RT 02/RW 05, Kelurahan Sukamaju, Kecamatan Bandung Tengah, Kota Bandung, Jawa Barat, 40123</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-calendar"></i> Rencana Persalinan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="50%"><strong>Usia Kehamilan</strong></td>
                            <td>: 4 bulan</td>
                        </tr>
                        <tr>
                            <td><strong>Rencana Tanggal Persalinan</strong></td>
                            <td>: 21 Januari 2026</td>
                        </tr>
                        <tr>
                            <td><strong>Tempat Persalinan</strong></td>
                            <td>: Rumah Sakit (RS) terdekat</td>
                        </tr>
                        <tr>
                            <td><strong>Penolong Persalinan</strong></td>
                            <td>: Tenaga Kesehatan Terlatih</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Antropometri -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-chart-line"></i> Data Antropometri (Pemeriksaan Terakhir)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Tanggal Pemeriksaan</h6>
                                <h4>30 Okt 2025</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Tekanan Darah</h6>
                                <h4 class="text-primary">100/80 mmHg</h4>
                                <small class="text-success">Normal</small>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Berat Badan</h6>
                                <h4 class="text-primary">67 kg</h4>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">Tinggi Badan</h6>
                                <h4>169 cm</h4>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center p-3 border rounded">
                                <h6 class="text-muted">LILA</h6>
                                <h4 class="text-primary">21 cm</h4>
                                <small class="text-danger">Perlu Perhatian</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Keluhan & Riwayat Penyakit -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-alert-circle"></i> Keluhan</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="ti ti-check text-success"></i> Tidak ada keluhan</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-file-medical"></i> Riwayat Penyakit</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li><i class="ti ti-point-filled text-danger"></i> Hiperkolesterol</li>
                    </ul>
                    <div class="alert alert-warning mt-3 mb-0">
                        <small><i class="ti ti-info-circle"></i> Perlu pemantauan rutin untuk kondisi hiperkolesterol</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Suplementasi -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-pill"></i> Suplementasi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Suplemen</th>
                                    <th>Status</th>
                                    <th>Jumlah</th>
                                    <th>Frekuensi</th>
                                    <th>Efek Samping</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>30 Okt 2025</td>
                                    <td><strong>Multivitamin</strong></td>
                                    <td><span class="badge bg-success">Sudah Diberikan</span></td>
                                    <td>30 tablet</td>
                                    <td>1x sehari</td>
                                    <td><span class="text-success">Tidak ada</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Etnomedisin -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="ti ti-leaf"></i> Penggunaan Obat Tradisional (Etnomedisin)</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Status Penggunaan</strong></td>
                                    <td>: <span class="badge bg-success">Ya, Menggunakan</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Tujuan Penggunaan</strong></td>
                                    <td>: Menjaga stamina ibu hamil</td>
                                </tr>
                                <tr>
                                    <td><strong>Dosis & Frekuensi</strong></td>
                                    <td>: Sesuai kebutuhan</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%"><strong>Edukasi Diberikan</strong></td>
                                    <td>: <span class="badge bg-success">Sudah</span></td>
                                </tr>
                            </table>
                            <div class="alert alert-info mt-3">
                                <small><i class="ti ti-info-circle"></i> Pastikan penggunaan obat tradisional dikonsultasikan dengan tenaga kesehatan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Catatan Penting -->
    <div class="row mt-4 mb-4">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-primary"><i class="ti ti-notes"></i> Catatan Penting</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li>Pemeriksaan rutin setiap bulan sangat dianjurkan</li>
                        <li>Konsumsi suplemen sesuai anjuran tenaga kesehatan</li>
                        <li>Perhatikan pola makan dan istirahat yang cukup</li>
                        <li>Segera hubungi tenaga kesehatan jika ada keluhan</li>
                        <li>LILA 21 cm perlu perhatian khusus - konsultasikan dengan bidan/dokter</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
