<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
.lightbox{display:none;position:fixed;z-index:9999;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.9);}
.lightbox:target{display:flex;align-items:center;justify-content:center;}
.lightbox img{max-width:90%;max-height:90%;border-radius:8px;}
.lightbox-close{position:absolute;top:20px;right:30px;color:#fff;font-size:40px;text-decoration:none;}
.img-clickable{cursor:pointer;}
.info-tab{border:2px solid #047d78;background:#fff;color:#047d78;padding:12px 20px;border-radius:8px;cursor:pointer;transition:all .3s;text-align:left;width:100%;margin-bottom:10px;}
.info-tab:hover{background:#f5f5f5;}
.info-tab.active{background:#047d78;color:#fff;}
.info-content{display:none;}
.info-content.active{display:block;}
@media(max-width:991px){.info-tab{padding:10px 15px;font-size:14px;}}
.peneliti-slider{overflow:hidden;position:relative;}
.peneliti-track{display:flex;animation:slide-peneliti 20s linear infinite;gap:30px;}
.peneliti-track:hover{animation-play-state:paused;}
.peneliti-item{flex-shrink:0;}
.peneliti-item img{height:280px;width:auto;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.1);cursor:pointer;transition:all .3s;}
.peneliti-item img:hover{transform:scale(1.05);box-shadow:0 4px 12px rgba(0,0,0,0.2);}
@keyframes slide-peneliti{0%{transform:translateX(0);}100%{transform:translateX(-50%);}}
@media(max-width:767px){.peneliti-track{animation-duration:12s;}}
</style>

<style>
.team-card {
  transition: all 0.3s;
}
.team-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 16px rgba(0,0,0,0.15);
}
</style>

<!-- Informasi E-Asfarm -->
<section class="py-4">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h3 class="fw-bold text-teal">Informasi E-Asfarm</h3>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-lg-3">
        <button class="info-tab active" onclick="showInfo('tentang')">Tentang Kami</button>
        <button class="info-tab" onclick="showInfo('latar')">Latar Belakang</button>
        <button class="info-tab" onclick="showInfo('sejarah')">Sejarah E-Asfarm</button>
        <button class="info-tab" onclick="showInfo('filosofi')">Filosofi Solusi</button>
        <button class="info-tab" onclick="showInfo('fokus')">Fokus Kerja Kami</button>
      </div>
      <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-8">
          <div class="card-body p-4">
            <div id="tentang" class="info-content active">
              <h4 class="fw-bold mb-3 text-teal">Tentang E-Asfarm</h4>
              <p class="text-gray text-justify">E-Asfarm (Elektronik Asuhan Kefarmasian) adalah platform digital hasil hilirisasi riset yang dirancang untuk memutus rantai masalah kesehatan ibu dan anak melalui solusi elektronik dan pendampingan kefarmasian yang rasional. E-Asfarm menggabungkan teknologi digital untuk mengatasi disparitas akses layanan kesehatan dengan prinsip asuhan kefarmasian yang memastikan penggunaan obat dan praktik swamedikasi yang aman. Platform ini lahir dari penelitian yang dipimpin oleh apt. Nurul Kusumawardani, M.Farm, dan berfokus pada kolaborasi interprofesional, integrasi kearifan lokal, serta pemberdayaan kader kesehatan desa sebagai garda terdepan pendampingan ibu dan anak.</p>
            </div>
            <div id="latar" class="info-content">
              <h4 class="fw-bold mb-3 text-teal">Latar Belakang</h4>
              <p class="text-gray text-justify">E-Asfarm hadir sebagai sebuah inisiatif untuk memutus rantai masalah kesehatan ibu dan anak yang masih sering terjadi di berbagai wilayah. Permasalahan ini bermula sejak masa remaja putri, kemudian berlanjut saat menjadi ibu hamil, ibu menyusui, hingga berdampak pada anak balita. Remaja putri rentan mengalami anemia, ibu hamil memiliki risiko tinggi mengalami anemia dan hipertensi, ibu menyusui menghadapi tantangan pemenuhan gizi serta swamedikasi, dan akhirnya kondisi tersebut dapat berujung pada stunting pada anak.</p>
              <p class="text-gray text-justify">Rangkaian persoalan ini semakin kompleks karena adanya kesenjangan akses layanan kesehatan serta praktik swamedikasi yang kurang rasional di masyarakat.</p>
            </div>
            <div id="sejarah" class="info-content">
              <h4 class="fw-bold mb-3 text-teal">Sejarah E-Asfarm</h4>
              <p class="text-gray text-justify">E-Asfarm merupakan hasil hilirisasi riset yang dipimpin oleh apt. Nurul Kusumawardani, M.Farm. Platform ini dikembangkan berdasarkan temuan penting yang juga diulas dalam buku <em>"Strategi Konseling Kefarmasian Ibu Hamil: Tatap Muka dan Digital."</em></p>
              <p class="text-gray text-justify">Melalui riset tersebut, lahir kebutuhan untuk menghadirkan solusi berkelanjutan yang mampu menjembatani layanan profesional dengan kondisi nyata di lapangan.</p>
            </div>
            <div id="filosofi" class="info-content">
              <h4 class="fw-bold mb-3 text-teal">Filosofi Solusi</h4>
              <p class="text-gray text-justify">Permasalahan kesehatan ibu dan anak adalah persoalan multifaktor, sehingga tidak dapat diselesaikan oleh satu pihak saja. Karena itulah E-Asfarm menggabungkan dua pendekatan utama:</p>
              <div class="mb-3">
                <h5 class="fw-bold mt-3 mb-2 text-teal">1. E (Elektronik)</h5>
                <p class="text-gray text-justify">Solusi digital digunakan untuk menjawab tantangan disparitas akses, sehingga informasi dan layanan dapat menjangkau masyarakat lebih luas.</p>
              </div>
              <div class="mb-3">
                <h5 class="fw-bold mb-2 text-teal">2. Asfarm (Asuhan Kefarmasian)</h5>
                <p class="text-gray text-justify">Pendekatan asuhan kefarmasian menjadi dasar untuk memastikan bahwa swamedikasi dilakukan secara rasional, aman, dan sesuai rekomendasi tenaga kesehatan.</p>
              </div>
              <p class="text-gray text-justify">Dengan memadukan dua pilar ini, E-Asfarm menekankan pentingnya kolaborasi interprofesional, di mana berbagai tenaga kesehatan bekerja bersama untuk memberikan dampak terbaik bagi ibu dan anak.</p>
            </div>
            <div id="fokus" class="info-content">
              <h4 class="fw-bold mb-3 text-teal">Fokus Kerja Kami</h4>
              <div class="mb-3">
                <h5 class="fw-bold mt-3 mb-2 text-teal">Integrasi Kearifan Lokal</h5>
                <p class="text-gray text-justify">E-Asfarm menggabungkan pengetahuan berbasis budaya lokal (etnomedisin) dengan pengobatan modern berbasis bukti ilmiah. Tujuannya adalah menghadirkan layanan yang relevan, diterima masyarakat, namun tetap aman dan teruji.</p>
              </div>
              <div class="mb-3">
                <h5 class="fw-bold mb-2 text-teal">Pemberdayaan Garda Depan</h5>
                <p class="text-gray text-justify">Kami memberdayakan Kader Kesehatan Desa sebagai ujung tombak penghubung antara layanan kesehatan dan masyarakat. Kader bertugas dalam pemantauan, edukasi, hingga menjadi jembatan bagi ibu hamil dan menyusui untuk mendapatkan pendampingan kesehatan yang tepat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Vision & Mission -->
<section class="py-4">
  <div class="container-fluid">
    <div class="row g-4">
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm rounded-8">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-3 text-teal">Visi Kami</h3>
            <p class="mb-0 text-gray">Menjadi platform layanan kesehatan digital terdepan yang memberikan akses mudah dan berkualitas untuk monitoring kesehatan ibu dan anak melalui kolaborasi interprofesional tenaga kesehatan.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm rounded-8">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-3 text-teal">Misi Kami</h3>
            <ol class="mb-0 text-gray">
              <li class="mb-2">Menyediakan informasi kesehatan yang akurat dan terpercaya</li>
              <li class="mb-2">Memfasilitasi konsultasi kesehatan dengan tenaga ahli</li>
              <li class="mb-2">Mendukung kesehatan ibu dari persiapan hingga pasca-persalinan</li>
              <li class="mb-0">Meningkatkan literasi kesehatan masyarakat</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Team -->
<section class="py-4">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h2 class="fw-bold text-teal">Tim Kami</h2>
      </div>
    </div>
    <div class="row justify-content-center g-4">
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm team-card" style="border-radius: 8px;">
          <div class="card-body text-center p-4">
            <a href="#img1"><img src="<?= base_url('assets/images/frontend-pages/apt.Nurul Kusumawardani.jpg'); ?>" alt="Apoteker" class="rounded-circle mb-3 img-clickable" style="width: 150px; height: 150px; object-fit: cover;"></a>
            <h4 class="fw-bold mb-2" style="color: #047d78;">apt. Nurul Kusumawardani, M. Farm</h4>
            <p class="mb-0" style="color: #047d78;">Ketua Dosen Peneliti</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm team-card" style="border-radius: 8px;">
          <div class="card-body text-center p-4">
            <a href="#img2"><img src="<?= base_url('assets/images/frontend-pages/dhina-puspasari-wijaya.png'); ?>" alt="Developer" class="rounded-circle mb-3 img-clickable" style="width: 150px; height: 150px; object-fit: cover; object-position: top;"></a>
            <h4 class="fw-bold mb-2" style="color: #047d78;">Dhina Puspasari Wijaya, S.Kom., M.Kom.</h4>
            <p class="mb-0" style="color: #047d78;">Web Developer</p>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm team-card" style="border-radius: 8px;">
          <div class="card-body text-center p-4">
            <a href="#img3"><img src="<?= base_url('assets/images/frontend-pages/aizan-syalim.png'); ?>" alt="Developer" class="rounded-circle mb-3 img-clickable" style="width: 150px; height: 150px; object-fit: cover; object-position: top;"></a>
            <h4 class="fw-bold mb-2" style="color: #047d78;">Aizan Syalim</h4>
            <p class="mb-0" style="color: #047d78;">Web Developer</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Tenaga Ahli -->
<section class="py-4">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h3  class="fw-bold mb-3" style="color: #047d78;">Tenaga Ahli Kami</h3>
      </div>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 8px;">
          <div class="card-body text-center p-3">
            <a href="#img4"><img src="<?= base_url('assets/images/frontend-pages/Nurul.webp'); ?>" alt="Apoteker" class="rounded-circle mb-2 img-clickable" style="width: 150px; height: 150px; object-fit: cover;"></a>
            <h6 class="fw-bold mb-1" style="color: #047d78;">apt. Nurul Kusumawardani, M. Farm</h6>
            <p class="mb-1 small" style="color: #047d78;">Apoteker Klinis</p>
            <p class="mb-2 text-muted small"><i class="ti ti-phone"></i> 081902808231</p>
            <a href="https://wa.me/6281902808231" target="_blank" class="btn btn-sm" style="background-color: #047d78; color: white;">
              <i class="ti ti-brand-whatsapp"></i> Konsultasi
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 8px;">
          <div class="card-body text-center p-3">
            <a href="#img5"><img src="<?= base_url('assets/images/frontend-pages/Emelda.webp'); ?>" alt="Tenaga Ahli" class="rounded-circle mb-2 img-clickable" style="width: 150px; height: 150px; object-fit: cover;"></a>
            <h6 class="fw-bold mb-1" style="color: #047d78;">apt. Emelda, M.Farm</h6>
            <p class="mb-1 small" style="color: #047d78;">Apoteker Fokus Pada Bidang Etnomedisin</p>
            <p class="mb-2 text-muted small"><i class="ti ti-phone"></i> 08xxxxxxxxxx</p>
            <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="btn btn-sm" style="background-color: #047d78; color: white;">
              <i class="ti ti-brand-whatsapp"></i> Konsultasi
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 8px;">
          <div class="card-body text-center p-3">
            <a href="#img6"><img src="<?= base_url('assets/images/frontend-pages/Eliza.webp'); ?>" alt="Tenaga Ahli" class="rounded-circle mb-2 img-clickable" style="width: 150px; height: 150px; object-fit: cover;"></a>
            <h6 class="fw-bold mb-1" style="color: #047d78;">apt. Eliza Dwinta, M.Pharm.,SCI</h6>
            <p class="mb-1 small" style="color: #047d78;">Apoteker Fokus Pada Kesehatan Mental</p>
            <p class="mb-2 text-muted small"><i class="ti ti-phone"></i> 08xxxxxxxxxx</p>
            <a href="https://wa.me/628xxxxxxxxxx" target="_blank" class="btn btn-sm" style="background-color: #047d78; color: white;">
              <i class="ti ti-brand-whatsapp"></i> Konsultasi
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 8px;">
          <div class="card-body text-center p-3">
            <a href="#img7"><img src="<?= base_url('assets/images/frontend-pages/Silvia.webp'); ?>" alt="Bidan" class="rounded-circle mb-2 img-clickable" style="width: 150px; height: 150px; object-fit: cover;"></a>
            <h6 class="fw-bold mb-1" style="color: #047d78;">Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb</h6>
            <p class="mb-1 small" style="color: #047d78;">Bidan</p>
            <p class="mb-2 text-muted small"><i class="ti ti-phone"></i> 088233780554</p>
            <a href="https://wa.me/62088233780554" target="_blank" class="btn btn-sm" style="background-color: #047d78; color: white;">
              <i class="ti ti-brand-whatsapp"></i> Konsultasi
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 8px;">
          <div class="card-body text-center p-3">
            <a href="#img8"><img src="<?= base_url('assets/images/frontend-pages/Adelia.webp'); ?>" alt="Bidan" class="rounded-circle mb-2 img-clickable" style="width: 150px; height: 150px; object-fit: cover;"></a>
            <h6 class="fw-bold mb-1" style="color: #047d78;">Adelia Kholila Putri, S.Keb</h6>
            <p class="mb-1 small" style="color: #047d78;">Bidan</p>
            <p class="mb-2 text-muted small"><i class="ti ti-phone"></i> 081297161149</p>
            <a href="https://wa.me/6281297161149" target="_blank" class="btn btn-sm" style="background-color: #047d78; color: white;">
              <i class="ti ti-brand-whatsapp"></i> Konsultasi
            </a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 8px;">
          <div class="card-body text-center p-3">
            <a href="#img9"><img src="<?= base_url('assets/images/frontend-pages/Indah.webp'); ?>" alt="Ahli Gizi" class="rounded-circle mb-2 img-clickable" style="width: 150px; height: 150px; object-fit: cover;"></a>
            <h6 class="fw-bold mb-1" style="color: #047d78;">Wiji Indah Lestari, S.Gz., M.K.M</h6>
            <p class="mb-1 small" style="color: #047d78;">Ahli Gizi</p>
            <p class="mb-2 text-muted small"><i class="ti ti-phone"></i> 082293679312</p>
            <a href="https://wa.me/6282293679312" target="_blank" class="btn btn-sm" style="background-color: #047d78; color: white;">
              <i class="ti ti-brand-whatsapp"></i> Konsultasi
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Anggota Peneliti -->
<section class="py-4">
  <div class="container-fluid">
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h3 class="fw-bold" style="color: #047d78;">Anggota Peneliti</h3>
      </div>
    </div>
    <div class="peneliti-slider">
      <div class="peneliti-track">
        <div class="peneliti-item">
          <a href="#img10"><img src="<?= base_url('assets/images/frontend-pages/Affrent.webp'); ?>" alt="Peneliti 1"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img11"><img src="<?= base_url('assets/images/frontend-pages/Ainiyah.webp'); ?>" alt="Peneliti 2"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img12"><img src="<?= base_url('assets/images/frontend-pages/Aldianus.webp'); ?>" alt="Peneliti 3"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img13"><img src="<?= base_url('assets/images/frontend-pages/Almas.webp'); ?>" alt="Peneliti 4"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img14"><img src="<?= base_url('assets/images/frontend-pages/Deni.webp'); ?>" alt="Peneliti 5"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img15"><img src="<?= base_url('assets/images/frontend-pages/Nadia.webp'); ?>" alt="Peneliti 6"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img10"><img src="<?= base_url('assets/images/frontend-pages/Affrent.webp'); ?>" alt="Peneliti 1"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img11"><img src="<?= base_url('assets/images/frontend-pages/Ainiyah.webp'); ?>" alt="Peneliti 2"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img12"><img src="<?= base_url('assets/images/frontend-pages/Aldianus.webp'); ?>" alt="Peneliti 3"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img13"><img src="<?= base_url('assets/images/frontend-pages/Almas.webp'); ?>" alt="Peneliti 4"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img14"><img src="<?= base_url('assets/images/frontend-pages/Deni.webp'); ?>" alt="Peneliti 5"></a>
        </div>
        <div class="peneliti-item">
          <a href="#img15"><img src="<?= base_url('assets/images/frontend-pages/Nadia.webp'); ?>" alt="Peneliti 6"></a>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function showInfo(id){
  document.querySelectorAll('.info-content').forEach(el=>el.classList.remove('active'));
  document.querySelectorAll('.info-tab').forEach(el=>el.classList.remove('active'));
  document.getElementById(id).classList.add('active');
  event.target.classList.add('active');
}
</script>

<div id="img1" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/apt.Nurul Kusumawardani.jpg'); ?>"></div>
<div id="img2" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/dhina-puspasari-wijaya.png'); ?>"></div>
<div id="img3" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/aizan-syalim.png'); ?>"></div>
<div id="img4" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Nurul.webp'); ?>"></div>
<div id="img5" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Emelda.webp'); ?>"></div>
<div id="img6" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Eliza.webp'); ?>"></div>
<div id="img7" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Silvia.webp'); ?>"></div>
<div id="img8" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Adelia.webp'); ?>"></div>
<div id="img9" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Indah.webp'); ?>"></div>
<div id="img10" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Affrent.webp'); ?>"></div>
<div id="img11" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Ainiyah.webp'); ?>"></div>
<div id="img12" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Aldianus.webp'); ?>"></div>
<div id="img13" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Almas.webp'); ?>"></div>
<div id="img14" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Deni.webp'); ?>"></div>
<div id="img15" class="lightbox"><a href="#" class="lightbox-close">&times;</a><img src="<?= base_url('assets/images/frontend-pages/Nadia.webp'); ?>"></div>

<?= $this->endSection() ?>