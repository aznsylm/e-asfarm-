<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2><i class="ti ti-users"></i> Monitoring Kesehatan Remaja</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/monitoring/dashboard') ?>">Dashboard Monitoring</a></li>
                    <li class="breadcrumb-item active">Remaja</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-warning">
                <div class="card-body text-center py-5">
                    <i class="ti ti-tool" style="font-size: 5rem; color: #ffc107;"></i>
                    <h3 class="mt-3">Fitur Dalam Pengembangan</h3>
                    <p class="text-muted">Halaman monitoring kesehatan remaja sedang dalam tahap pengembangan.</p>
                    <a href="<?= base_url('admin/monitoring/dashboard') ?>" class="btn btn-primary mt-3">
                        <i class="ti ti-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
