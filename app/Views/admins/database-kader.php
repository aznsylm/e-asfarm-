<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Database Kader</h4>
                        <p class="card-subtitle">Kelola data kesehatan masyarakat</p>
                    </div>
                    <div class="card-body">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs" id="kaderTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="ibu-hamil-tab" data-bs-toggle="tab" data-bs-target="#ibu-hamil" type="button" role="tab">
                                    <i class="ti ti-heart"></i> Ibu Hamil
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="bayi-balita-tab" data-bs-toggle="tab" data-bs-target="#bayi-balita" type="button" role="tab">
                                    <i class="ti ti-baby-carriage"></i> Bayi & Balita
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="remaja-tab" data-bs-toggle="tab" data-bs-target="#remaja" type="button" role="tab">
                                    <i class="ti ti-users"></i> Remaja
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-4" id="kaderTabsContent">
                            <!-- Ibu Hamil -->
                            <div class="tab-pane fade show active" id="ibu-hamil" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Data Kesehatan Ibu Hamil</h5>
                                        <p class="text-muted">Fitur ini akan memungkinkan admin untuk mengelola data kesehatan ibu hamil termasuk:</p>
                                        <ul>
                                            <li>Data pemeriksaan kehamilan</li>
                                            <li>Riwayat kesehatan ibu</li>
                                            <li>Jadwal kontrol rutin</li>
                                            <li>Status gizi dan vitamin</li>
                                            <li>Catatan khusus kehamilan</li>
                                        </ul>
                                        
                                        <div class="alert alert-info">
                                            <i class="ti ti-info-circle"></i>
                                            <strong>Status:</strong> Fitur dalam tahap pengembangan. Akan segera tersedia!
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <i class="ti ti-heart display-4 text-primary"></i>
                                                <h6 class="mt-3">Statistik Sementara</h6>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4 class="text-primary">125</h4>
                                                        <small>Total Ibu Hamil</small>
                                                    </div>
                                                    <div class="col-6">
                                                        <h4 class="text-success">98</h4>
                                                        <small>Kontrol Rutin</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bayi & Balita -->
                            <div class="tab-pane fade" id="bayi-balita" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Data Kesehatan Bayi & Balita</h5>
                                        <p class="text-muted">Fitur ini akan memungkinkan admin untuk mengelola data kesehatan bayi dan balita termasuk:</p>
                                        <ul>
                                            <li>Data pertumbuhan dan perkembangan</li>
                                            <li>Jadwal imunisasi</li>
                                            <li>Status gizi balita</li>
                                            <li>Riwayat penyakit</li>
                                            <li>Catatan tumbuh kembang</li>
                                        </ul>
                                        
                                        <div class="alert alert-warning">
                                            <i class="ti ti-clock"></i>
                                            <strong>Status:</strong> Dalam antrian pengembangan setelah fitur Ibu Hamil selesai.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <i class="ti ti-baby-carriage display-4 text-warning"></i>
                                                <h6 class="mt-3">Statistik Sementara</h6>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4 class="text-warning">89</h4>
                                                        <small>Total Balita</small>
                                                    </div>
                                                    <div class="col-6">
                                                        <h4 class="text-info">76</h4>
                                                        <small>Imunisasi Lengkap</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Remaja -->
                            <div class="tab-pane fade" id="remaja" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5>Data Kesehatan Remaja</h5>
                                        <p class="text-muted">Fitur ini akan memungkinkan admin untuk mengelola data kesehatan remaja termasuk:</p>
                                        <ul>
                                            <li>Data kesehatan reproduksi</li>
                                            <li>Program edukasi kesehatan</li>
                                            <li>Konseling kesehatan mental</li>
                                            <li>Status gizi remaja</li>
                                            <li>Kegiatan posyandu remaja</li>
                                        </ul>
                                        
                                        <div class="alert alert-secondary">
                                            <i class="ti ti-calendar"></i>
                                            <strong>Status:</strong> Akan dikembangkan pada fase ketiga pengembangan sistem.
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card bg-light">
                                            <div class="card-body text-center">
                                                <i class="ti ti-users display-4 text-secondary"></i>
                                                <h6 class="mt-3">Statistik Sementara</h6>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4 class="text-secondary">156</h4>
                                                        <small>Total Remaja</small>
                                                    </div>
                                                    <div class="col-6">
                                                        <h4 class="text-primary">134</h4>
                                                        <small>Aktif Program</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4 text-center">
                            <a href="<?= url_to('admin.tambah.kader') ?>" class="btn btn-primary me-2">
                                <i class="ti ti-plus"></i> Tambah Kader
                            </a>
                            <button class="btn btn-outline-primary me-2" disabled>
                                <i class="ti ti-file-export"></i> Export Data (Coming Soon)
                            </button>
                            <button class="btn btn-outline-secondary" disabled>
                                <i class="ti ti-settings"></i> Pengaturan (Coming Soon)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>