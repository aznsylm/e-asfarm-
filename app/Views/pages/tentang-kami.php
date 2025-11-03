<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
.meet-our-team img {
  width: 100%;
  height: 300px;
  object-fit: cover;
}
@media (max-width: 768px) {
  .owl-carousel .meet-our-team img {
    width: 150px;
    height: 150px;
    margin: 0 auto;
    display: block;
  }
}
</style>

<div class="main-wrapper overflow-hidden">

  <!-- banner Start -->
  <section class="pt-lg-11 pt-md-5 pt-7 pb-7 pb-md-5 pb-md-12 bg-light-gray overflow-hidden">
    <div class="container-fluid">
      <div class="row mb-lg-7">
        <div class="col-lg-6 mb-7 mb-md-5 mb-lg-0">
          <h2 class="fs-15 fs-md-15 fw-normal text-lg-start text-center mb-3 mb-md-4">
            <span class="fw-bolder">Kolaborasi Layanan Kesehatan</span> Alma Ata dengan E-Asfarm
          </h2>
          <div class="d-flex justify-content-lg-start justify-content-center gap-3">
            <a class="btn btn-primary" href="<?= url_to('beranda'); ?>#ArtikelTerbaru">
              Baca Artikel Kesehatan
            </a>
            <a class="btn btn-outline-primary" href="<?= base_url('kontak'); ?>">
              Konsultasi Sekarang
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <p class="fs-4 fs-md-5 mb-0 text-muted lh-lg" style="text-align: justify;">
            E-Asfarm adalah platform kesehatan digital yang menghubungkan Anda dengan tenaga ahli dari Universitas Alma Ata. Kami menyediakan layanan konsultasi gratis dengan Farmasis, Bidan, dan Ahli Gizi untuk mendampingi perjalanan kesehatan Anda dari persiapan kehamilan hingga pasca-persalinan. Dapatkan informasi medis terpercaya, panduan praktis, dan solusi kesehatan yang tepat melalui website yang mudah diakses kapan saja.
          </p>
        </div>
      </div>
    </div>
  </section>
  <!-- Visi Misi -->
  <section class="py-7 py-md-12 bg-white">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="card h-100 border-0 bg-primary-subtle p-2 p-md-6">
            <div class="card-body p-2 p-md-3">
              <h3 class="fs-6 fs-md-5 fw-bold mb-3 mb-md-4 text-primary">Visi Kami</h3>
              <p class="fs-4 fs-md-5 text-dark mb-0 lh-lg" style="text-align: justify;">
                Menjadi platform layanan kesehatan digital terdepan yang memberikan akses mudah dan berkualitas untuk kesehatan ibu dan anak melalui kolaborasi interprofesional tenaga kesehatan.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card h-100 border-0 bg-success-subtle p-2 p-md-6">
            <div class="card-body p-2 p-md-3">
              <h3 class="fs-6 fs-md-5 fw-bold mb-3 mb-md-4 text-success">Misi Kami</h3>
              <ul class="fs-4 fs-md-5 text-dark mb-0 lh-lg" style="text-align: justify;">
                <li class="mb-2">1. Menyediakan informasi kesehatan yang akurat dan terpercaya</li>
                <li class="mb-2">2. Memfasilitasi konsultasi kesehatan dengan tenaga ahli</li>
                <li class="mb-2">3. Mendukung kesehatan ibu dari persiapan hingga pasca-persalinan</li>
                <li class="mb-0">4. Meningkatkan literasi kesehatan masyarakat</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Team -->
  <section class="bg-white py-7 py-md-14 py-lg-11">
    <div class="container-fluid">
      <div class="row mb-5 mb-md-7 text-center">
        <div class="col-12">
          <h2 class="text-dark fs-8 fs-md-15 fw-bolder mb-3 lh-sm">
            Kenali Tim Kami
          </h2>
          <p class="fs-4 fs-md-5 text-muted mx-auto" style="max-width: 700px;">
            Kolaborasi profesional, layanan kesehatan modern. E-Asfarm: Solusi cerdas untuk ibu dan anak.
          </p>
        </div>
      </div>
      <div class="row justify-content-center mt-5">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm hover-shadow transition">
            <div class="card-body text-center p-5">
              <div class="mb-4">
                <img src="<?= base_url('assets/images/frontend-pages/user.png'); ?>" alt="Apoteker" class="rounded-circle" style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fa;">
              </div>
              <h4 class="fs-5 fw-bold mb-2">apt. Nurul Kusumawardani, M. Farm</h4>
              <p class="fs-4 text-primary fw-semibold mb-0">Apoteker</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm hover-shadow transition">
            <div class="card-body text-center p-5">
              <div class="mb-4">
                <img src="<?= base_url('assets/images/frontend-pages/dhina-puspasari-wijaya.png'); ?>" alt="Ahli Gizi" class="rounded-circle" style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fa;">
              </div>
              <h4 class="fs-5 fw-bold mb-2">Dhina Puspasari Wijaya, S.Kom., M.Kom.</h4>
              <p class="fs-4 text-primary fw-semibold mb-0">Developer</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm hover-shadow transition">
            <div class="card-body text-center p-5">
              <div class="mb-4">
                <img src="<?= base_url('assets/images/frontend-pages/aizan-syalim.png'); ?>" alt="Bidan" class="rounded-circle" style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #f8f9fa;">
              </div>
              <h4 class="fs-5 fw-bold mb-2">Aizan Syalim</h4>
              <p class="fs-4 text-primary fw-semibold mb-0">Developer</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tenaga Ahli -->
  <section class="bg-light py-7 py-md-14 py-lg-11">
    <div class="container-fluid">
      <div class="row mb-4 mb-md-7">
        <div class="col-lg-7">
          <h2 class="text-dark fs-8 fs-md-15 fw-bolder mb-3 mb-lg-0 lh-sm">
            Tenaga Ahli Kami
          </h2>
        </div>
        <div class="col-lg-5">
          <p class="mb-0 fs-4 fs-md-5 text-muted" style="text-align: justify;">
            Konsultasi langsung dengan tenaga ahli profesional melalui WhatsApp.
          </p>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
              <img src="<?= base_url('assets/images/frontend-pages/user.png'); ?>" alt="Bidan" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
              <h4 class="fs-5 fw-bold mb-2">Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb</h4>
              <p class="fs-4 text-primary mb-2">Bidan</p>
              <p class="fs-4 text-muted mb-3">
                <i class="ti ti-phone"></i> 088233780554
              </p>
              <a href="https://wa.me/62088233780554" target="_blank" class="btn btn-success btn-sm">
                <i class="ti ti-brand-whatsapp"></i> Konsultasi
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
              <img src="<?= base_url('assets/images/frontend-pages/user.png'); ?>" alt="Bidan" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
              <h4 class="fs-5 fw-bold mb-2">Adelia Kholila Putri, S.Keb</h4>
              <p class="fs-4 text-primary mb-2">Bidan</p>
              <p class="fs-4 text-muted mb-3">
                <i class="ti ti-phone"></i> 081297161149
              </p>
              <a href="https://wa.me/6281297161149" target="_blank" class="btn btn-success btn-sm">
                <i class="ti ti-brand-whatsapp"></i> Konsultasi
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
              <img src="<?= base_url('assets/images/frontend-pages/user.png'); ?>" alt="Ahli Gizi" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
              <h4 class="fs-5 fw-bold mb-2">Wiji Indah Lestari, S.Gz., M.K.M</h4>
              <p class="fs-4 text-primary mb-2">Ahli Gizi</p>
              <p class="fs-4 text-muted mb-3">
                <i class="ti ti-phone"></i> 082293679312
              </p>
              <a href="https://wa.me/6282293679312" target="_blank" class="btn btn-success btn-sm">
                <i class="ti ti-brand-whatsapp"></i> Konsultasi
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100 border-0 shadow-sm">
            <div class="card-body text-center p-4">
              <img src="<?= base_url('assets/images/frontend-pages/user.png'); ?>" alt="Apoteker" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
              <h4 class="fs-5 fw-bold mb-2">apt. Nurul Kusumawardani, M. Farm</h4>
              <p class="fs-4 text-primary mb-2">Apoteker</p>
              <p class="fs-4 text-muted mb-3">
                <i class="ti ti-phone"></i> 081902808231
              </p>
              <a href="https://wa.me/6281902808231" target="_blank" class="btn btn-success btn-sm">
                <i class="ti ti-brand-whatsapp"></i> Konsultasi
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<?= $this->endSection() ?>