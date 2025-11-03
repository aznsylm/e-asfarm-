<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
    :root {
        --primary-color: #4e73df;
        --secondary-color: #2e59d9;
        --accent-color: #1cc88a;
        --dark-color: #2c3e50;
        --light-color: #f8f9fc;
        --whatsapp-green: #25D366;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f5f7ff;
        color: #333;
    }



    .contact-card {
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
        .contact-card {
            margin-bottom: 30px;
            padding: 1.5rem;
        }
    }



    .contact-form .form-control {
        background-color: #f8f9fc;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 10px 15px;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }
    
    @media (min-width: 768px) {
        .contact-form .form-control {
            padding: 12px 15px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }
    }

    .contact-form .form-control:focus {
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
        border-color: var(--primary-color);
    }

    .submit-btn {
        background-color: var(--whatsapp-green);
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        width: 100%;
        font-size: 0.9rem;
    }
    
    @media (min-width: 768px) {
        .submit-btn {
            padding: 12px 30px;
            font-size: 1rem;
        }
    }

    .submit-btn:hover {
        background-color: #128C7E;
        transform: translateY(-2px);
    }

    .map-container {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-top: 2rem;
    }

    .map-container iframe {
        width: 100%;
        height: 250px;
        border: none;
    }
    
    @media (min-width: 768px) {
        .map-container iframe {
            height: 350px;
        }
    }

    .whatsapp-float {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background-color: var(--whatsapp-green);
        color: white;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        z-index: 100;
        transition: all 0.3s;
        text-decoration: none;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
        background-color: #128C7E;
        color: white;
    }
    
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    .pulse-animation {
        animation: pulse 2s ease-in-out infinite;
    }
    
    .contact-hero {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        padding: 2rem 0;
        position: relative;
        overflow: hidden;
    }
    
    .floating-icon {
        position: absolute;
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    
    .contact-stats {
        background: white;
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
        height: 100%;
    }
    
    @media (min-width: 768px) {
        .contact-stats {
            padding: 1.5rem;
        }
        
        .contact-stats:hover {
            transform: translateY(-5px);
        }
    }
    
    .contact-stats i {
        font-size: 1.5rem;
    }
    
    @media (min-width: 768px) {
        .contact-stats i {
            font-size: 2rem;
        }
    }
    
    .contact-stats h4 {
        font-size: 0.9rem;
    }
    
    @media (min-width: 768px) {
        .contact-stats h4 {
            font-size: 1.1rem;
        }
    }
    
    .contact-stats p {
        font-size: 0.75rem;
    }
    
    @media (min-width: 768px) {
        .contact-stats p {
            font-size: 0.9rem;
        }
    }
    
    .zigzag-form {
        position: relative;
    }
    
    .form-decoration {
        position: absolute;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        z-index: 1;
    }
    
    .mobile-form-header {
        text-align: center;
        padding: 1.5rem 1rem;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 15px 15px 0 0;
        margin: -1rem -1rem 1.5rem -1rem;
    }
    
    @media (min-width: 768px) {
        .mobile-form-header {
            display: none;
        }
    }
    
    .mobile-specialists {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        margin-top: 2rem;
    }
    
    @media (min-width: 992px) {
        .mobile-specialists {
            display: none;
        }
    }
    
    .contact-info-mobile {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .contact-info-mobile .icon-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .whatsapp-float {
        width: 50px;
        height: 50px;
        font-size: 1.5rem;
        bottom: 20px;
        right: 20px;
    }
    
    @media (min-width: 768px) {
        .whatsapp-float {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
            bottom: 30px;
            right: 30px;
        }
    }
</style>

<!-- Contact Stats Section -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="contact-stats">
                    <i class="fas fa-clock text-primary mb-2"></i>
                    <h4 class="fw-semibold mb-1">24/7</h4>
                    <p class="mb-0 text-muted">Siap Membantu</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="contact-stats">
                    <i class="fas fa-user-md text-success mb-2"></i>
                    <h4 class="fw-semibold mb-1">3 Ahli</h4>
                    <p class="mb-0 text-muted">Spesialis</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="contact-stats">
                    <i class="fas fa-heart text-danger mb-2"></i>
                    <h4 class="fw-semibold mb-1">Gratis</h4>
                    <p class="mb-0 text-muted">Konsultasi</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="contact-stats">
                    <i class="fas fa-shield-alt text-warning mb-2"></i>
                    <h4 class="fw-semibold mb-1">Terpercaya</h4>
                    <p class="mb-0 text-muted">Universitas</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- WhatsApp Form Section -->
<section id="whatsapp-form" class="py-5 bg-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="zigzag-form position-relative">
                    <div class="contact-card p-4 shadow-lg">
                        <div class="mb-4 d-md-block">
                            <h2 class="fs-6 fs-md-5 fw-bolder mb-3">Kirim Pesan WhatsApp</h2>
                            <p class="fs-4 fs-md-4 text-muted">Isi form dan pesan langsung terkirim ke WhatsApp kami</p>
                        </div>

                        <form id="whatsappForm" class="contact-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="nama" class="form-control" placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="number" id="usia" class="form-control" placeholder="Usia (tahun)" min="1" max="100" required>
                                </div>
                            </div>

                            <select id="kebutuhan" class="form-control" required>
                                <option value="" disabled selected>Pilih Kebutuhan Anda</option>
                                <option value="Konsultasi Farmasi">Konsultasi Farmasi</option>
                                <option value="Konsultasi Bidan">Konsultasi Bidan</option>
                                <option value="Konsultasi Gizi">Konsultasi Gizi</option>
                                <option value="Informasi Layanan">Informasi Layanan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>

                            <textarea id="pesan" class="form-control" rows="4" placeholder="Tulis pesan Anda disini..." required></textarea>

                            <div class="d-grid mt-3">
                                <button type="submit" class="submit-btn text-white">
                                    <i class="fab fa-whatsapp me-2"></i>Kirim via WhatsApp
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 d-none d-lg-block">
                <div class="text-center">
                    <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 250px; height: 250px;">
                        <i class="fab fa-whatsapp text-success" style="font-size: 5rem;"></i>
                    </div>
                    <div class="mt-4">
                        <h3 class="fs-6 fs-md-5 fw-semibold mb-3">Respon Cepat</h3>
                        <p class="fs-4 fs-md-4 text-muted">Tim kami akan merespon pesan Anda dalam waktu kurang dari 5 menit</p>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <div class="text-center">
                                <i class="fas fa-pills text-primary fs-3"></i>
                                <p class="fs-4 mb-0 mt-1">Farmasi</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-baby text-success fs-3"></i>
                                <p class="fs-4 mb-0 mt-1">Bidan</p>
                            </div>
                            <div class="text-center">
                                <i class="fas fa-utensils text-warning fs-3"></i>
                                <p class="fs-4 mb-0 mt-1">Gizi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Specialists Section -->
        <div class="mobile-specialists d-block d-lg-none">
            <h3 class="fs-5 fw-semibold mb-3 text-center">Konsultasi dengan Ahli</h3>
            <div class="row g-3">
                <div class="col-4">
                    <div class="text-center p-2">
                        <i class="fas fa-pills text-primary fs-2 mb-2"></i>
                        <p class="fs-4 mb-0 fw-semibold">Farmasi</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center p-2">
                        <i class="fas fa-baby text-success fs-2 mb-2"></i>
                        <p class="fs-4 mb-0 fw-semibold">Bidan</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center p-2">
                        <i class="fas fa-utensils text-warning fs-2 mb-2"></i>
                        <p class="fs-4 mb-0 fw-semibold">Gizi</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <p class="fs-4 text-muted mb-0">Respon dalam waktu kurang dari 5 menit</p>
            </div>
        </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="fs-6 fs-md-15 fw-bolder mb-3">Kunjungi Kami</h2>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="contact-info-mobile">
                            <div class="icon-wrapper bg-primary-subtle">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <div>
                                <h4 class="fs-5 fw-semibold mb-1">Alamat</h4>
                                <p class="fs-4 mb-0 text-muted">Jl. Brawijaya 99, Yogyakarta 55183</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-info-mobile">
                            <div class="icon-wrapper bg-success-subtle">
                                <i class="fas fa-phone text-success"></i>
                            </div>
                            <div>
                                <h4 class="fs-5 fw-semibold mb-1">WhatsApp</h4>
                                <p class="fs-4 mb-0 text-muted">+62 857-4528-4228</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-info-mobile">
                            <div class="icon-wrapper bg-warning-subtle">
                                <i class="fas fa-clock text-warning"></i>
                            </div>
                            <div>
                                <h4 class="fs-5 fw-semibold mb-1">Jam Operasional</h4>
                                <p class="fs-4 mb-0 text-muted">Senin - Sabtu: 08.00 - 17.00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="map-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.098769712979!2d110.4081493152588!3d-7.779888894393955!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59f1fb2f2b45%3A0x20986e2a5a5a5a5a!2sJl.%20Brawijaya%2099%2C%20Yogyakarta%2055183!5e0!3m2!1sen!2sid!4v1621234567890!5m2!1sen!2sid" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('whatsappForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // Ambil nilai dari form
        const nama = document.getElementById('nama').value;
        const usia = document.getElementById('usia').value;
        const kebutuhan = document.getElementById('kebutuhan').value;
        const pesan = document.getElementById('pesan').value;

        // Buat pesan WhatsApp
        const whatsappMessage = `*PESAN DARI WEBSITE E-ASFARM*%0A%0AHalo E-Asfarm,%0A%0ASaya ${nama}, usia ${usia} tahun.%0AKebutuhan: ${kebutuhan}.%0A%0APesan:%0A${pesan}%0A%0A_Pesan ini dikirim melalui form kontak di website e-asfarm.com_`;

        // Redirect ke WhatsApp
        window.open(`https://wa.me/6285745284228?text=${whatsappMessage}`, '_blank');

        // Reset form setelah pengiriman
        this.reset();
    });
</script>

<?= $this->endSection() ?>
<!-- Tombol WhatsApp Float -->
<a href="https://wa.me/6285745284228" class="whatsapp-float" target="_blank">
    <i class="fab fa-whatsapp"></i>
</a>