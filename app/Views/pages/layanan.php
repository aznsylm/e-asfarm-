<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #2e59d9;
        --accent-color: #1cc88a;
        --dark-color: #2c3e50;
        --light-color: #f8f9fc;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7ff;
        color: #333;
    }

    .service-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s, box-shadow 0.3s;
        margin-bottom: 20px;
        background-color: white;
        padding: 1rem;
    }
    
    @media (min-width: 768px) {
        .service-card {
            margin-bottom: 30px;
            padding: 1.5rem;
        }
    }

    @media (min-width: 768px) {
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
    }

    .service-icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
        color: var(--primary-color);
    }
    
    @media (min-width: 768px) {
        .service-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
    }

    .feature-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: rgba(30, 204, 138, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
        color: var(--accent-color);
        font-size: 1.25rem;
    }
    
    @media (min-width: 768px) {
        .feature-icon {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
    }

    .section-title {
        position: relative;
        margin-bottom: 3rem;
        font-weight: 700;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: var(--accent-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 500;
    }
    
    @media (min-width: 768px) {
        .btn-primary {
            padding: 10px 25px;
        }
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .service-card {
        position: relative;
        overflow: visible;
    }
    
    .service-card::before {
        content: '';
        position: absolute;
        top: -5px;
        left: -5px;
        right: -5px;
        bottom: -5px;
        background: linear-gradient(45deg, var(--primary-color), var(--accent-color), var(--secondary-color));
        border-radius: 20px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    @media (min-width: 768px) {
        .service-card:hover::before {
            opacity: 0.1;
        }
    }
    
    .feature-icon {
        transition: transform 0.3s ease;
    }
    
    .feature-icon:hover {
        transform: scale(1.1) rotate(5deg);
    }
</style>

<!-- Services Section -->
<section id="services" class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center fs-8 fs-md-15 fw-bolder mb-3 mb-md-4">Layanan Konsultasi Kesehatan</h2>
        <p class="text-center fs-4 fs-md-5 mb-4 mb-md-5 mx-auto" style="max-width: 800px; text-align: justify;">
            E-Asfarm menyediakan platform konsultasi kesehatan online dengan Farmasis, Bidan, dan Ahli Gizi dari Universitas Alma Ata. Dapatkan solusi kesehatan yang tepat untuk persiapan kehamilan, masa kehamilan, hingga pasca-persalinan melalui konsultasi gratis dan terpercaya.
        </p>

        <!-- Service 1 - Left Aligned -->
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="service-card p-4 text-start bg-primary-subtle border-0">
                    <div class="d-flex align-items-center mb-3">
                        <div class="service-icon me-3 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h3 class="fs-6 fs-md-5 fw-semibold mb-0">Konsultasi Farmasi</h3>
                    </div>
                    <p class="fs-4 fs-md-4" style="text-align: justify;">Konsultasi dengan <a href="<?= url_to('kontak'); ?>" class="text-primary fw-semibold">farmasis profesional</a> tentang penggunaan obat yang aman selama kehamilan dan pasca-persalinan.</p>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                    <i class="fas fa-pills text-primary" style="font-size: 4rem;"></i>
                </div>
            </div>
        </div>

        <!-- Service 2 - Right Aligned -->
        <div class="row mb-5 align-items-center">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <div class="service-card p-4 text-start bg-success-subtle border-0">
                    <div class="d-flex align-items-center mb-3">
                        <div class="service-icon me-3 bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-baby"></i>
                        </div>
                        <h3 class="fs-6 fs-md-5 fw-semibold mb-0">Konsultasi Kebidanan</h3>
                    </div>
                    <p class="fs-4 fs-md-4" style="text-align: justify;">Tanya jawab dengan <a href="<?= url_to('kontak'); ?>" class="text-success fw-semibold">bidan berpengalaman</a> mengenai perkembangan kehamilan, persiapan persalinan, dan perawatan pasca-persalinan.</p>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1 text-center d-none d-lg-block">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                    <i class="fas fa-baby text-success" style="font-size: 4rem;"></i>
                </div>
            </div>
        </div>

        <!-- Service 3 - Left Aligned -->
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="service-card p-4 text-start bg-warning-subtle border-0">
                    <div class="d-flex align-items-center mb-3">
                        <div class="service-icon me-3 bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h3 class="fs-6 fs-md-5 fw-semibold mb-0">Konsultasi Gizi</h3>
                    </div>
                    <p class="fs-4 fs-md-4" style="text-align: justify;">Dapatkan panduan nutrisi dari <a href="<?= url_to('kontak'); ?>" class="text-warning fw-semibold">ahli gizi</a> untuk ibu hamil dan menyusui, serta saran diet yang mendukung kesehatan optimal.</p>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 200px; height: 200px;">
                    <i class="fas fa-utensils text-warning" style="font-size: 4rem;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Info Section -->
<section id="info" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fs-8 fs-md-15 fw-bolder mb-3 mb-md-4">Informasi Medis dan Kesehatan</h2>
        <p class="text-center fs-4 fs-md-5 mb-4 mb-md-5 mx-auto" style="max-width: 800px; text-align: justify;">
            Akses berbagai artikel kesehatan, panduan medis, dan tips praktis yang telah ditinjau oleh tenaga ahli. Semua informasi disajikan dengan bahasa yang mudah dipahami untuk mendukung kesehatan ibu dan anak.
        </p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-flex flex-column h-100 p-4 bg-white rounded-3 shadow-sm position-relative" style="transform: translateY(-20px);">
                    <div class="feature-icon mx-auto bg-primary-subtle">
                        <i class="fas fa-book-open text-primary"></i>
                    </div>
                    <h3 class="text-center fs-6 fs-md-5 fw-semibold mb-3">Artikel Kesehatan</h3>
                    <p class="fs-4 fs-md-4" style="text-align: justify;">Baca <a href="<?= url_to('beranda'); ?>#ArtikelTerbaru" class="text-primary fw-semibold">artikel kesehatan</a> tentang perawatan prenatal, tanda-tanda awal kehamilan, persiapan persalinan, dan perawatan bayi baru lahir.</p>
                    <div class="position-absolute top-0 end-0 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 30px; height: 30px; transform: translate(10px, -10px);">
                        <i class="fas fa-star text-white" style="font-size: 0.8rem;"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex flex-column h-100 p-4 bg-white rounded-3 shadow-sm position-relative" style="transform: translateY(20px);">
                    <div class="feature-icon mx-auto bg-success-subtle">
                        <i class="fas fa-file-medical text-success"></i>
                    </div>
                    <h3 class="text-center fs-6 fs-md-5 fw-semibold mb-3">Panduan Medis</h3>
                    <p class="fs-4 fs-md-4" style="text-align: justify;">Akses <a href="<?= base_url('unduhan/kategori/semua'); ?>" class="text-success fw-semibold">panduan medis</a> yang jelas mengenai prosedur kesehatan, perawatan diri, dan penanganan kondisi umum selama kehamilan dan pasca-persalinan.</p>
                    <div class="position-absolute bottom-0 start-0 bg-success rounded-circle d-flex align-items-center justify-content-center" style="width: 25px; height: 25px; transform: translate(-10px, 10px);">
                        <i class="fas fa-check text-white" style="font-size: 0.7rem;"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="d-flex flex-column h-100 p-4 bg-white rounded-3 shadow-sm position-relative">
                    <div class="feature-icon mx-auto bg-warning-subtle">
                        <i class="fas fa-lightbulb text-warning"></i>
                    </div>
                    <h3 class="text-center fs-6 fs-md-5 fw-semibold mb-3">Tips Kesehatan</h3>
                    <p class="fs-4 fs-md-4" style="text-align: justify;">Dapatkan tips praktis dan saran harian melalui <a href="<?= url_to('beranda'); ?>#ArtikelTerbaru" class="text-warning fw-semibold">artikel dan panduan</a> untuk menjaga kesehatan ibu dan bayi selama masa kehamilan dan setelah melahirkan.</p>
                    <div class="position-absolute top-0 start-0 bg-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px; transform: translate(-15px, -15px);">
                        <i class="fas fa-heart text-white" style="font-size: 0.9rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>