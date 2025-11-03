<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Dashboard Monitoring Kesehatan</h2>
            <p class="text-muted">Pilih kategori monitoring yang ingin Anda kelola</p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Kategori 1: Ibu Hamil dan Menyusui -->
        <div class="col-md-4">
            <div class="card h-100 border-primary shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="ti ti-pregnant" style="font-size: 4rem; color: #667eea;"></i>
                    </div>
                    <h4 class="card-title">Kesehatan Ibu Hamil dan Menyusui</h4>
                    <p class="card-text text-muted">Monitoring kesehatan ibu hamil, pemeriksaan rutin, dan suplementasi</p>
                    <div class="mt-4">
                        <a href="<?= base_url('admin/monitoring/ibu-hamil') ?>" class="btn btn-primary w-100">
                            <i class="ti ti-clipboard-check"></i> Kelola Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori 2: Balita dan Anak -->
        <div class="col-md-4">
            <div class="card h-100 border-success shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="ti ti-baby-carriage" style="font-size: 4rem; color: #28a745;"></i>
                    </div>
                    <h4 class="card-title">Kesehatan Balita dan Anak</h4>
                    <p class="card-text text-muted">Monitoring tumbuh kembang balita dan anak</p>
                    <div class="mt-4">
                        <a href="<?= base_url('admin/monitoring/balita') ?>" class="btn btn-success w-100">
                            <i class="ti ti-clipboard-check"></i> Kelola Data
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori 3: Remaja -->
        <div class="col-md-4">
            <div class="card h-100 border-info shadow-sm">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="ti ti-users" style="font-size: 4rem; color: #17a2b8;"></i>
                    </div>
                    <h4 class="card-title">Kesehatan Remaja</h4>
                    <p class="card-text text-muted">Monitoring kesehatan dan perkembangan remaja</p>
                    <div class="mt-4">
                        <a href="<?= base_url('admin/monitoring/remaja') ?>" class="btn btn-info w-100">
                            <i class="ti ti-clipboard-check"></i> Kelola Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-body">
                    <h5 class="text-primary"><i class="ti ti-info-circle"></i> Informasi</h5>
                    <ul class="mb-0">
                        <li>Pilih kategori monitoring sesuai dengan jenis pasien yang akan didata</li>
                        <li>Setiap kategori memiliki form input yang disesuaikan dengan kebutuhan monitoring</li>
                        <li>Data monitoring dapat dilihat oleh pasien melalui dashboard mereka</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
