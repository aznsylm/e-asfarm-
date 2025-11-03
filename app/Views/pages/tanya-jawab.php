<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<!-- Custom CSS -->
<style>
    /* Mobile-first responsive typography */
    .hero-title {
        font-size: 1.75rem;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1rem;
        line-height: 1.5;
    }
    
    @media (min-width: 768px) {
        .hero-title {
            font-size:  2.5rem;
        }
        .hero-subtitle {
            font-size: 1.125rem;
        }
    }
    
    @media (min-width: 992px) {
        .hero-title {
            font-size: 3rem;
        }
        .hero-subtitle {
            font-size: 1.25rem;
        }
    }

    /* Mobile-optimized navigation */
    .nav-pills .nav-link {
        transition: all 0.3s ease;
        border-radius: 8px !important;
        padding: 10px 12px;
        margin-bottom: 4px;
        font-size: 0.875rem;
    }
    
    @media (min-width: 768px) {
        .nav-pills .nav-link {
            padding: 12px 16px;
            font-size: 0.9rem;
        }
    }

    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
        color: #6f42c1;
        transform: translateX(2px);
    }
    
    @media (min-width: 768px) {
        .nav-pills .nav-link:hover {
            transform: translateX(4px);
        }
    }

    .nav-pills .nav-link.active {
        background-color: #6f42c1;
        color: #fff;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(111, 66, 193, 0.3);
    }

    /* Mobile-optimized accordion */
    .faq-accordion .accordion-item {
        border: none;
        margin-bottom: 12px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    @media (min-width: 768px) {
        .faq-accordion .accordion-item {
            margin-bottom: 16px;
            border-radius: 12px;
        }
    }

    .faq-accordion .accordion-button {
        background: linear-gradient(135deg, #6f42c1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 16px 20px;
        font-weight: 600;
        font-size: 0.875rem;
        line-height: 1.4;
        border-radius: 8px 8px 0 0;
    }
    
    @media (min-width: 768px) {
        .faq-accordion .accordion-button {
            padding: 20px 24px;
            font-size: 1rem;
            border-radius: 12px 12px 0 0;
        }
    }

    .faq-accordion .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #5a2d91 0%, #7c3aed 100%);
        box-shadow: none;
    }

    .faq-accordion .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        flex-shrink: 0;
        margin-left: 8px;
    }

    .faq-accordion .accordion-body {
        padding: 16px 20px;
        background: #fff;
        line-height: 1.6;
        color: #4a5568;
        font-size: 0.875rem;
    }
    
    @media (min-width: 768px) {
        .faq-accordion .accordion-body {
            padding: 24px;
            font-size: 0.9rem;
            line-height: 1.7;
        }
    }

    /* Mobile-optimized search */
    .search-box {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border: 2px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    @media (min-width: 768px) {
        .search-box {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
    }

    .search-box:focus-within {
        border-color: #6f42c1;
        box-shadow: 0 4px 20px rgba(111, 66, 193, 0.2);
    }

    .category-badge {
        background: linear-gradient(135deg, #6f42c1 0%, #8b5cf6 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 12px;
    }
    
    @media (min-width: 768px) {
        .category-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            margin-bottom: 16px;
        }
    }

    .faq-counter {
        background: #f7fafc;
        border-radius: 6px;
        padding: 10px 12px;
        margin-bottom: 20px;
        font-size: 0.8rem;
    }
    
    @media (min-width: 768px) {
        .faq-counter {
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 24px;
            font-size: 0.875rem;
        }
    }
    
    /* Mobile sidebar optimization */
    @media (max-width: 991.98px) {
        .mobile-sidebar {
            position: static !important;
            margin-bottom: 1.5rem;
        }
        
        .mobile-sidebar .card {
            border-radius: 8px;
        }
        
        .mobile-sidebar .nav-pills {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 6px;
        }
        
        .mobile-sidebar .nav-item {
            width: 100%;
        }
        
        .mobile-sidebar .nav-link {
            text-align: center;
            padding: 10px 6px;
            font-size: 0.7rem;
            line-height: 1.2;
            border-radius: 6px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 60px;
        }
        
        .mobile-sidebar .nav-link i {
            display: block;
            margin-bottom: 4px;
            font-size: 1.1rem;
        }
        
        .mobile-sidebar .nav-link span {
            font-weight: 500;
        }
    }
    
    @media (max-width: 576px) {
        .mobile-sidebar .nav-pills {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }
        
        .mobile-sidebar .nav-link {
            padding: 12px 8px;
            font-size: 0.75rem;
            min-height: 65px;
        }
        
        .mobile-sidebar .nav-link i {
            font-size: 1.2rem;
            margin-bottom: 6px;
        }
    }
    
    /* Touch-friendly buttons */
    @media (max-width: 767.98px) {
        .faq-accordion .accordion-button {
            min-height: 48px;
            touch-action: manipulation;
        }
        
        .search-box input {
            font-size: 16px; /* Prevents zoom on iOS */
        }
    }
</style>

<!-- Breadcrumb -->
<section class="py-4 py-md-5 bg-light-gray">
    <div class="container">
        <div class="d-flex justify-content-between flex-md-nowrap flex-wrap">
            <h2 class="fs-8 fs-md-15 fw-bolder">
                Tanya Jawab <?php 
                    if ($kategori['name'] == 'kehamilan') echo 'Kehamilan';
                    elseif ($kategori['name'] == 'menyusui') echo 'Menyusui';
                    elseif ($kategori['name'] == 'persalinan') echo 'Persalinan';
                    elseif ($kategori['name'] == 'vaksin') echo 'Vaksin';
                    elseif ($kategori['name'] == 'nutrisi') echo 'Nutrisi';
                    else echo ucfirst($kategori['name']);
                ?>
            </h2>
            <div class="d-flex align-items-center gap-3 gap-md-6">
                <a href="<?= base_url('/'); ?>" class="text-muted fw-bolder link-primary fs-2 fs-md-3 text-uppercase">
                    E-asfarm
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-6 fs-md-5 text-muted"></iconify-icon>
                <a href="#" class="text-muted fw-bolder link-primary fs-2 fs-md-3 text-uppercase">
                    Tanya Jawab
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-6 fs-md-5 text-muted"></iconify-icon>
                <a href="#" class="text-primary link-primary fw-bolder fs-2 fs-md-3 text-uppercase">
                    <?php 
                        if ($kategori['name'] == 'kehamilan') echo 'Kehamilan';
                        elseif ($kategori['name'] == 'menyusui') echo 'Menyusui';
                        elseif ($kategori['name'] == 'persalinan') echo 'Persalinan';
                        elseif ($kategori['name'] == 'vaksin') echo 'Vaksin';
                        elseif ($kategori['name'] == 'nutrisi') echo 'Nutrisi';
                        else echo ucfirst($kategori['name']);
                    ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-4 py-md-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm sticky-top mobile-sidebar" style="top: 100px;">
                    <div class="card-header bg-gradient text-white" style="background: linear-gradient(135deg, #6f42c1 0%, #8b5cf6 100%);">
                        <h5 class="card-title mb-0 fs-md-15"><i class="fas fa-layer-group me-1 me-md-2"></i>Kategori Lainnya</h5>
                    </div>
                    <div class="card-body p-2">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?= $kategori['name'] == 'kehamilan' ? 'active' : '' ?>" href="<?= base_url('tanya-jawab/kehamilan'); ?>">
                                    <i class="fas fa-baby me-1 me-md-2"></i><span class="d-none d-md-inline">Kehamilan</span><span class="d-md-none">Hamil</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $kategori['name'] == 'menyusui' ? 'active' : '' ?>" href="<?= base_url('tanya-jawab/menyusui'); ?>">
                                    <i class="fas fa-heart me-1 me-md-2"></i>Menyusui
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $kategori['name'] == 'persalinan' ? 'active' : '' ?>" href="<?= base_url('tanya-jawab/persalinan'); ?>">
                                    <i class="fas fa-hospital me-1 me-md-2"></i><span class="d-none d-md-inline">Persalinan</span><span class="d-md-none">Lahir</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $kategori['name'] == 'vaksin' ? 'active' : '' ?>" href="<?= base_url('tanya-jawab/vaksin'); ?>">
                                    <i class="fas fa-syringe me-1 me-md-2"></i>Vaksin
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $kategori['name'] == 'nutrisi' ? 'active' : '' ?>" href="<?= base_url('tanya-jawab/nutrisi'); ?>">
                                    <i class="fas fa-apple-alt me-1 me-md-2"></i>Nutrisi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $kategori['name'] == 'tumbuh kembang' ? 'active' : '' ?>" href="<?= base_url('tanya-jawab/tumbuh kembang'); ?>">
                                    <i class="fas fa-child me-1 me-md-2"></i><span class="d-none d-md-inline">Tumbuh Kembang</span><span class="d-md-none">Tumbuh</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= $kategori['name'] == 'etnomedisin' ? 'active' : '' ?>" href="<?= base_url('tanya-jawab/etnomedisin'); ?>">
                                    <i class="fas fa-leaf me-1 me-md-2"></i>Etnomedisin
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="col-lg-9">
                <!-- Search Box -->
                <div class="mb-3 mb-md-4">
                    <div class="search-box p-2 p-md-3">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control border-0 fs-md-15" id="searchFaq" placeholder="Cari pertanyaan...">
                        </div>
                    </div>
                </div>

                <!-- FAQ Counter -->
                <div class="faq-counter">
                    <div class="d-flex align-items-center">
                        <span class="text-muted">Menampilkan <strong><?= count($tanyaJawab); ?> pertanyaan</strong> untuk kategori <strong><?= ucfirst($kategori['name']); ?></strong></span>
                    </div>
                </div>

                <!-- FAQ Accordion -->
                <?php if (!empty($tanyaJawab)): ?>
                    <div class="accordion faq-accordion" id="faqAccordion">
                        <?php foreach ($tanyaJawab as $i => $item): ?>
                            <div class="accordion-item faq-item">
                                <h2 class="accordion-header" id="heading<?= $i; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $i; ?>" aria-expanded="false" aria-controls="collapse<?= $i; ?>">
                                        <?= esc($item['pertanyaan']); ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $i; ?>" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="flex-grow-1" style="text-align: justify;">
                                                <?php
                                                // Sanitize: hanya izinkan tag HTML aman
                                                $body = $item['jawaban'];
                                                $body = strip_tags($body, '<p><strong><em><u><a><ol><ul><li><br><h1><h2><h3><h4><h5><h6><blockquote>');
                                                $body = preg_replace('/\s?class="[^"]*ql-[^"]*"/', '', $body);
                                                $body = preg_replace('/<p><\/p>/', '', $body);
                                                ?>
                                                <?= $body; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4 py-md-5">
                        <i class="fas fa-question-circle text-muted" style="font-size: 3rem;"></i>
                        <h4 class="mt-3 text-muted fs-8 fs-md-15">Belum Ada Pertanyaan</h4>
                        <p class="text-muted fs-8 fs-md-15">Tidak ada pertanyaan tersedia untuk kategori ini saat ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="py-5 text-white" style="background-color: #2c3e50;">
    <div class="container text-center">
        <div class="d-flex align-items-center justify-content-center mb-4 pt-8">
            <a href="javascript:void(0)">
                <img src="<?= base_url('assets/images/profile/user-3.jpg'); ?>" class="rounded-circle me-n2 card-hover border border-2 border-white" width="44" height="44">
            </a>
            <a href="javascript:void(0)">
                <img src="<?= base_url('assets/images/profile/user-2.jpg'); ?>" class="rounded-circle me-n2 card-hover border border-2 border-white" width="44" height="44">
            </a>
            <a href="javascript:void(0)">
                <img src="<?= base_url('assets/images/profile/user-4.jpg'); ?>" class="rounded-circle me-n2 card-hover border border-2 border-white" width="44" height="44">
            </a>
        </div>
        <h2 class="mb-3 mb-md-4 text-white fs-8 fs-md-15">Masih punya pertanyaan?</h2>
        <p class="lead mb-4 mb-md-5 fs-8 fs-md-15">Tidak menemukan jawaban yang Anda cari? Silakan hubungi tim kami yang siap membantu Anda.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="<?= url_to('kontak'); ?>" class="btn btn-outline-light btn-lg px-3 px-md-4 fs-8 fs-md-15">
                <i class="fas fa-comments me-1 me-md-2"></i>Hubungi Kami
            </a>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Search functionality
        const searchInput = document.getElementById('searchFaq');
        const faqItems = document.querySelectorAll('.faq-item');
        
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let visibleCount = 0;
            
            faqItems.forEach(item => {
                const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Update counter
            const counter = document.querySelector('.faq-counter span');
            if (searchTerm) {
                counter.innerHTML = `Menampilkan <strong>${visibleCount} pertanyaan</strong> dari hasil pencarian "${searchTerm}"`;
            } else {
                counter.innerHTML = `Menampilkan <strong><?= count($tanyaJawab); ?> pertanyaan</strong> untuk kategori <strong><?= ucfirst($kategori['name']); ?></strong>`;
            }
        });
        
        // Auto-expand first FAQ item
        const firstAccordion = document.querySelector('#collapse0');
        const firstButton = document.querySelector('[data-bs-target="#collapse0"]');
        if (firstAccordion && firstButton) {
            firstAccordion.classList.add('show');
            firstButton.classList.remove('collapsed');
            firstButton.setAttribute('aria-expanded', 'true');
        }
    });
</script>

<?= $this->endSection() ?>