<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="py-5 py-md-14 py-lg-11 bg-primary-subtle">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="fs-15 fw-bolder mb-4 lh-sm">Platform Kolaborasi Layanan Kesehatan <span class="text-primary">Ibu & Anak</span></h1>
                <p class="fs-5 mb-4 text-muted lh-lg">E-Asfarm menyediakan layanan konsultasi kesehatan online dengan farmasis, bidan, dan ahli gizi. Dapatkan informasi terpercaya seputar kehamilan, persalinan, dan kesehatan anak.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?= url_to('tentang.kami'); ?>" class="btn btn-primary btn-lg px-4">Pelajari Lebih Lanjut</a>
                    <a href="#ArtikelTerbaru" class="btn btn-outline-primary btn-lg px-4">Baca Artikel</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="<?= base_url('assets/images/hero-img/hero1.jpg'); ?>" alt="Kesehatan Ibu dan Anak" class="img-fluid rounded-4 shadow-lg" style="width: 100%; height: 400px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-5 py-md-14 py-lg-11 bg-light">
    <div class="container-fluid">
        <div class="row mb-3 mb-md-5">
            <div class="col-12 text-center">
                <h2 class="fs-8 fs-md-15 fw-bolder mb-3 mb-md-4">E-Asfarm dalam Angka</h2>
                <p class="fs-4 fs-md-5 text-muted px-2">Kepercayaan ribuan keluarga Indonesia untuk kesehatan ibu dan anak</p>
            </div>
        </div>
        <div class="row g-3 g-md-4">
            <div class="col-6 col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="bg-primary-subtle rounded-4 p-3 p-md-4 mb-2 mb-md-3">
                        <i class="fas fa-users fs-2 fs-md-1 text-primary mb-2 mb-md-3"></i>
                        <h3 class="fs-7 fs-md-12 fw-bolder text-primary mb-0">1,250+</h3>
                    </div>
                    <h5 class="fs-5 fs-md-4 fw-semibold mb-1 mb-md-2">Ibu Terlayani</h5>
                    <p class="text-muted mb-0 fs-3 fs-md-4">Keluarga yang telah mempercayakan kesehatan mereka</p>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="bg-success-subtle rounded-4 p-3 p-md-4 mb-2 mb-md-3">
                        <i class="fas fa-file-medical fs-2 fs-md-1 text-success mb-2 mb-md-3"></i>
                        <h3 class="fs-7 fs-md-12 fw-bolder text-success mb-0"><?= $totalArtikel ?? '0'; ?>+</h3>
                    </div>
                    <h5 class="fs-5 fs-md-4 fw-semibold mb-1 mb-md-2">Artikel Kesehatan</h5>
                    <p class="text-muted mb-0 fs-3 fs-md-4">Informasi medis terpercaya dan terupdate</p>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="bg-warning-subtle rounded-4 p-3 p-md-4 mb-2 mb-md-3">
                        <i class="fas fa-clock fs-2 fs-md-1 text-warning mb-2 mb-md-3"></i>
                        <h3 class="fs-7 fs-md-12 fw-bolder text-warning mb-0">24/7</h3>
                    </div>
                    <h5 class="fs-5 fs-md-4 fw-semibold mb-1 mb-md-2">Layanan Konsultasi</h5>
                    <p class="text-muted mb-0 fs-3 fs-md-4">Akses informasi kesehatan kapan saja</p>
                </div>
            </div>
            <div class="col-6 col-md-6 col-lg-3">
                <div class="text-center">
                    <div class="bg-info-subtle rounded-4 p-3 p-md-4 mb-2 mb-md-3">
                        <i class="fas fa-user-md fs-2 fs-md-1 text-info mb-2 mb-md-3"></i>
                        <h3 class="fs-7 fs-md-12 fw-bolder text-info mb-0">3</h3>
                    </div>
                    <h5 class="fs-5 fs-md-4 fw-semibold mb-1 mb-md-2">Bidang Keahlian</h5>
                    <p class="text-muted mb-0 fs-3 fs-md-4">Farmasi, Kebidanan, dan Ahli Gizi</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Artikel Terbaru -->
<section class="py-5 py-md-14 py-lg-11 bg-light-gray" id="ArtikelTerbaru">
    <div class="container-fluid">
        <div class="row mb-3 mb-md-5">
            <div class="col-12 text-center">
                <h2 class="fs-8 fs-md-15 fw-bolder mb-3 mb-md-4">Artikel Kesehatan Terbaru</h2>
                <p class="fs-4 fs-md-5 text-muted px-2">Informasi terkini seputar kesehatan ibu dan anak dari para ahli</p>
            </div>
        </div>
        
        <!-- Filter Kategori -->
        <div class="row mb-3 mb-md-4">
            <div class="col-12 text-center">
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <button type="button" class="btn btn-outline-primary btn-sm active" data-kategori="semua">Semua</button>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-kategori="farmasi">Farmasi</button>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-kategori="bidan">Kebidanan</button>
                    <button type="button" class="btn btn-outline-primary btn-sm" data-kategori="gizi">Gizi</button>
                </div>
            </div>
        </div>
        
        <!-- Loading Spinner -->
        <div class="row" id="loading-spinner" style="display: none;">
            <div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        
        <!-- Container Artikel -->
        <div class="row g-4" id="artikel-container">
            <!-- Artikel akan dimuat via AJAX -->
        </div>
        </div>
    </div>
</section>

<!-- Trust Indicators -->
<section class="py-5 py-md-14 py-lg-11 bg-dark">
    <div class="container-fluid">
        <div class="row mb-3 mb-md-5">
            <div class="col-12 text-center">
                <h2 class="fs-8 fs-md-15 fw-bolder mb-3 mb-md-4 text-white">Dipercaya & Didukung Oleh</h2>
                <p class="fs-4 fs-md-5 text-white px-2">Platform kesehatan yang bermitra dengan institusi terpercaya</p>
            </div>
        </div>
        
        <!-- Partner Logos Row -->
        <div class="row align-items-center justify-content-center g-3 g-md-4">
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="text-center p-2 p-md-3">
                    <img src="<?= base_url('assets/images/logos/FARMASI Putih.png'); ?>" alt="Universitas Alma Ata" class="img-fluid opacity-75 hover-opacity-100" style="max-height: 60px; max-height: 80px; transition: opacity 0.3s ease;">
                    <p class="fs-4 fs-md-3 text-muted mt-2 mb-0">Universitas Alma Ata</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="text-center p-2 p-md-3">
                    <img src="<?= base_url('assets/images/logos/Gizi Putih.png'); ?>" alt="Partner Kesehatan" class="img-fluid opacity-75 hover-opacity-100" style="max-height: 60px; max-height: 80px; transition: opacity 0.3s ease;">
                    <p class="fs-4 fs-md-3 text-muted mt-2 mb-0">Partner Kesehatan</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="text-center p-2 p-md-3">
                    <img src="<?= base_url('assets/images/logos/KEBIDANAN PUTIH.png'); ?>" alt="Institusi Medis" class="img-fluid opacity-75 hover-opacity-100" style="max-height: 60px; max-height: 80px; transition: opacity 0.3s ease;">
                    <p class="fs-4 fs-md-3 text-muted mt-2 mb-0">Institusi Medis</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 py-md-14 py-lg-11 bg-light">
    <div class="container-fluid">
        <div class="row mb-3 mb-md-5">
            <div class="col-12 text-center">
                <h2 class="fs-8 fs-md-15 fw-bolder mb-3 mb-md-4">Pertanyaan yang Sering Diajukan</h2>
                <p class="fs-4 fs-md-5 text-muted px-2">Temukan jawaban untuk pertanyaan umum seputar kesehatan ibu dan anak</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apa itu E-Asfarm?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                E-Asfarm adalah platform digital yang menyediakan informasi kesehatan terpercaya dalam bidang farmasi, kebidanan, dan gizi untuk membantu keluarga Indonesia hidup lebih sehat.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah layanan E-Asfarm gratis?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, semua layanan E-Asfarm dapat diakses secara gratis. Kami berkomitmen menyediakan informasi kesehatan berkualitas untuk semua kalangan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Siapa saja yang bisa menggunakan E-Asfarm?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                E-Asfarm dapat digunakan oleh siapa saja, terutama ibu hamil, ibu menyusui, keluarga dengan anak, dan masyarakat umum yang ingin mendapatkan informasi kesehatan terpercaya.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah informasi di E-Asfarm dapat dipercaya?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, semua artikel dan informasi di E-Asfarm telah melalui proses review dan verifikasi oleh tim ahli kami untuk memastikan akurasi dan keandalan informasi kesehatan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Apakah E-Asfarm menggantikan konsultasi dokter?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Tidak, E-Asfarm hanya menyediakan informasi edukasi kesehatan. Untuk diagnosis dan pengobatan, tetap konsultasikan dengan dokter atau tenaga kesehatan profesional.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                Apa saja yang bisa saya temukan di E-Asfarm?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Anda dapat menemukan artikel kesehatan, panduan gizi, informasi obat-obatan, tips kehamilan dan menyusui, serta berbagai materi edukasi kesehatan lainnya.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                Bagaimana cara mencari informasi tertentu?
                            </button>
                        </h2>
                        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Gunakan fitur pencarian di bagian atas halaman atau jelajahi kategori artikel seperti Farmasi, Kebidanan, dan Gizi untuk menemukan informasi yang Anda butuhkan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                                Bagaimana cara menjadi kontributor artikel?
                            </button>
                        </h2>
                        <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Daftar akun terlebih dahulu, kemudian klik "Buat Artikel" di menu navigasi. Anda dapat menulis dan mengirimkan artikel sesuai bidang keahlian Anda.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 shadow-sm mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                                Apakah artikel yang saya tulis langsung dipublikasi?
                            </button>
                        </h2>
                        <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Tidak, artikel akan melalui proses review terlebih dahulu oleh tim editor kami untuk memastikan kualitas dan akurasi informasi sebelum dipublikasikan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-kategori]');
    const artikelContainer = document.getElementById('artikel-container');
    const loadingSpinner = document.getElementById('loading-spinner');
    
    // Function untuk escape HTML
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Function untuk load artikel
    function loadArtikel(kategori) {
        // Show loading
        loadingSpinner.style.display = 'block';
        artikelContainer.style.display = 'none';
        
        // Fetch articles
        fetch('<?= base_url('artikel-kategori'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'kategori=' + encodeURIComponent(kategori)
        })
        .then(response => response.json())
        .then(data => {
            // Hide loading
            loadingSpinner.style.display = 'none';
            artikelContainer.style.display = 'flex';
            
            // Clear container
            artikelContainer.innerHTML = '';
            
            if (data && data.length > 0) {
                data.forEach(post => {
                    // Pastikan post memiliki properti yang diperlukan dan escape
                    const title = escapeHtml(post.title || 'Judul tidak tersedia');
                    const category = escapeHtml(post.category || 'kesehatan');
                    const content = post.content || post.body || '';
                    const createdAt = post.created_at || new Date().toISOString();
                    const id = post.id || '';
                    const slug = post.slug || '';
                    const image = post.image || '';
                    
                    const imageHtml = image ? 
                        `<img src="<?= base_url('uploads/articles/'); ?>${escapeHtml(image)}" class="card-img-top" alt="${title}" style="height: 200px; object-fit: cover;" onerror="this.onerror=null; this.src='<?= base_url('assets/images/blog/'); ?>${escapeHtml(image)}'">` : 
                        `<div class="card-img-top d-flex align-items-center justify-content-center" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-file-medical text-white" style="font-size: 3rem; opacity: 0.7;"></i>
                        </div>`;
                    
                    const kategoriLabel = category.charAt(0).toUpperCase() + category.slice(1);
                    const excerpt = escapeHtml(content.replace(/<[^>]*>/g, '').substring(0, 120)) + '...';
                    const tanggal = new Date(createdAt).toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    });
                    
                    const articleHtml = `
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                ${imageHtml}
                                <div class="card-body d-flex flex-column">
                                    <span class="badge bg-primary mb-2 align-self-start">${kategoriLabel}</span>
                                    <h5 class="card-title fw-semibold">${title}</h5>
                                    <p class="card-text text-muted flex-grow-1" style="text-align: justify;">${excerpt}</p>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <small class="text-muted">${tanggal}</small>
                                        <a href="<?= base_url('artikel/baca/'); ?>${slug || id}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    artikelContainer.insertAdjacentHTML('beforeend', articleHtml);
                });
            } else {
                artikelContainer.innerHTML = '<div class="col-12 text-center"><p class="text-muted">Belum ada artikel tersedia untuk kategori ini.</p></div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loadingSpinner.style.display = 'none';
            artikelContainer.style.display = 'flex';
            artikelContainer.innerHTML = '<div class="col-12 text-center"><p class="text-danger">Terjadi kesalahan saat memuat artikel.</p></div>';
        });
    }
    
    // Load artikel default (semua) saat halaman pertama kali dibuka
    setTimeout(function() {
        loadArtikel('semua');
    }, 100);
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const kategori = this.getAttribute('data-kategori');
            
            // Update active button
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Load artikel sesuai kategori
            loadArtikel(kategori);
        });
    });
});
</script>

<?= $this->endSection() ?>