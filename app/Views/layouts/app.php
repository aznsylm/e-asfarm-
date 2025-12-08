<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('assets/images/logos/E-Asfarm-Logo.png'); ?>" />

    <!-- Core Css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css'); ?>" />

    <title>E-Asfarm</title>
    
    <!-- Custom Head Section -->
    <?= $this->renderSection('head') ?>
    
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="<?= base_url('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css'); ?>" />

    <!-- Tabler Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/fonts/tabler-icon/tabler-icons.min.css'); ?>" />

    <!-- Font Awesome untuk icon WhatsApp -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>


    <style>
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }

        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
            opacity: revert-layer;
            background-color: transparent;
            pointer-events: none;
        }

        /* WhatsApp Button Styles */
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 100;
            transition: all 0.3s ease;
        }

        .whatsapp-float .btn-whatsapp {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 120px;
            height: 150px;
            border-radius: 0;
            background-color: transparent;
            color: white;
            font-size: 30px;
            box-shadow: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            padding: 0;
            overflow: hidden;
        }

        .whatsapp-float .btn-whatsapp img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .whatsapp-float .btn-whatsapp:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-float .btn-whatsapp {
                width: 120px;
                height: 150px;
                font-size: 28px;
            }
        }

        /* Modal Template Pesan */
        .whatsapp-modal {
            display: none;
            position: fixed;
            bottom: 100px;
            right: 30px;
            width: 450px;
            max-height: 80vh;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            z-index: 101;
            padding: 20px;
            overflow-y: auto;
        }

        .whatsapp-modal h5 {
            color: #075E54;
            margin-bottom: 5px;
            font-size: 16px;
            font-weight: 700;
        }

        .whatsapp-modal .subtitle {
            color: #333;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .whatsapp-modal .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .whatsapp-modal .step {
            flex: 1;
            height: 4px;
            background: #ddd;
            margin: 0 2px;
            border-radius: 2px;
        }

        .whatsapp-modal .step.active {
            background: #25D366;
        }

        .whatsapp-modal .form-step {
            display: none;
        }

        .whatsapp-modal .form-step.active {
            display: block;
        }

        .whatsapp-modal .form-control, .whatsapp-modal .form-select {
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        .whatsapp-modal .checkbox-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            max-height: 250px;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        .whatsapp-modal .checkbox-item {
            display: flex;
            align-items: start;
            font-size: 11px;
            color: #333;
        }

        .whatsapp-modal .checkbox-item input {
            margin-right: 5px;
            margin-top: 2px;
        }

        .whatsapp-modal .checkbox-item label {
            cursor: pointer;
            line-height: 1.3;
            color: #333;
        }

        .whatsapp-modal .btn-nav {
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            margin-top: 10px;
        }

        .whatsapp-modal .btn-nav:hover {
            background-color: #128C7E;
        }

        .whatsapp-modal .btn-prev {
            background-color: #6c757d;
        }

        .whatsapp-modal .btn-prev:hover {
            background-color: #5a6268;
        }

        .whatsapp-modal .btn-close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .whatsapp-modal {
                width: 90%;
                right: 5%;
                bottom: 80px;
            }
        }

        /* Scroll Top Button - Position above WhatsApp */
        .top-btn {
            position: fixed;
            bottom: 200px;
            right: 30px;
            z-index: 99;
        }

        @media (max-width: 768px) {
            .top-btn {
                bottom: 190px;
                right: 20px;
                width: 56px !important;
                height: 56px !important;
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="<?= base_url('assets/images/logos/favicon.png'); ?>" alt="loader" class="lds-ripple img-fluid" />
    </div>

    <!-- Header -->
    <?php include('asset/header.php') ?>

    <!-- start content -->
    <?= $this->renderSection('content') ?>
    <!-- end content -->

    <!-- Footer -->
    <?php include('asset/footer.php') ?>

    <!-- Scroll Top -->
    <a href="javascript:void(0)" class="top-btn btn btn-primary d-flex align-items-center justify-content-center round-54 p-0 rounded-circle">
        <i class="ti ti-arrow-up fs-7"></i>
    </a>

    <!-- WhatsApp Floating Button -->
    <div class="whatsapp-float">
        <button class="btn-whatsapp" id="whatsappButton">
            <img src="<?= base_url('assets/images/frontend-pages/whatsapp.png'); ?>" alt="WhatsApp">
        </button>
    </div>

    <!-- WhatsApp Message Template Modal -->
    <div class="whatsapp-modal" id="whatsappModal">
        <button type="button" class="btn-close" id="closeModal"></button>
        <h5>Kirim Pawartos / Kirim Pesan</h5>
        <p class="subtitle">Isi formulir untuk konsultasi kesehatan</p>
        
        <div class="step-indicator">
            <div class="step active" id="stepBar1"></div>
            <div class="step" id="stepBar2"></div>
            <div class="step" id="stepBar3"></div>
            <div class="step" id="stepBar4"></div>
        </div>

        <form id="whatsappForm">
            <!-- Step 1: Identitas -->
            <div class="form-step active" id="step1">
                <label style="font-size: 13px; font-weight: 600; margin-bottom: 8px; color: #333;">Asmanipun / Nama Lengkap</label>
                <input type="text" class="form-control" id="fullName" required>
                
                <label style="font-size: 13px; font-weight: 600; margin-bottom: 8px; margin-top: 10px; color: #333;">Yuswo (taun) / Usia (th)</label>
                <input type="number" class="form-control" id="age" min="1" max="120" required>
                
                <label style="font-size: 13px; font-weight: 600; margin-bottom: 8px; margin-top: 10px; color: #333;">Jinis Kelamin / Jenis Kelamin</label>
                <select class="form-select" id="gender" required>
                    <option value="">Pilih / Pilih</option>
                    <option value="Estri / Perempuan">Estri / Perempuan</option>
                    <option value="Kakung / Laki-laki">Kakung / Laki-laki</option>
                </select>
                
                <button type="button" class="btn-nav w-100" onclick="nextStep(2)">Lajengaken / Lanjut</button>
            </div>

            <!-- Step 2: Kategori Konsultasi -->
            <div class="form-step" id="step2">
                <label style="font-size: 13px; font-weight: 600; margin-bottom: 8px; color: #333;">Sinten ingkang badhe panjenengan rembugi? / Siapa yang Akan Anda Konsultasikan?</label>
                <select class="form-select" id="category" required>
                    <option value="">Pilih / Pilih</option>
                    <option value="Lare / Bocah / Balita / Anak">Lare / Bocah / Balita / Anak</option>
                    <option value="Ngandhut / Kehamilan">Ngandhut / Kehamilan</option>
                    <option value="Nyusoni / Menyusui">Nyusoni / Menyusui</option>
                    <option value="Enom / Remaja">Enom / Remaja</option>
                </select>
                
                <div class="d-flex gap-2 mt-3">
                    <button type="button" class="btn-nav btn-prev flex-fill" onclick="prevStep(1)">Wangsul / Kembali</button>
                    <button type="button" class="btn-nav flex-fill" onclick="nextStep(3)">Lajengaken / Lanjut</button>
                </div>
            </div>

            <!-- Step 3: Keluhan -->
            <div class="form-step" id="step3">
                <label style="font-size: 13px; font-weight: 600; margin-bottom: 8px; color: #333;">Menopo ingkang di raosaken? / Silakan Pilih Keluhan yang Anda Alami</label>
                <div class="checkbox-grid">
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Pilek" id="k1"><label for="k1">Pilek / Pilek (Flu)</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Batuk" id="k2"><label for="k2">Watuk / Batuk</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Pusing" id="k3"><label for="k3">Mumet / Pusing</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Sariawan" id="k4"><label for="k4">Sariawan / Sariawan</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Diare" id="k5"><label for="k5">Mencret / Diare</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Sembelit" id="k6"><label for="k6">Bebelen / Sembelit</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Anak tidak mau makan" id="k7"><label for="k7">Lare mboten purun maem / Anak tidak mau makan</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Mual" id="k8"><label for="k8">Mual (blokean) / Mual</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Muntah" id="k9"><label for="k9">Muntah / Muntah</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Gatal" id="k10"><label for="k10">Gatelen / Gatal</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Demam" id="k11"><label for="k11">Benter / Demam</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Pusing kepala" id="k12"><label for="k12">Mumet ingkang dhagu / Pusing di kepala</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Anyang-anyangan" id="k13"><label for="k13">Anyang-ayangen / Sering kencing</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Jantung berdebar" id="k14"><label for="k14">Banter / Jantung berdebar</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Tekanan darah tinggi" id="k15"><label for="k15">Tensi Dhuwur / Tekanan darah tinggi</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Lemas" id="k16"><label for="k16">Gringginengan / Lemas</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Kram" id="k17"><label for="k17">Kram / Kram</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Gerakan janin keras" id="k18"><label for="k18">Kelantak-Klentuk / Gerakan janin keras</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Mual muntah berat" id="k19"><label for="k19">Mual lan muntah abot / Mual muntah berat</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Tidak nafsu makan" id="k20"><label for="k20">Ora napsu maem / Tidak nafsu makan</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Flek darah" id="k21"><label for="k21">Metu rah / flek / Flek darah</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Janin kurang gerak" id="k22"><label for="k22">Janin kurang gerak / Janin kurang gerak</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Persiapan persalinan" id="k23"><label for="k23">Arep nyiapke babaran / Persiapan persalinan</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Makan setelah melahirkan" id="k24"><label for="k24">Njagani dhaharan bibar babaran / Makan setelah melahirkan</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Tinggi berat badan stabil" id="k25"><label for="k25">Dhuwure lan bobote ajeg / Tinggi berat badan stabil</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Makanan sehat" id="k26"><label for="k26">Dhaharan ingkang sehat / Makanan sehat</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Pola makan tidak teratur" id="k27"><label for="k27">Padaharane kenceng / Pola makan tidak teratur</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="keluhan" value="Dehidrasi" id="k28"><label for="k28">Dehidrasi / Dehidrasi</label></div>
                </div>
                
                <div class="d-flex gap-2 mt-3">
                    <button type="button" class="btn-nav btn-prev flex-fill" onclick="prevStep(2)">Wangsul / Kembali</button>
                    <button type="button" class="btn-nav flex-fill" onclick="nextStep(4)">Lajengaken / Lanjut</button>
                </div>
            </div>

            <!-- Step 4: Kebutuhan & Pesan -->
            <div class="form-step" id="step4">
                <label style="font-size: 13px; font-weight: 600; margin-bottom: 8px; color: #333;">Pilih Kabutuhan Panjenengan / Pilih Kebutuhan Konsultasi Anda</label>
                <div class="checkbox-grid">
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Obat habis" id="n1"><label for="n1">Obate entek / Obat habis</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Dosis obat" id="n2"><label for="n2">Kepingin takon dosis obat / Dosis obat</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Anak susah minum obat" id="n3"><label for="n3">Lare angel ngombé obat / Anak susah minum obat</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Fungsi obat" id="n4"><label for="n4">Ra ngerti obat punika kanggo nopo / Fungsi obat</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Efek samping obat" id="n5"><label for="n5">Efek samping obat / Efek samping obat</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Obat tidak cocok" id="n6"><label for="n6">Obat ora cocok / Obat tidak cocok</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Beli obat bingung" id="n7"><label for="n7">Pengin tuku obat nanging bingung / Beli obat bingung</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Obat untuk ibu menyusui" id="n8"><label for="n8">Obat cocok ora kanggo ibu nyusoni / Obat untuk ibu menyusui</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Susu formula" id="n9"><label for="n9">Susu formula cocok ora / Susu formula</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Cara menyimpan ASI" id="n10"><label for="n10">Nyimpen ASI kados pundi / Cara menyimpan ASI</label></div>
                    <div class="checkbox-item"><input type="checkbox" name="kebutuhan" value="Makanan untuk ASI" id="n11"><label for="n11">Panganan sing apik kanggo nambah ASI / Makanan untuk ASI</label></div>
                </div>
                
                <label style="font-size: 13px; font-weight: 600; margin-bottom: 8px; margin-top: 10px; color: #333;">Pesen Tambahan (Maks 100 tembung) / Pesan Tambahan (Maks 100 kata)</label>
                <textarea class="form-control" id="additionalMessage" rows="3" maxlength="500" placeholder="Tulis pesan tambahan..."></textarea>
                
                <div class="d-flex gap-2 mt-3">
                    <button type="button" class="btn-nav btn-prev flex-fill" onclick="prevStep(3)">Wangsul / Kembali</button>
                    <button type="submit" class="btn-nav flex-fill">Kirim / Kirim</button>
                </div>
            </div>
        </form>
    </div>

    <script src="<?= base_url('assets/js/vendor.min.js'); ?>"></script>
    <!-- Import Js Files -->
    <script src="<?= base_url('assets/js/vendor.min.js'); ?>"></script>
    <script src="<?= base_url('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?= base_url('assets/libs/simplebar/dist/simplebar.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/theme/app.init.js'); ?>"></script>
    <script src="<?= base_url('assets/js/theme/theme.js'); ?>"></script>
    <script src="<?= base_url('assets/js/theme/app.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/theme/sidebarmenu-default.js'); ?>"></script>

    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script src="<?= base_url('assets/libs/owl.carousel/dist/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/frontend-landingpage/homepage.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.js"></script>

    <!-- WhatsApp Button Script -->
    <script>
        let currentStep = 1;

        function nextStep(step) {
            // Validasi step sebelumnya
            if (step === 2) {
                const fullName = document.getElementById('fullName').value;
                const age = document.getElementById('age').value;
                const gender = document.getElementById('gender').value;
                if (!fullName || !age || !gender) {
                    alert('Mohon lengkapi semua data identitas');
                    return;
                }
            }
            if (step === 3) {
                const category = document.getElementById('category').value;
                if (!category) {
                    alert('Mohon pilih kategori konsultasi');
                    return;
                }
            }
            if (step === 4) {
                const keluhan = document.querySelectorAll('input[name="keluhan"]:checked');
                if (keluhan.length === 0) {
                    alert('Mohon pilih minimal 1 keluhan');
                    return;
                }
            }

            // Hide current step
            document.getElementById('step' + currentStep).classList.remove('active');
            document.getElementById('stepBar' + currentStep).classList.remove('active');
            
            // Show next step
            currentStep = step;
            document.getElementById('step' + currentStep).classList.add('active');
            document.getElementById('stepBar' + currentStep).classList.add('active');
        }

        function prevStep(step) {
            document.getElementById('step' + currentStep).classList.remove('active');
            document.getElementById('stepBar' + currentStep).classList.remove('active');
            currentStep = step;
            document.getElementById('step' + currentStep).classList.add('active');
            document.getElementById('stepBar' + currentStep).classList.add('active');
        }

        function determineExpert(keluhanList, kebutuhanList) {
            // Keywords untuk Apoteker (Farmasi) - sesuai pilihan form
            const farmasiKeywords = [
                'pilek', 'batuk', 'pusing', 'sariawan', 'diare', 'sembelit', 'mual', 'muntah', 'gatal', 'demam',
                'obat habis', 'dosis obat', 'anak susah minum obat', 'fungsi obat', 'efek samping obat',
                'obat tidak cocok', 'beli obat bingung', 'obat untuk ibu menyusui'
            ];

            // Keywords untuk Ahli Gizi - sesuai pilihan form
            const giziKeywords = [
                'tidak nafsu makan', 'tinggi berat badan stabil', 'makanan sehat', 'pola makan tidak teratur',
                'dehidrasi', 'makan setelah melahirkan', 'makanan untuk asi', 'tekanan darah tinggi'
            ];

            // Keywords untuk Bidan - sesuai pilihan form
            const bidanKeywords = [
                'anyang-anyangan', 'jantung berdebar', 'lemas', 'kram', 'gerakan janin keras',
                'mual muntah berat', 'flek darah', 'janin kurang gerak', 'persiapan persalinan',
                'anak tidak mau makan', 'susu formula', 'cara menyimpan asi'
            ];

            let farmasiScore = 0;
            let giziScore = 0;
            let bidanScore = 0;

            // Hitung score berdasarkan keluhan dan kebutuhan
            const allText = (keluhanList.join(' ') + ' ' + kebutuhanList.join(' ')).toLowerCase();

            farmasiKeywords.forEach(keyword => {
                if (allText.includes(keyword.toLowerCase())) farmasiScore++;
            });
            giziKeywords.forEach(keyword => {
                if (allText.includes(keyword.toLowerCase())) giziScore++;
            });
            bidanKeywords.forEach(keyword => {
                if (allText.includes(keyword.toLowerCase())) bidanScore++;
            });

            // Ambil kategori untuk priority logic
            const category = document.getElementById('category').value.toLowerCase();

            // Tentukan expert dengan score tertinggi
            const maxScore = Math.max(farmasiScore, giziScore, bidanScore);

            // Jika ada tie (skor sama), gunakan priority logic
            if (farmasiScore === giziScore && giziScore === bidanScore) {
                // Semua skor sama, prioritas: Bidan > Gizi > Farmasi
                if (category.includes('kehamilan') || category.includes('balita')) {
                    return { name: 'Bidan: Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb', phone: '62088233780554' };
                }
                return { name: 'Bidan: Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb', phone: '62088233780554' };
            }

            // Jika Bidan dan Gizi tie
            if (bidanScore === giziScore && bidanScore === maxScore) {
                if (category.includes('kehamilan')) {
                    return { name: 'Bidan: Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb', phone: '62088233780554' };
                } else if (category.includes('balita')) {
                    return { name: 'Ahli Gizi: Wiji Indah Lestari, S.Gz., M.K.M', phone: '6282293679312' };
                }
                return { name: 'Bidan: Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb', phone: '62088233780554' };
            }

            // Jika Bidan dan Farmasi tie
            if (bidanScore === farmasiScore && bidanScore === maxScore) {
                return { name: 'Bidan: Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb', phone: '62088233780554' };
            }

            // Jika Gizi dan Farmasi tie
            if (giziScore === farmasiScore && giziScore === maxScore) {
                return { name: 'Ahli Gizi: Wiji Indah Lestari, S.Gz., M.K.M', phone: '6282293679312' };
            }

            // Tidak ada tie, pilih yang tertinggi
            if (bidanScore === maxScore) {
                return { name: 'Bidan: Silvia Rizki Syah Putri., S.Tr.Keb., M. Keb', phone: '62088233780554' };
            } else if (giziScore === maxScore) {
                return { name: 'Ahli Gizi: Wiji Indah Lestari, S.Gz., M.K.M', phone: '6282293679312' };
            } else {
                return { name: 'Apoteker: apt. Nurul Kusumawardani, M. Farm', phone: '6281902808231' };
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const whatsappButton = document.getElementById('whatsappButton');
            const whatsappModal = document.getElementById('whatsappModal');
            const closeModal = document.getElementById('closeModal');
            const whatsappForm = document.getElementById('whatsappForm');

            whatsappButton.addEventListener('click', function(e) {
                e.stopPropagation();
                whatsappModal.style.display = whatsappModal.style.display === 'block' ? 'none' : 'block';
            });

            closeModal.addEventListener('click', function(e) {
                e.stopPropagation();
                whatsappModal.style.display = 'none';
                // Reset form
                whatsappForm.reset();
                currentStep = 1;
                document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
                document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
                document.getElementById('step1').classList.add('active');
                document.getElementById('stepBar1').classList.add('active');
            });

            whatsappForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validasi kebutuhan
                const kebutuhan = document.querySelectorAll('input[name="kebutuhan"]:checked');
                if (kebutuhan.length === 0) {
                    alert('Mohon pilih minimal 1 kebutuhan konsultasi');
                    return;
                }

                // Ambil data form
                const fullName = document.getElementById('fullName').value;
                const age = document.getElementById('age').value;
                const gender = document.getElementById('gender').value;
                const category = document.getElementById('category').value;
                
                const keluhanChecked = Array.from(document.querySelectorAll('input[name="keluhan"]:checked')).map(cb => cb.value);
                const kebutuhanChecked = Array.from(document.querySelectorAll('input[name="kebutuhan"]:checked')).map(cb => cb.value);
                const additionalMessage = document.getElementById('additionalMessage').value;

                // Tentukan tenaga ahli
                const expert = determineExpert(keluhanChecked, kebutuhanChecked);

                // Format pesan WhatsApp
                let message = `*Konsultasi Kesehatan E-ASFARM*\n\n`;
                message += `*IDENTITAS*\n`;
                message += `Nama: ${fullName}\n`;
                message += `Usia: ${age} tahun\n`;
                message += `Jenis Kelamin: ${gender}\n`;
                message += `Kategori: ${category}\n\n`;
                message += `*KELUHAN/GEJALA*\n${keluhanChecked.join(', ')}\n\n`;
                message += `*KEBUTUHAN*\n${kebutuhanChecked.join(', ')}\n\n`;
                if (additionalMessage) {
                    message += `*PESAN TAMBAHAN*\n${additionalMessage}\n\n`;
                }
                message += `_Diarahkan ke: ${expert.name}_`;

                const encodedMessage = encodeURIComponent(message);
                window.open(`https://wa.me/${expert.phone}?text=${encodedMessage}`, '_blank');

                // Tampilkan alert konfirmasi
                setTimeout(() => {
                    alert('Pesan sudah disiapkan!\n\n Jangan lupa klik tombol KIRIM di chat WhatsApp agar pesan terkirim ke pakar.\n\n Mohon tunggu balasan dalam 1x24 jam.\n\n Matur nuwun / Terima kasih!');
                }, 500);

                // Reset dan tutup modal
                whatsappForm.reset();
                whatsappModal.style.display = 'none';
                currentStep = 1;
                document.querySelectorAll('.form-step').forEach(s => s.classList.remove('active'));
                document.querySelectorAll('.step').forEach(s => s.classList.remove('active'));
                document.getElementById('step1').classList.add('active');
                document.getElementById('stepBar1').classList.add('active');
            });
        });
    </script>


</body>

</html>