<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2><?= $title ?></h2>
            <p class="text-muted">Data monitoring kesehatan balita dan anak Anda</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-warning">
                <div class="card-body text-center py-5">
                    <i class="ti ti-baby-carriage" style="font-size: 5rem; color: #ffc107;"></i>
                    <h4 class="mt-3">Belum Ada Data Monitoring Balita & Anak</h4>
                    <p class="text-muted mb-4">Anda belum memiliki data monitoring kesehatan balita dan anak. Fitur ini akan segera tersedia.</p>
                    
                    <div class="alert alert-info text-start">
                        <h6><i class="ti ti-info-circle"></i> Informasi:</h6>
                        <ul class="mb-0">
                            <li>Fitur monitoring balita & anak sedang dalam pengembangan</li>
                            <li>Silakan hubungi admin atau kader kesehatan untuk informasi lebih lanjut</li>
                            <li>Anda akan diberitahu ketika fitur ini sudah tersedia</li>
                        </ul>
                    </div>

                    <a href="<?= base_url('pengguna/dashboard') ?>" class="btn btn-primary mt-3">
                        <i class="ti ti-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
