<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
        }
        
        body {
            font-family: 'Nunito', sans-serif;
            background-color: var(--light-color);
            color: var(--dark-color);
        }
        
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
            color: white;
            padding: 5rem 0;
            margin-bottom: 3rem;
            border-radius: 0 0 20px 20px;
        }
        
        .privacy-card {
            border-radius: 15px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
            border: none;
        }
        
        .privacy-card .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 700;
            border-radius: 15px 15px 0 0 !important;
        }
        
        .section-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
        }
        
    </style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 fw-bold mb-4">Kebijakan Privasi E-Asfarm</h1>
        <p class="lead">Kami berkomitmen untuk melindungi data dan privasi Anda</p>
    </div>
</section>

<!-- Privacy Content -->
<section class="privacy-content py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Pengantar</h2>
                    </div>
                    <div class="card-body">
                        <p>Terima kasih telah menggunakan layanan E-Asfarm. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat Anda menggunakan website kami.</p>
                    </div>
                </div>

                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Informasi yang Kami Kumpulkan</h2>
                    </div>
                    <div class="card-body">
                        <p>Kami dapat mengumpulkan informasi pribadi Anda seperti nama, alamat email, dan informasi kontak lainnya saat Anda mendaftar atau menggunakan layanan kami. Kami juga dapat mengumpulkan informasi non-pribadi seperti informasi perangkat dan penggunaan ketika Anda berinteraksi dengan website kami.</p>
                    </div>
                </div>

                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Penggunaan Informasi</h2>
                    </div>
                    <div class="card-body">
                        <p>Informasi yang kami kumpulkan digunakan untuk menyediakan layanan kami kepada Anda, termasuk memberikan informasi kesehatan dan konsultasi kepada Anda. Kami juga dapat menggunakan informasi tersebut untuk meningkatkan layanan kami, menganalisis tren penggunaan, dan mengelola akun Anda.</p>
                    </div>
                </div>

                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Pembagian Informasi</h2>
                    </div>
                    <div class="card-body">
                        <p>Kami tidak akan menjual, menyewakan, atau membagikan informasi pribadi Anda kepada pihak ketiga tanpa izin Anda, kecuali jika diperlukan oleh hukum atau jika diperlukan untuk menyediakan layanan kepada Anda.</p>
                    </div>
                </div>

                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Keamanan Informasi</h2>
                    </div>
                    <div class="card-body">
                        <p>Kami mengambil langkah-langkah keamanan yang wajar untuk melindungi informasi pribadi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah. Namun, perlu diingat bahwa tidak ada metode transmisi melalui internet atau metode penyimpanan elektronik yang 100% aman.</p>
                    </div>
                </div>

                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Pengaturan Privasi</h2>
                    </div>
                    <div class="card-body">
                        <p>Anda memiliki hak untuk mengakses, memperbarui, atau menghapus informasi pribadi Anda yang tersimpan oleh kami. Anda juga dapat memilih untuk tidak menerima komunikasi pemasaran dari kami dengan menghubungi kami langsung.</p>
                    </div>
                </div>

                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Perubahan pada Kebijakan Privasi</h2>
                    </div>
                    <div class="card-body">
                        <p>Kami dapat mengubah atau memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan tersebut akan efektif segera setelah diposting di website kami. Kami mendorong Anda untuk secara berkala memeriksa kebijakan privasi kami untuk memahami bagaimana informasi Anda dilindungi.</p>
                    </div>
                </div>

                <div class="card privacy-card mb-4">
                    <div class="card-header py-3">
                        <h2 class="section-title">Penutup</h2>
                    </div>
                    <div class="card-body">
                        <p>Dengan menggunakan layanan E-Asfarm, Anda menyetujui pengumpulan, penggunaan, dan pengungkapan informasi Anda sesuai dengan kebijakan privasi ini. Jika Anda memiliki pertanyaan atau kekhawatiran tentang kebijakan privasi kami, silakan hubungi kami.</p>
                        <p class="fw-bold">Terima kasih atas kepercayaan Anda pada E-Asfarm.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>