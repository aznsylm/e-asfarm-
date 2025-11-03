<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<!-- Custom CSS -->
<style>
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 100px;
    }

    .nav-pills .nav-link {
        transition: background-color 0.3s, color 0.3s;
        border-radius: 0.25rem !important;
        font-size: 0.875rem;
        padding: 8px 12px;
    }
    
    @media (min-width: 768px) {
        .nav-pills .nav-link {
            font-size: 0.9rem;
            padding: 10px 16px;
        }
    }

    .nav-pills .nav-link:hover {
        background-color: #f8f9fa;
        color: #6f42c1;
    }

    .nav-pills .nav-link.active {
        background-color: #6f42c1;
        color: #fff;
        font-weight: 500;
    }

    .guide-section {
        margin-bottom: 3rem;
        scroll-margin-top: 100px;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    @media (min-width: 768px) {
        .guide-section {
            padding: 2rem;
        }
    }

    .section-header {
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }
    
    @media (min-width: 768px) {
        .section-header {
            margin-bottom: 2rem;
        }
    }

    .content-box {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    @media (min-width: 768px) {
        .content-box {
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
    }
    
    .content-box p, .guide-section p, .card-body p {
        color: #212529 !important;
        font-weight: 400;
        text-align: justify;
    }
    
    .content-box li, .guide-section li, .card-body li {
        color: #212529 !important;
        font-weight: 400;
    }

    .sticky-sidebar {
        position: sticky;
        top: 100px;
        z-index: 1020;
    }
    
    @media (max-width: 991.98px) {
        .sticky-sidebar {
            position: static;
            margin-bottom: 2rem;
        }
    }

    .zigzag-layout .row:nth-child(even) {
        flex-direction: row-reverse;
    }
    
    @media (max-width: 991.98px) {
        .zigzag-layout .row {
            flex-direction: column !important;
        }
    }
</style>

<!-- Breadcrumb -->
<section class="py-4 py-md-5 bg-light-gray">
    <div class="container">
        <div class="d-flex justify-content-between flex-md-nowrap flex-wrap">
            <h2 class="fs-6 fs-md-4 fw-bolder">Petunjuk Penggunaan</h2>
            <div class="d-flex align-items-center gap-3 gap-md-6">
                <a href="<?= base_url('/'); ?>" class="text-muted fw-bolder link-primary fs-2 fs-md-3 text-uppercase">
                    E-asfarm
                </a>
                <iconify-icon icon="solar:alt-arrow-right-outline" class="fs-6 fs-md-5 text-muted"></iconify-icon>
                <a href="#" class="text-primary link-primary fw-bolder fs-2 fs-md-3 text-uppercase">
                    Petunjuk
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<section class="py-3 py-md-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!-- Sidebar Navigasi Panduan -->
                <div class="card shadow-sm sticky-sidebar">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Daftar Panduan</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column" id="guideNav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#section1" data-section="section1">Navigasi Website</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#section2" data-section="section2">Fitur Pencarian</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#section3" data-section="section3">Untuk Pengunjung</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#section4" data-section="section4">User Terdaftar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#section5" data-section="section5">Kevalidan Info</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 zigzag-layout">
                <!-- Section 1 -->
                <div class="guide-section" id="section1">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="section-header">
                                <h3 class="fw-bold text-dark">Cara Menggunakan Website E-Asfarm</h3>
                            </div>
                            <p class="mb-3 mb-md-4">E-Asfarm adalah website kesehatan yang menyediakan informasi seputar kehamilan, persalinan, dan kesehatan ibu. Website ini mudah digunakan dengan 5 menu utama di bagian atas.</p>
                        </div>
                        <div class="col-lg-6">
                            <div class="content-box">
                                <h5 class="fw-semibold mb-3">Menu Utama Website:</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><strong>Beranda:</strong> Artikel terbaru dan informasi penting</li>
                                    <li class="mb-2"><strong>Info:</strong> Tentang E-Asfarm dan layanan</li>
                                    <li class="mb-2"><strong>Artikel:</strong> Farmasi, Kebidanan, dan Gizi</li>
                                    <li class="mb-2"><strong>Tanya Jawab:</strong> FAQ seputar kesehatan ibu</li>
                                    <li class="mb-2"><strong>Unduhan:</strong> Modul dan flayer gratis</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2 -->
                <div class="guide-section" id="section2">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="content-box">
                                <h5 class="fw-semibold mb-3">Apa yang bisa dicari?</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-primary">Artikel Kesehatan</h6>
                                        <p class="small mb-0">Ketik "anemia" untuk mencari artikel tentang anemia pada ibu hamil</p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="text-primary">Tanya Jawab</h6>
                                        <p class="small mb-0">Ketik "mual" untuk mencari pertanyaan seputar mual saat hamil</p>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-primary">File Unduhan</h6>
                                        <p class="small mb-0">Ketik "gizi" untuk mencari modul tentang gizi</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="section-header">
                                <h3 class="fw-bold text-dark">Cara Mencari Informasi</h3>
                            </div>
                            <p class="mb-3">Di pojok kanan atas website, ada kotak pencarian yang sangat berguna. Anda bisa mengetik kata kunci apa saja untuk mencari informasi di seluruh website.</p>
                            <div class="alert alert-info">
                                <strong>Tips:</strong> Gunakan kata kunci sederhana seperti "hamil", "bayi", "ASI", atau "vaksin" untuk hasil pencarian yang lebih baik.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 3 -->
                <div class="guide-section" id="section3">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="section-header">
                                <h3 class="fw-bold text-dark">Untuk Pengunjung Biasa</h3>
                            </div>
                            <p class="mb-3 mb-md-4">Siapa saja bisa menggunakan website E-Asfarm tanpa perlu mendaftar. Sebagai pengunjung biasa, Anda bisa:</p>
                            <div class="content-box">
                                <h5 class="fw-semibold mb-3">1. Membaca Semua Artikel Gratis</h5>
                                <p class="mb-2">Semua artikel di website ini bisa dibaca gratis tanpa perlu login. Artikel ditulis oleh dokter, bidan, dan ahli gizi yang berpengalaman.</p>
                                <ul class="mb-0">
                                    <li>Tips kehamilan sehat</li>
                                    <li>Cara merawat bayi baru lahir</li>
                                    <li>Nutrisi ibu hamil dan menyusui</li>
                                    <li>Informasi obat-obatan yang aman</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="content-box mb-3">
                                <h5 class="fw-semibold mb-3">2. Mencari Jawaban di Tanya Jawab</h5>
                                <p class="mb-2">Bagian <a href="<?= base_url('/tanya-jawab/kehamilan'); ?>" class="text-primary fw-bold">Tanya Jawab</a> berisi pertanyaan-pertanyaan yang sering ditanyakan ibu hamil dan menyusui. Misalnya:</p>
                                <ul class="mb-0">
                                    <li>"Bolehkah ibu hamil minum kopi?"</li>
                                    <li>"Kapan waktu yang tepat untuk memberikan MPASI?"</li>
                                    <li>"Apa tanda-tanda persalinan sudah dekat?"</li>
                                </ul>
                            </div>
                            <div class="content-box">
                                <h5 class="fw-semibold mb-3">3. Mengunduh Materi Edukasi</h5>
                                <p class="mb-2">Di bagian <a href="<?= base_url('/unduhan'); ?>" class="text-primary fw-bold">Unduhan</a>, tersedia file-file gratis yang bisa diunduh seperti modul panduan kehamilan, brosur tentang ASI eksklusif, dan panduan gizi seimbang.</p>
                                <p class="text-muted small mb-0">File-file ini bisa disimpan di HP atau dicetak untuk dibaca kapan saja.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 4 -->
                <div class="guide-section" id="section4">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="content-box">
                                <h5 class="fw-semibold mb-3">1. Bisa Menulis Artikel Sendiri</h5>
                                <p class="mb-2">Sebagai user terdaftar, Anda bisa menulis artikel kesehatan sendiri dan membagikan pengetahuan kepada ibu-ibu lainnya. Artikel yang Anda tulis akan:</p>
                                <ul class="mb-0">
                                    <li>Direview terlebih dahulu oleh admin untuk memastikan informasinya benar</li>
                                    <li>Dipublikasi di website jika sudah disetujui</li>
                                    <li>Membantu banyak ibu mendapatkan informasi kesehatan yang tepat</li>
                                </ul>
                            </div>
                            <div class="content-box">
                                <h5 class="fw-semibold mb-3">2. Mengelola Artikel Pribadi</h5>
                                <p class="mb-2">Setelah login, Anda akan melihat menu "Artikel Saya" di bagian atas website. Di sini Anda bisa melihat semua artikel, mengedit artikel, dan melihat status artikel Anda.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="section-header">
                                <h3 class="fw-bold text-dark">Untuk User Terdaftar</h3>
                            </div>
                            <p class="mb-3 mb-md-4">Jika Anda adalah tenaga kesehatan atau memiliki pengetahuan medis yang ingin dibagikan, Anda bisa mendaftar sebagai user terdaftar.</p>
                            <div class="content-box">
                                <h5 class="fw-semibold mb-3">3. Proses Review Artikel</h5>
                                <p class="mb-2">Setiap artikel yang Anda tulis akan melalui proses review untuk memastikan:</p>
                                <ul class="mb-3">
                                    <li>Informasi medis yang akurat dan tidak menyesatkan</li>
                                    <li>Bahasa yang mudah dipahami oleh ibu-ibu</li>
                                    <li>Tidak ada promosi produk atau layanan tertentu</li>
                                </ul>
                                <div class="alert alert-info">
                                    <strong>Cara Mendaftar:</strong> Hubungi kami melalui <a href="<?= base_url('/kontak'); ?>" class="text-primary fw-bold">halaman Kontak</a> untuk mendapatkan akses sebagai user terdaftar.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5 -->
                <div class="guide-section" id="section5">
                    <div class="section-header">
                        <h3 class="fw-bold text-dark">Keamanan dan Kevalidan Informasi</h3>
                    </div>
                    <div>
                        <p class="lead mb-3 mb-md-4">Kami sangat memperhatikan kualitas informasi yang disajikan di website E-Asfarm. Berikut jaminan yang kami berikan:</p>
                        
                        <div class="content-box mb-3 mb-md-4">
                            <h5 class="text-primary fw-bold mb-3">Penulis Berpengalaman</h5>
                            <p class="mb-3">Semua artikel ditulis oleh tenaga kesehatan yang berpengalaman seperti:</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">Dokter spesialis kandungan</li>
                                        <li class="mb-2">Bidan berpengalaman</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">Ahli gizi klinis</li>
                                        <li class="mb-2">Dosen kesehatan masyarakat</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="content-box mb-3 mb-md-4">
                            <h5 class="text-primary fw-bold mb-3">Proses Review Ketat</h5>
                            <p class="mb-3">Setiap artikel melalui proses review yang ketat untuk memastikan:</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">Informasi medis yang akurat dan terkini</li>
                                        <li class="mb-2">Tidak ada informasi yang dapat membahayakan</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">Bahasa yang mudah dipahami</li>
                                        <li class="mb-2">Referensi dari sumber terpercaya</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-warning border-0" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);">
                            <strong>Penting untuk Diingat:</strong> Informasi di website ini hanya untuk edukasi. Jika Anda memiliki keluhan kesehatan atau kondisi medis tertentu, selalu konsultasikan dengan dokter atau bidan terdekat. Jangan mengganti konsultasi medis dengan informasi dari internet.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Improved JavaScript for Navigation -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sections = document.querySelectorAll(".guide-card");
        const navLinks = document.querySelectorAll(".nav-pills .nav-link");
        let lastActiveLink = document.querySelector('.nav-pills .nav-link.active');
        
        // Debounce function to improve performance
        function debounce(func, wait = 100) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    func.apply(this, args);
                }, wait);
            };
        }

        // Update active nav link based on scroll position
        function updateActiveNavLink() {
            let fromTop = window.scrollY + 120;
            const sections = document.querySelectorAll(".guide-section");
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');
                
                if (fromTop >= sectionTop && fromTop < sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        link.classList.remove("active");
                        if (link.getAttribute("href") === `#${sectionId}`) {
                            link.classList.add("active");
                            lastActiveLink = link;
                        }
                    });
                }
            });
        }

        // Click handler for nav links
        navLinks.forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault();
                
                // Remove active class from all links
                navLinks.forEach(l => l.classList.remove("active"));
                
                // Add active class to clicked link
                this.classList.add("active");
                lastActiveLink = this;
                
                // Smooth scroll to target section
                const targetId = this.getAttribute("href");
                const targetSection = document.querySelector(targetId);
                if (targetSection) {
                    window.scrollTo({
                        top: targetSection.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Throttled scroll event listener
        window.addEventListener("scroll", debounce(updateActiveNavLink));
        
        // Initial check on page load
        updateActiveNavLink();
    });
</script>

<?= $this->endSection() ?>