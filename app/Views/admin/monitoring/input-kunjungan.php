<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/monitoring.css') ?>">
<style>
.wizard-step {
    display: none;
}
.wizard-step.active {
    display: block;
}
</style>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('admin/monitoring/riwayat/'.$monitoring['id']) ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <h2><?= $isEdit ? 'Edit' : 'Input' ?> Kunjungan Rutin - Kunjungan ke-<?= $kunjunganKe ?></h2>
            <p class="text-muted">Pasien: <strong><?= esc($identitas['nama_ibu']) ?></strong></p>
            <?php if(!$isEdit): ?>
            <p class="mb-0">
                <span class="badge bg-<?= $kunjunganKe >= 13 ? 'warning' : 'info' ?> fs-6">
                    Kunjungan ke-<?= $kunjunganKe ?> dari maksimal <?= $maxKunjungan ?>
                </span>
                <?php if($kunjunganKe >= 13): ?>
                    <span class="badge bg-warning fs-6 ms-2">⚠️ Mendekati Batas Maksimal</span>
                <?php endif; ?>
            </p>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Info & Tanggal Kunjungan -->
                    <div class="alert alert-<?= $isEdit ? 'warning' : 'info' ?> mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h5 class="mb-0"><i class="ti ti-calendar-event"></i> <?= $isEdit ? 'Edit' : '' ?> Kunjungan ke-<?= $kunjunganKe ?></h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label mb-1">Tanggal Kunjungan *</label>
                                <input type="date" id="tanggalKunjungan" class="form-control" value="<?= $isEdit ? ($kunjunganData['kunjungan']['tanggal_kunjungan'] ?? date('Y-m-d')) : date('Y-m-d') ?>" required>
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="wizard-progress mb-4">
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" id="wizardProgress" role="progressbar" style="width: 25%;">
                                Tahap 1 dari 4
                            </div>
                        </div>
                    </div>

                    <form id="kunjunganForm" method="POST" action="<?= $isEdit ? base_url('admin/monitoring/update-kunjungan/'.$kunjunganData['kunjungan']['id']) : base_url('admin/monitoring/store-kunjungan/'.$monitoring['id']) ?>">
                        <?= csrf_field() ?>
                        <input type="hidden" name="tanggal_kunjungan" id="tanggalKunjunganHidden" value="<?= $isEdit ? ($kunjunganData['kunjungan']['tanggal_kunjungan'] ?? date('Y-m-d')) : date('Y-m-d') ?>">

                        <!-- Step 1: Antropometri (SAMA dengan Tahap 2 input awal) -->
                        <div class="wizard-step active" id="step1">
                            <h4 class="mb-4">Tahap 1: Data Antropometri</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tekanan Darah (TD) *</label>
                                    <input type="text" name="tekanan_darah" class="form-control" placeholder="120/80" value="<?= $isEdit ? esc($kunjunganData['antropometri']['tekanan_darah'] ?? '') : '' ?>" required>
                                    <small class="text-muted">Format: Sistolik/Diastolik (contoh: 120/80)</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Berat Badan (kg) *</label>
                                    <input type="number" name="berat_badan" class="form-control" step="0.1" min="30" max="150" placeholder="Contoh: 55.5" value="<?= $isEdit ? esc($kunjunganData['antropometri']['berat_badan'] ?? '') : '' ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tinggi Badan (cm) *</label>
                                    <input type="number" name="tinggi_badan" class="form-control" step="0.1" min="130" max="200" placeholder="Contoh: 160.0" value="<?= $isEdit ? esc($kunjunganData['antropometri']['tinggi_badan'] ?? '') : '' ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lila - Lingkar Lengan Atas (cm) *</label>
                                    <input type="number" name="lila" class="form-control" step="0.1" min="15" max="50" placeholder="Contoh: 28.5" value="<?= $isEdit ? esc($kunjunganData['antropometri']['lila'] ?? '') : '' ?>" required>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Keluhan (SAMA dengan Tahap 3 input awal) -->
                        <div class="wizard-step" id="step2">
                            <h4 class="mb-4">Tahap 2: Keluhan & Gejala</h4>
                            <p class="text-muted">Pilih keluhan yang dialami (bisa lebih dari satu)</p>
                            <?php 
                            $keluhanList = [];
                            if($isEdit && isset($kunjunganData['keluhan']['keluhan'])) {
                                $keluhanList = json_decode($kunjunganData['keluhan']['keluhan'], true) ?? [];
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Mual/muntah berlebihan" id="k1" <?= in_array('Mual/muntah berlebihan', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k1">Mual/muntah berlebihan</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Perdarahan sedikit/banyak" id="k2" <?= in_array('Perdarahan sedikit/banyak', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k2">Perdarahan sedikit/banyak</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Gerakan janin" id="k3" <?= in_array('Gerakan janin', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k3">Gerakan janin</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Kaki bengkak" id="k4" <?= in_array('Kaki bengkak', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k4">Kaki bengkak</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Sakit kepala hebat" id="k5" <?= in_array('Sakit kepala hebat', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k5">Sakit kepala hebat</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Gangguan penglihatan" id="k6" <?= in_array('Gangguan penglihatan', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k6">Gangguan penglihatan</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Lainnya" id="k7" <?= in_array('Lainnya', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k7">Lainnya</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Tidak ada keluhan" id="k8" <?= in_array('Tidak ada keluhan', $keluhanList) ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="k8">Tidak ada keluhan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Suplementasi (SAMA dengan Tahap 6 input awal) -->
                        <div class="wizard-step" id="step3">
                            <h4 class="mb-4">Tahap 3: Penggunaan Tablet Tambah Darah atau Suplementasi Kehamilan</h4>
                            
                            <?php 
                            $suplementasi = $isEdit ? $kunjunganData['suplementasi'] : null;
                            ?>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Suplemen *</label>
                                    <input type="text" name="nama_suplemen" class="form-control" placeholder="Contoh: Tablet Fe" value="<?= $isEdit ? esc($suplementasi['nama_suplemen'] ?? '') : '' ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status Pemberian *</label>
                                    <select name="status_pemberian" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="sudah_diberikan" <?= $isEdit && ($suplementasi['status_pemberian'] ?? '') == 'sudah_diberikan' ? 'selected' : '' ?>>Sudah diberikan</option>
                                        <option value="belum_diberikan" <?= $isEdit && ($suplementasi['status_pemberian'] ?? '') == 'belum_diberikan' ? 'selected' : '' ?>>Belum diberikan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jumlah Tablet yang Diberikan</label>
                                    <input type="number" name="jumlah_tablet" class="form-control" min="0" placeholder="Contoh: 30" value="<?= $isEdit ? esc($suplementasi['jumlah_tablet'] ?? '') : '' ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Frekuensi Pemberian *</label>
                                    <select name="frekuensi" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="1x sehari" <?= $isEdit && ($suplementasi['frekuensi'] ?? '') == '1x sehari' ? 'selected' : '' ?>>1x sehari</option>
                                        <option value="2x sehari" <?= $isEdit && ($suplementasi['frekuensi'] ?? '') == '2x sehari' ? 'selected' : '' ?>>2x sehari</option>
                                        <option value="3x sehari" <?= $isEdit && ($suplementasi['frekuensi'] ?? '') == '3x sehari' ? 'selected' : '' ?>>3x sehari</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Khusus (Efek Samping)</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Mual" id="e1"><label class="form-check-label" for="e1">Mual</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Muntah" id="e2"><label class="form-check-label" for="e2">Muntah</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Diare" id="e3"><label class="form-check-label" for="e3">Diare</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Sembelit" id="e4"><label class="form-check-label" for="e4">Sembelit (susah BAB)</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Nyeri perut" id="e5"><label class="form-check-label" for="e5">Nyeri atau tidak nyaman pada perut</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Tinja hitam" id="e6"><label class="form-check-label" for="e6">Perubahan warna tinja menjadi hitam</label></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Rasa logam" id="e7"><label class="form-check-label" for="e7">Perubahan rasa mulut (rasa logam)</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Kehilangan nafsu makan" id="e8"><label class="form-check-label" for="e8">Kehilangan nafsu makan</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Reaksi alergi" id="e9"><label class="form-check-label" for="e9">Reaksi alergi (gatal, ruam, bengkak)</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Pusing" id="e10"><label class="form-check-label" for="e10">Efek pusing atau kepala ringan</label></div>
                                        <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Tidak ada" id="e11"><label class="form-check-label" for="e11">Tidak ada efek samping</label></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Etnomedisin -->
                        <div class="wizard-step" id="step4">
                            <h4 class="mb-4">Tahap 4: Penggunaan Etnomedisin</h4>
                            <?php 
                            $etnomedisin = $isEdit ? $kunjunganData['etnomedisin'] : null;
                            $menggunakanObat = $isEdit ? ($etnomedisin['menggunakan_obat_tradisional'] ?? 'tidak') : 'tidak';
                            ?>
                            <div class="mb-4">
                                <label class="form-label">Apakah ibu hamil menggunakan obat tradisional? *</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="menggunakan_obat_tradisional" value="ya" id="etno_ya" onchange="toggleEtnomedisin(true)" <?= $menggunakanObat == 'ya' ? 'checked' : '' ?> required>
                                    <label class="form-check-label" for="etno_ya">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="menggunakan_obat_tradisional" value="tidak" id="etno_tidak" onchange="toggleEtnomedisin(false)" <?= $menggunakanObat == 'tidak' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="etno_tidak">Tidak</label>
                                </div>
                            </div>

                            <div id="etnomedisinForm" style="display:<?= $menggunakanObat == 'ya' ? 'block' : 'none' ?>;">
                                <div class="mb-3">
                                    <label class="form-label">Jenis obat tradisional yang digunakan</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Jahe" id="j1"><label class="form-check-label" for="j1">Jahe</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Kunyit" id="j2"><label class="form-check-label" for="j2">Kunyit</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Habbatussauda" id="j3"><label class="form-check-label" for="j3">Habbatussauda</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Daun Ketari" id="j4"><label class="form-check-label" for="j4">Daun Ketari</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Kayu Manis" id="j5"><label class="form-check-label" for="j5">Kayu Manis</label></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Daun Selasih" id="j6"><label class="form-check-label" for="j6">Daun Selasih</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Minyak Kelapa" id="j7"><label class="form-check-label" for="j7">Minyak Kelapa</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Pasak Bumi" id="j8"><label class="form-check-label" for="j8">Pasak Bumi</label></div>
                                            <div class="form-check mb-2"><input class="form-check-input" type="checkbox" value="1" id="j9"><label class="form-check-label" for="j9">Lainnya</label></div>
                                            <input type="text" name="jenis_obat_lainnya" class="form-control" id="obatLainnya" placeholder="Sebutkan jenis obat lainnya...">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tujuan penggunaan</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Mengatasi mual" id="tu1"><label class="form-check-label" for="tu1">Mengatasi mual</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Menguatkan kandungan" id="tu2"><label class="form-check-label" for="tu2">Menguatkan kandungan</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Mengurangi nyeri" id="tu3"><label class="form-check-label" for="tu3">Mengurangi nyeri</label></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Mengatasi keputihan" id="tu4"><label class="form-check-label" for="tu4">Mengatasi keputihan</label></div>
                                            <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Menjaga stamina ibu hamil" id="tu5"><label class="form-check-label" for="tu5">Menjaga stamina ibu hamil</label></div>
                                            <div class="form-check mb-2"><input class="form-check-input" type="checkbox" value="1" id="tu6"><label class="form-check-label" for="tu6">Lainnya</label></div>
                                            <input type="text" name="tujuan_lainnya" class="form-control" id="tujuanLainnya" placeholder="Sebutkan tujuan lainnya...">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Dosis dan frekuensi penggunaan</label>
                                        <select name="dosis_frekuensi" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="Setiap hari">Setiap hari</option>
                                            <option value="2-3 kali seminggu">2-3 kali seminggu</option>
                                            <option value="Mingguan">Mingguan</option>
                                            <option value="Sesuai kebutuhan">Sesuai kebutuhan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Edukasi tentang manfaat dan risiko</label>
                                        <select name="edukasi_diberikan" class="form-select">
                                            <option value="">-- Pilih --</option>
                                            <option value="sudah">Sudah diberi edukasi</option>
                                            <option value="belum">Belum diberi edukasi</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="wizard-navigation mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display:none;">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                                Lanjut <i class="ti ti-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">
                                <i class="ti ti-check"></i> <?= $isEdit ? 'Update' : 'Simpan' ?> Kunjungan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Wizard variables
let currentStep = 1;
const totalSteps = 4;

// Sync tanggal kunjungan
document.getElementById('tanggalKunjungan').addEventListener('change', function() {
    document.getElementById('tanggalKunjunganHidden').value = this.value;
});

// Toggle etnomedisin
function toggleEtnomedisin(show) {
    document.getElementById('etnomedisinForm').style.display = show ? 'block' : 'none';
}

// Toggle lainnya obat
function toggleLainnyaObat(checkbox) {
    document.getElementById('obatLainnya').style.display = checkbox.checked ? 'block' : 'none';
}

// Toggle lainnya tujuan
function toggleLainnyaTujuan(checkbox) {
    document.getElementById('tujuanLainnya').style.display = checkbox.checked ? 'block' : 'none';
}

// Validate step
function validateStep(step) {
    const currentStepDiv = document.getElementById('step' + step);
    const inputs = currentStepDiv.querySelectorAll('input[required]:not([type="radio"]):not([type="checkbox"]), select[required]');
    
    for (let input of inputs) {
        if (!input.value) {
            input.focus();
            alert('Mohon lengkapi semua field yang wajib diisi');
            return false;
        }
    }
    
    // Validasi radio button
    const radioGroups = currentStepDiv.querySelectorAll('input[type="radio"][required]');
    const radioNames = new Set();
    radioGroups.forEach(radio => radioNames.add(radio.name));
    
    for (let name of radioNames) {
        const checked = currentStepDiv.querySelector(`input[name="${name}"]:checked`);
        if (!checked) {
            alert('Mohon pilih salah satu opsi yang tersedia');
            return false;
        }
    }
    
    return true;
}

// Change step
function changeStep(direction) {
    if (direction === 1 && !validateStep(currentStep)) {
        return false;
    }
    
    // Hide current step
    document.getElementById('step' + currentStep).classList.remove('active');
    
    // Update step
    currentStep += direction;
    
    // Show new step
    document.getElementById('step' + currentStep).classList.add('active');
    
    // Update progress bar
    const progress = (currentStep / totalSteps) * 100;
    document.getElementById('wizardProgress').style.width = progress + '%';
    document.getElementById('wizardProgress').textContent = 'Tahap ' + currentStep + ' dari ' + totalSteps;
    
    // Update buttons
    document.getElementById('prevBtn').style.display = currentStep === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = currentStep === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = currentStep === totalSteps ? 'inline-block' : 'none';
    
    // Scroll to top
    window.scrollTo(0, 0);
}

// Form submit handler
document.getElementById('kunjunganForm').addEventListener('submit', function(e) {
    if (!validateStep(currentStep)) {
        e.preventDefault();
        return false;
    }
    
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="ti ti-loader"></i> Menyimpan...';
});
</script>
<?= $this->endSection() ?>
