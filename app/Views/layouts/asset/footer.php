<footer class="bg-dark">
    <div class="container-fluid">
        <div class="row py-7 py-md-14 py-lg-11">
            <!-- Kolom 1: Tentang E-Asfarm -->
            <div class="col-lg-3 col-md-6 col-12 mb-7 mb-lg-0">
                <img src="<?= base_url('assets/images/logos/logo.svg'); ?>" alt="E-Asfarm Logo" class="mb-1">
                <h3 class="fs-5 text-white fw-semibold mb-3">TENTANG E-ASFARM</h3>
                <p class="fs-4 text-light mb-4">Platform edukasi kesehatan ibu dan anak yang menyediakan informasi terpercaya dari tenaga ahli farmasi, kebidanan, dan gizi.</p>
                <div class="d-flex flex-column gap-2">
                    <span class="fs-4 text-light"><i class="fas fa-map-marker-alt me-2"></i>Universitas Alma Ata, Yogyakarta</span>
                    <span class="fs-4 text-light"><i class="fas fa-envelope me-2"></i>contact@e-asfarm.id</span>
                    <span class="fs-4 text-light"><i class="fas fa-phone me-2"></i>+62 274 563515</span>
                </div>
            </div>

            <!-- Kolom 2: Navigasi Cepat -->
            <div class="col-lg-2 col-md-6 col-12 mb-7 mb-lg-0">
                <h3 class="fs-5 text-white fw-semibold mb-4">NAVIGASI</h3>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="<?= url_to('beranda'); ?>" class="fs-4 text-light link-primary text-decoration-none">Beranda</a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= url_to('tentang.kami'); ?>" class="fs-4 text-light link-primary text-decoration-none">Tentang Kami</a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= url_to('layanan'); ?>" class="fs-4 text-light link-primary text-decoration-none">Layanan</a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= url_to('kontak'); ?>" class="fs-4 text-light link-primary text-decoration-none">Kontak</a>
                    </li>
                </ul>
            </div>

            <!-- Kolom 3: Edukasi & Bantuan -->
            <div class="col-lg-3 col-md-6 col-12 mb-7 mb-lg-0">
                <h3 class="fs-5 text-white fw-semibold mb-4">EDUKASI & BANTUAN</h3>
                <ul class="list-unstyled">
                    <li class="mb-3">
                        <a href="<?= base_url('artikel/farmasi'); ?>" class="fs-4 text-light link-primary text-decoration-none">Artikel Farmasi</a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('artikel/kebidanan'); ?>" class="fs-4 text-light link-primary text-decoration-none">Artikel Kebidanan</a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('artikel/gizi'); ?>" class="fs-4 text-light link-primary text-decoration-none">Artikel Gizi</a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('tanya-jawab/kehamilan'); ?>" class="fs-4 text-light link-primary text-decoration-none">Tanya Jawab</a>
                    </li>
                    <li class="mb-3">
                        <a href="<?= base_url('unduhan'); ?>" class="fs-4 text-light link-primary text-decoration-none">Unduhan</a>
                    </li>
                </ul>
            </div>

            <!-- Kolom 4: Ikuti Kami -->
            <div class="col-lg-4 col-md-6 col-12 mb-7 mb-lg-0">
                <h3 class="fs-5 text-white fw-semibold mb-4">IKUTI KAMI</h3>
                <p class="fs-4 text-light mb-4">Ikuti media sosial kami untuk mendapatkan tips kesehatan terbaru</p>
                <div class="d-flex gap-3 mb-4">
                    <a href="https://facebook.com/easfarm" class="text-light" data-bs-toggle="tooltip" data-bs-title="Facebook">
                        <i class="fab fa-facebook-f fs-4 p-2 bg-primary rounded"></i>
                    </a>
                    <a href="https://instagram.com/easfarm.official" class="text-light" data-bs-toggle="tooltip" data-bs-title="Instagram">
                        <i class="fab fa-instagram fs-4 p-2 bg-danger rounded"></i>
                    </a>
                    <a href="https://youtube.com/@easfarm" class="text-light" data-bs-toggle="tooltip" data-bs-title="YouTube">
                        <i class="fab fa-youtube fs-4 p-2 bg-danger rounded"></i>
                    </a>
                    <a href="https://wa.me/6281234567890" class="text-light" data-bs-toggle="tooltip" data-bs-title="WhatsApp">
                        <i class="fab fa-whatsapp fs-4 p-2 bg-success rounded"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="border-top border-dark-subtle pt-4">
            <div class="row align-items-center">
                <div class="col-md-6 col-12 mb-3 mb-md-0">
                    <div class="d-flex align-items-center gap-3">
                        <img src="<?= base_url('assets/images/logos/logo-icon-white.svg'); ?>" alt="logo" width="24" height="24">
                        <p class="text-white opacity-75 mb-0 fs-4">© 2024 E-Asfarm. Dikembangkan oleh Universitas Alma Ata</p>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="d-flex justify-content-md-end justify-content-start gap-4">
                        <a href="<?= url_to('kebijakan.privasi'); ?>" class="fs-4 text-light link-primary text-decoration-none">Kebijakan Privasi</a>
                        <a href="<?= url_to('syarat.ketentuan'); ?>" class="fs-4 text-light link-primary text-decoration-none">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>