<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<!-- Custom CSS -->
<style>
    .search-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .search-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
    }
    
    .type-badge {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
    
    @media (max-width: 767.98px) {
        .search-results {
            padding: 1rem 0.5rem;
        }
        
        .search-card {
            margin-bottom: 1rem;
        }
    }
</style>

<div class="container search-results py-3 py-md-5">
    <div class="row">
        <div class="col-12">
                <h2 class="fs-6 fs-md-4 fw-bolder mb-3 mb-md-4">Hasil Pencarian</h2>
                
                <?php if ($keyword): ?>
                    <p class="text-muted mb-3 mb-md-4 fs-4 fs-md-5">Menampilkan hasil untuk: <strong>"<?= esc($keyword) ?>"</strong></p>
                    
                    <?php if (!empty($results)): ?>
                        <div class="row g-3 g-md-4">
                            <?php foreach ($results as $result): ?>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="card search-card h-100">
                                        <div class="card-body p-3 p-md-4">
                                            <span class="badge bg-primary type-badge mb-2 mb-md-3"><?= $result['type'] ?></span>
                                            <h5 class="card-title fs-5 fs-md-4 fw-semibold mb-2 mb-md-3"><?= esc($result['title']) ?></h5>
                                            <p class="card-text text-muted fs-4 fs-md-5 mb-2 mb-md-3"><?= esc($result['excerpt']) ?></p>
                                            <small class="text-muted fs-3 fs-md-4">Kategori: <?= esc($result['category']) ?></small>
                                        </div>
                                        <div class="card-footer bg-transparent border-0 p-3 p-md-4 pt-0">
                                            <a href="<?= $result['url'] ?>" class="btn btn-primary btn-sm w-100">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info border-0 shadow-sm">
                            <h5 class="fs-5 fs-md-4 fw-semibold">Tidak ada hasil ditemukan</h5>
                            <p class="mb-0 fs-4 fs-md-5">Coba gunakan kata kunci yang berbeda atau lebih spesifik.</p>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-warning border-0 shadow-sm">
                        <h5 class="fs-5 fs-md-4 fw-semibold">Masukkan kata kunci pencarian</h5>
                        <p class="mb-0 fs-4 fs-md-5">Silakan masukkan kata kunci untuk mencari artikel, FAQ, atau unduhan.</p>
                    </div>
                <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>