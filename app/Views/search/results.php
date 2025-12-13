<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?><?= $keyword ? 'Hasil Pencarian: ' . esc($keyword) : 'Pencarian' ?> - E-Asfarm<?= $this->endSection() ?>
<?= $this->section('content') ?>

<!-- Custom CSS -->
<style>
    .search-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: 1px solid #e0e0e0;
        border-radius: 0;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }
    
    .search-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(4, 125, 120, 0.15);
        border-color: #047d78;
    }
    
    .type-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        border-radius: 0;
        background-color: #047d78 !important;
    }
    
    .btn-teal {
        background-color: #047d78;
        border-color: #047d78;
        color: #fff;
        border-radius: 0;
    }
    
    .btn-teal:hover {
        background-color: #036663;
        border-color: #036663;
        color: #fff;
    }
    
    .alert {
        border-radius: 0;
    }
    
    .search-info {
        background: #f8f9fa;
        border-left: 3px solid #047d78;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }
    
    .search-info-icon {
        color: #047d78;
        margin-right: 0.5rem;
    }
    
    @media (max-width: 767.98px) {
        .search-results {
            padding: 1rem 0;
        }
        
        .search-card {
            margin-bottom: 1rem;
        }
        
        .search-card .card-body {
            padding: 1rem !important;
        }
        
        .search-card .card-footer {
            padding: 0 1rem 1rem 1rem !important;
        }
        
        .search-card .card-title {
            font-size: 1rem;
            line-height: 1.4;
        }
        
        .search-card .card-text {
            font-size: 0.875rem;
            line-height: 1.5;
        }
        
        .search-info {
            font-size: 0.8rem;
            padding: 0.6rem 0.8rem;
            margin-bottom: 1rem;
        }
        
        .search-results h2 {
            font-size: 1.25rem !important;
        }
        
        .search-results p {
            font-size: 0.875rem;
        }
    }
</style>

<div class="container-fluid search-results py-3 py-md-5">
    <div class="row">
        <div class="col-12">
                <h2 class="fw-bold mb-2 mb-md-3" style="color: #047d78;">Hasil Pencarian</h2>
                <div class="search-info">
                    <i class="fas fa-info-circle search-info-icon"></i>
                    <span class="text-muted">Pencarian mencakup: <strong>Artikel Kesehatan</strong>, <strong>Tanya Jawab (FAQ)</strong>, <strong>Poster Edukasi</strong>, <strong>Modul Edukasi</strong>, dan <strong>Halaman Menu</strong></span>
                </div>
                
                <?php if ($keyword): ?>
                    <p class="text-muted mb-3 mb-md-4">Menampilkan hasil untuk: <strong style="color: #047d78;">"<?= esc($keyword) ?>"</strong></p>
                    
                    <?php if (!empty($results)): ?>
                        <div class="row g-3 g-md-4">
                            <?php foreach ($results as $result): ?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card search-card h-100">
                                        <div class="card-body p-3 p-md-4">
                                            <span class="badge type-badge mb-2 mb-md-3"><?= $result['type'] ?></span>
                                            <h5 class="card-title fw-semibold mb-2 mb-md-3" style="color: #333;"><?= esc($result['title']) ?></h5>
                                            <p class="card-text text-muted mb-2 mb-md-3"><?= esc($result['excerpt']) ?></p>
                                            <small class="text-muted">Kategori: <?= esc($result['category']) ?></small>
                                        </div>
                                        <div class="card-footer bg-transparent border-0 p-3 p-md-4 pt-0">
                                            <a href="<?= $result['url'] ?>" class="btn btn-teal btn-sm w-100">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info border-0 shadow-sm">
                            <h5 class="fw-semibold">Tidak ada hasil ditemukan</h5>
                            <p class="mb-0">Coba gunakan kata kunci yang berbeda atau lebih spesifik.</p>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-warning border-0 shadow-sm">
                        <h5 class="fw-semibold">Masukkan kata kunci pencarian</h5>
                        <p class="mb-0">Silakan masukkan kata kunci untuk mencari artikel, FAQ, atau poster.</p>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>