<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
.running-text-wrapper {
    overflow: hidden;
    /* background: #fff; */
    padding: 0.25rem 0;
}
.running-text-container {
    display: flex;
    height: 45px;
}
@media (min-width: 992px) {
    .running-text-wrapper {
        padding: 0.5rem 0;
    }
    .running-text-container {
        max-width: 1320px;
        margin: 0 auto;
        padding: 0 15px;
    }
}
.running-text-label {
    background: #047d78;
    color: #fff;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 15px;
    white-space: nowrap;
    display: flex;
    align-items: center;
}
.running-text-content {
    flex: 1;
    overflow: hidden;
    position: relative;
    background: #fff;
}
.running-text-marquee {
    display: flex;
    animation: scroll-left 15s linear infinite;
    padding: 12px 0;
}
.running-text-marquee:hover {
    animation-play-state: paused;
}
.running-text-item {
    white-space: nowrap;
    padding: 0 30px;
    color: #047d78;
    text-decoration: none;
    font-size: 14px;
    transition: all 0.3s;
}
.running-text-item:hover {
    text-decoration: underline;
    color: #036661;
}
.running-text-separator {
    color: #047d78;
    padding: 0 10px;
}
@keyframes scroll-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
@media (max-width: 768px) {
    .running-text-label {
        font-size: 13px;
        padding: 12px 15px;
    }
    .running-text-item {
        font-size: 13px;
    }
}
.hero-banner {
    margin: 0;
    padding: 0;
}
.heroSwiper {
    width: 100%;
    height: auto;
}
.heroSwiper .swiper-slide img {
    width: 100%;
    height: auto;
    display: block;
}
.heroSwiper .swiper-pagination-bullet {
    background: #fff;
    opacity: 0.5;
    width: 12px;
    height: 12px;
}
.heroSwiper .swiper-pagination-bullet-active {
    opacity: 1;
    background: #047d78;
}
.heroSwiper .swiper-button-prev,
.heroSwiper .swiper-button-next {
    color: #fff;
    background: rgba(0,0,0,0.3);
    width: 50px;
    height: 50px;
    border-radius: 50%;
}
.heroSwiper .swiper-button-prev:after,
.heroSwiper .swiper-button-next:after {
    font-size: 20px;
}
@media (min-width: 992px) {
    .hero-banner {
        padding: 0 15px;
    }
    .hero-banner .container-fluid {
        max-width: 1320px;
        margin: 0 auto;
    }
}
@media (max-width: 991px) {
    .heroSwiper .swiper-button-prev,
    .heroSwiper .swiper-button-next {
        width: 40px;
        height: 40px;
    }
    .heroSwiper .swiper-button-prev:after,
    .heroSwiper .swiper-button-next:after {
        font-size: 16px;
    }
}
.service-card {
    transition: all 0.3s;
}
.service-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15) !important;
}
@media (max-width: 767px) {
    .service-card {
        padding: 1rem !important;
    }
    .service-card i {
        font-size: 2rem !important;
        margin-bottom: 0.5rem !important;
    }
    .service-card h5 {
        font-size: 0.9rem !important;
    }
}
.artikelSwiper {
    width: 100%;
    height: 100%;
}
.artikelSwiper .swiper-slide img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-radius: 8px 8px 0 0;
}
.artikel-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}
.artikel-card h5 {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.artikel-tab {
    color: #047d78;
    border: none;
    background: transparent;
    padding: 10px 20px;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s;
}
.artikel-tab.active {
    color: #036661;
    border-bottom-color: #036661;
    font-weight: 600;
}
.artikel-tab:hover {
    color: #036661;
}
.artikel-list-container {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    min-height: 350px;
    display: flex;
    flex-direction: column;
}
.artikel-list-item {
    color: #047d78;
    text-decoration: none;
    display: block;
    padding: 15px 0;
    border-bottom: 1px solid #e0e0e0;
    transition: all 0.3s;
    font-size: 16px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.artikel-list-item:hover {
    color: #036661;
    text-decoration: underline;
    padding-left: 5px;
}
.artikel-list-item:last-child {
    border-bottom: none;
}
.artikel-col-left, .artikel-col-right {
    display: flex;
    flex-direction: column;
}
.artikelSwiper {
    flex: 1;
}
.mitra-section {
    background: #f5f5f5;
}
@media (min-width: 992px) {
    .mitra-section .container-fluid {
        max-width: 1320px;
        margin: 0 auto;
    }
}
.mitra-slider {
    overflow: hidden;
    position: relative;
}
.mitra-track {
    display: flex;
    animation: slide-mitra 10s linear infinite;
    gap: 80px;
}
.mitra-track:hover {
    animation-play-state: paused;
}
.mitra-item {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}
@keyframes slide-mitra {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}
</style>

<!-- Running Text -->
<div class="running-text-wrapper">
    <div class="running-text-container container-fluid">
        <div class="running-text-label">
            <i class="fas fa-info-circle me-2"></i> Informasi Terkini
        </div>
        <div class="running-text-content">
            <div class="running-text-marquee">
            <?php if(!empty($latestDownloads)): ?>
                <?php 
                $downloadItems = '';
                foreach($latestDownloads as $download): 
                    $downloadItems .= '<a href="'.base_url('unduhan/download/'.$download['id']).'" class="running-text-item">'.esc($download['title']).'</a><span class="running-text-separator">•</span>';
                endforeach;
                // Duplicate untuk seamless loop
                echo $downloadItems . $downloadItems;
                ?>
            <?php else: ?>
                <span class="running-text-item">Belum ada unduhan tersedia</span>
                <span class="running-text-separator">•</span>
                <span class="running-text-item">Belum ada unduhan tersedia</span>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Hero Banner -->
<section class="hero-banner">
    <div class="container-fluid">
        <div class="swiper heroSwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="<?= base_url('assets/images/hero-banner/banner-contoh.jpg'); ?>" alt="E-Asfarm Banner 1">
                </div>
                <div class="swiper-slide">
                    <img src="<?= base_url('assets/images/hero-banner/banner-contoh.jpg'); ?>" alt="E-Asfarm Banner 2">
                </div>
                <div class="swiper-slide">
                    <img src="<?= base_url('assets/images/hero-banner/banner-contoh.jpg'); ?>" alt="E-Asfarm Banner 3">
                </div>
                <div class="swiper-slide">
                    <img src="<?= base_url('assets/images/hero-banner/banner-contoh.jpg'); ?>" alt="E-Asfarm Banner 4">
                </div>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>

<!-- Layanan Kesehatan Section -->
<section class="py-4">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold" style="color: #047d78;">Layanan Kesehatan E-Asfarm</h2>
            </div>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-4 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card service-card h-100 border-0 shadow-sm text-center p-4">
                        <i class="fas fa-user-md mb-3" style="font-size: 3rem; color: #047d78;"></i>
                        <h5 class="fw-semibold" style="color: #047d78;">Konsultasi Pakar</h5>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card service-card h-100 border-0 shadow-sm text-center p-4">
                        <i class="fas fa-newspaper mb-3" style="font-size: 3rem; color: #047d78;"></i>
                        <h5 class="fw-semibold" style="color: #047d78;">Artikel Kesehatan</h5>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card service-card h-100 border-0 shadow-sm text-center p-4">
                        <i class="fas fa-comments mb-3" style="font-size: 3rem; color: #047d78;"></i>
                        <h5 class="fw-semibold" style="color: #047d78;">Tanya Jawab</h5>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <a href="#" class="text-decoration-none">
                    <div class="card service-card h-100 border-0 shadow-sm text-center p-4">
                        <i class="fas fa-download mb-3" style="font-size: 3rem; color: #047d78;"></i>
                        <h5 class="fw-semibold" style="color: #047d78;">Poster Kesehatan</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Artikel Terbaru -->
<section class="py-4" id="ArtikelTerbaru">
    <div class="container-fluid">
        <div class="row g-4 artikel-row">
            <!-- Sisi Kiri: Slider Artikel -->
            <div class="col-lg-6 artikel-col-left">
                <h3 class="fw-bold mb-4" style="color: #047d78; font-weight: 900;">Artikel Terbaru</h3>
                <div class="swiper artikelSwiper">
                    <div class="swiper-wrapper" id="artikel-slider">
                        <!-- Artikel slider akan dimuat via JS -->
                    </div>
                </div>
            </div>
            
            <!-- Sisi Kanan: List Artikel per Kategori -->
            <div class="col-lg-6 artikel-col-right">
                <!-- Tab Kategori -->
                <div class="d-flex  mb-4 border-bottom">
                    <button class="artikel-tab active" data-tab="semua">Semua</button>
                    <button class="artikel-tab" data-tab="farmasi">Farmasi</button>
                    <button class="artikel-tab" data-tab="kebidanan">Kebidanan</button>
                    <button class="artikel-tab" data-tab="gizi">Gizi</button>
                </div>
                
                <!-- List Artikel -->
                <div class="artikel-list-container">
                    <div id="artikel-list">
                        <!-- List artikel akan dimuat via JS -->
                    </div>
                    <a href="#" class="d-block text-center mt-3" style="color: #047d78; font-weight: 600; text-decoration: none;">Artikel Lainnya →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mitra Terkait -->
<section class="py-4 mitra-section">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold" style="color: #047d78;">Mitra Terkait</h2>
            </div>
        </div>
        <div class="mitra-slider">
            <div class="mitra-track">
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/Logo-Diktisaintek2.png'); ?>" alt="Mitra 1" style="max-height: 80px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/Logo-Tut-Wuri.png'); ?>" alt="Mitra 2" style="max-height: 80px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/LOGO1A.png'); ?>" alt="Mitra 3" style="max-height: 80px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/logobantul.png'); ?>" alt="Mitra 4" style="max-height: 80px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/posyandu-logo.png'); ?>" alt="Mitra 5" style="max-height: 80px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/Logo-Diktisaintek2.png'); ?>" alt="Mitra 1" style="max-height: 80px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/Logo-Tut-Wuri.png'); ?>" alt="Mitra 2" style="max-height: 100px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/LOGO1A.png'); ?>" alt="Mitra 3" style="max-height: 100px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/logobantul.png'); ?>" alt="Mitra 4" style="max-height: 100px;">
                </div>
                <div class="mitra-item">
                    <img src="<?= base_url('assets/images/logos/posyandu-logo.png'); ?>" alt="Mitra 5" style="max-height: 120px;">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
let artikelSwiper;
document.addEventListener('DOMContentLoaded', function() {
    // Load artikel untuk slider (5 terbaru)
    fetch('<?= base_url('artikel-kategori'); ?>', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'kategori=semua'
    })
    .then(response => response.json())
    .then(data => {
        const sliderContainer = document.getElementById('artikel-slider');
        if (data && data.length > 0) {
            data.slice(0, 5).forEach(post => {
                const img = post.image ? `<?= base_url('uploads/articles/'); ?>${post.image}` : '<?= base_url('assets/images/blog/default.jpg'); ?>';
                const slug = post.slug || post.id;
                sliderContainer.innerHTML += `
                    <div class="swiper-slide">
                        <div class="artikel-card">
                            <img src="${img}" alt="${post.title}" onerror="this.src='<?= base_url('assets/images/blog/default.jpg'); ?>'">
                            <div class="p-3">
                                <h4 style="color: #047d78; margin-bottom: 10px;">${post.title}</h4>
                                <a href="<?= base_url('artikel/baca/'); ?>${slug}" style="color: #047d78; text-decoration: none; font-weight: 600;">Lebih Detail →</a>
                            </div>
                        </div>
                    </div>
                `;
            });
            artikelSwiper = new Swiper('.artikelSwiper', {
                loop: true,
                autoplay: {delay: 4000, disableOnInteraction: false},
                speed: 800
            });
        }
    });
    
    // Load artikel list
    function loadArtikelList(kategori) {
        fetch('<?= base_url('artikel-kategori'); ?>', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'kategori=' + kategori
        })
        .then(response => response.json())
        .then(data => {
            const listContainer = document.getElementById('artikel-list');
            listContainer.innerHTML = '';
            if (data && data.length > 0) {
                data.slice(0, 5).forEach(post => {
                    const slug = post.slug || post.id;
                    listContainer.innerHTML += `
                        <a href="<?= base_url('artikel/baca/'); ?>${slug}" class="artikel-list-item">
                            ${post.title}
                        </a>
                    `;
                });
            } else {
                listContainer.innerHTML = '<p class="text-muted">Belum ada artikel</p>';
            }
        });
    }
    
    loadArtikelList('semua');
    
    // Tab click handler
    document.querySelectorAll('.artikel-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.artikel-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            loadArtikelList(this.getAttribute('data-tab'));
        });
    });
});

const swiper = new Swiper('.heroSwiper', {
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    speed: 800,
    effect: 'slide',
    grabCursor: true,
    lazy: true,
});
</script>

<?= $this->endSection() ?>