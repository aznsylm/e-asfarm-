<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    .layanan-link {
        text-decoration: none;
        display: block;
        height: 100%;
    }
    
    .layanan-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 5px 20px rgba(4, 125, 120, 0.1);
        height: 100%;
    }
    
    .layanan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(4, 125, 120, 0.2);
    }
    
    .layanan-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #047d78 0%, #06a39e 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
        margin: 0 auto 20px;
    }
    
    .btn-layanan {
        background: #047d78;
        color: white;
        padding: 12px 35px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-layanan:hover {
        background: #035d59;
        transform: scale(1.05);
        color: white;
    }
    
    .faq-item {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
</style>

<!-- Hero Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 text-center">
                <h3 class="fw-bold" style="color: #047d78;">Layanan E-Asfarm</h3>
                <p style="color: #666666; line-height: 1.8;">Platform kesehatan digital yang menyediakan berbagai layanan untuk mendukung kesehatan ibu dan anak</p>
            </div>
        </div>
    </div>
</section>

<!-- Layanan Overview -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <a href="#" class="layanan-link">
                    <div class="layanan-card p-4 text-center">
                        <div class="layanan-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #047d78;">Konsultasi Pakar</h4>
                        <p class="text-muted">Konsultasi langsung dengan farmasis, bidan, dan ahli gizi profesional</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="layanan-link">
                    <div class="layanan-card p-4 text-center">
                        <div class="layanan-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #047d78;">Artikel Kesehatan</h4>
                        <p class="text-muted">Artikel terpercaya seputar kesehatan ibu dan anak</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="layanan-link">
                    <div class="layanan-card p-4 text-center">
                        <div class="layanan-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #047d78;">Tanya Jawab</h4>
                        <p class="text-muted">Forum diskusi untuk berbagi pengalaman dan bertanya</p>
                    </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-3">
                <a href="#" class="layanan-link">
                    <div class="layanan-card p-4 text-center">
                        <div class="layanan-icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <h4 class="fw-bold mb-3" style="color: #047d78;">Poster Kesehatan</h4>
                        <p class="text-muted">Materi edukasi visual yang mudah dipahami</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center fw-bold mb-4" style="color: #047d78;">Pertanyaan Umum</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="faq-item">
                    <h5 class="fw-bold mb-2" style="color: #047d78;">Apakah layanan E-Asfarm gratis?</h5>
                    <p class="mb-0 text-muted">Ya, semua layanan E-Asfarm dapat diakses secara gratis oleh seluruh pengguna.</p>
                </div>
                <div class="faq-item">
                    <h5 class="fw-bold mb-2" style="color: #047d78;">Berapa lama waktu respons konsultasi?</h5>
                    <p class="mb-0 text-muted">Pakar kami akan merespons pertanyaan Anda dalam waktu maksimal 1x24 jam.</p>
                </div>
                <div class="faq-item">
                    <h5 class="fw-bold mb-2" style="color: #047d78;">Apakah informasi saya aman?</h5>
                    <p class="mb-0 text-muted">Ya, kami menjaga kerahasiaan data pribadi dan konsultasi Anda dengan sistem keamanan terbaik.</p>
                </div>
                <div class="faq-item">
                    <h5 class="fw-bold mb-2" style="color: #047d78;">Siapa yang bisa menggunakan E-Asfarm?</h5>
                    <p class="mb-0 text-muted">E-Asfarm dapat digunakan oleh siapa saja, terutama ibu hamil, ibu menyusui, dan keluarga yang peduli kesehatan, namun saat ini untuk fitur khusus hanya dapat diakses dan dikelola oleh Kalurahan Guwosari, Bantul.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
