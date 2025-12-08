<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/monitoring.css') ?>">

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('admin/monitoring/balita') ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <h2>Input Data Monitoring Balita & Anak</h2>
            <p class="text-muted">Form Input 7 Tahap - Kesehatan Balita & Anak (0-5 tahun)</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="wizard-progress mb-4">
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" id="wizardProgress" role="progressbar" style="width: 14%;">
                                Tahap 1 dari 7
                            </div>
                        </div>
                    </div>

                    <form id="monitoringForm" method="POST" action="<?= base_url('admin/monitoring/balita/store') ?>" novalidate>
                        <?= csrf_field() ?>

                <!-- Tahap 1: Identitas Anak & Wali -->
                <div class="wizard-step active" id="step1">
                    <h4 class="mb-4">Tahap 1: Data Identitas Anak & Wali</h4>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilih Pasien *</label>
                            <select name="user_id" class="form-select" required>
                                <option value="">-- Pilih Pasien --</option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?= $user['id'] ?>"><?= esc($user['full_name']) ?> (<?= esc($user['username']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap Anak *</label>
                            <input type="text" name="nama_anak" class="form-control" placeholder="Contoh: Ahmad Fauzi" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir *</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Ibu/Wali *</label>
                            <input type="text" name="nama_wali" class="form-control" placeholder="Contoh: Siti Aminah" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. HP/WhatsApp Wali *</label>
                            <input type="text" name="no_hp_wali" class="form-control" placeholder="Contoh: 081234567890" required>
                        </div>
                    </div>

                    <input type="hidden" name="tanggal_kunjungan" value="<?= date('Y-m-d') ?>">
                </div>

                <!-- Tahap 2: Antropometri -->
                <div class="wizard-step" id="step2">
                    <h4 class="mb-4">Tahap 2: Data Antropometri</h4>

                    <div class="mb-3">
                        <label class="form-label">Berat Badan (kg) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="berat_badan" class="form-control" placeholder="Contoh: 8.5" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Panjang/Tinggi Badan (cm) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="tinggi_badan" class="form-control" placeholder="Contoh: 72.5" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Lingkar Kepala (cm) <small class="text-muted">(Opsional)</small></label>
                        <input type="number" step="0.01" name="lingkar_kepala" class="form-control" placeholder="Contoh: 45.0">
                    </div>
                </div>

                <!-- Tahap 3: Keluhan -->
                <div class="wizard-step" id="step3">
                    <h4 class="mb-4">Tahap 3: Keluhan Utama Saat Ini</h4>
                    <p class="text-muted">Pilih satu atau lebih keluhan (opsional)</p>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="batuk" value="1" id="batuk">
                        <label class="form-check-label" for="batuk">Batuk</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="pilek" value="1" id="pilek">
                        <label class="form-check-label" for="pilek">Pilek</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="demam" value="1" id="demam">
                        <label class="form-check-label" for="demam">Demam</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="diare" value="1" id="diare">
                        <label class="form-check-label" for="diare">Diare</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="sembelit" value="1" id="sembelit">
                        <label class="form-check-label" for="sembelit">Sembelit (Bebelen)</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="gtm" value="1" id="gtm">
                        <label class="form-check-label" for="gtm">GTM (Sulit Makan)</label>
                    </div>

                    <div class="mb-3 mt-3">
                        <label class="form-label">Lainnya</label>
                        <textarea name="lainnya" class="form-control" rows="2" placeholder="Sebutkan keluhan lainnya..."></textarea>
                    </div>
                </div>

                <!-- Tahap 4: Imunisasi & Alergi -->
                <div class="wizard-step" id="step4">
                    <h4 class="mb-4">Tahap 4: Status Imunisasi & Alergi</h4>

                    <div class="mb-3">
                        <label class="form-label">Riwayat Alergi</label>
                        <input type="text" name="riwayat_alergi" class="form-control" placeholder='Contoh: "Susu Sapi", "Parasetamol"'>
                        <small class="text-muted">Kosongkan jika tidak ada alergi</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status Imunisasi <span class="text-danger">*</span></label>
                        <select name="status_imunisasi" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Lengkap">Lengkap</option>
                            <option value="Terlewat">Terlewat</option>
                            <option value="Belum">Belum</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Jenis Imunisasi Wajib (0-18 Tahun)</label>
                        <p class="text-muted small">Centang vaksin yang sudah diberikan beserta waktu pemberiannya</p>

                        <!-- 1. Hepatitis B -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>1. Hepatitis B</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="2_bulan" id="hepb_2">
                                    <label class="form-check-label" for="hepb_2">2 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="3_bulan" id="hepb_3">
                                    <label class="form-check-label" for="hepb_3">3 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="4_bulan" id="hepb_4">
                                    <label class="form-check-label" for="hepb_4">4 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="18_bulan" id="hepb_18">
                                    <label class="form-check-label" for="hepb_18">18 Bulan</label>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Polio/IPV -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>2. Polio / IPV</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="saat_lahir" id="polio_lahir">
                                    <label class="form-check-label" for="polio_lahir">Saat Lahir</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="2_bulan" id="polio_2">
                                    <label class="form-check-label" for="polio_2">2 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="3_bulan" id="polio_3">
                                    <label class="form-check-label" for="polio_3">3 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="4_bulan" id="polio_4">
                                    <label class="form-check-label" for="polio_4">4 Bulan</label>
                                </div>
                            </div>
                        </div>

                        <!-- 3. BCG -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>3. BCG (Tuberkulosis/TBC)</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[bcg][]" value="saat_lahir" id="bcg_lahir">
                                    <label class="form-check-label" for="bcg_lahir">Saat Lahir</label>
                                </div>
                                <div class="input-group mt-2" style="max-width: 300px;">
                                    <span class="input-group-text">Lainnya</span>
                                    <input type="text" class="form-control" name="vaksin[bcg][]" placeholder="... bulan">
                                </div>
                            </div>
                        </div>

                        <!-- 4. Campak Rubella (MR) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>4. Campak Rubella (MR)</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[campak_rubella][]" value="9_bulan" id="mr_9">
                                    <label class="form-check-label" for="mr_9">9 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[campak_rubella][]" value="18_bulan" id="mr_18">
                                    <label class="form-check-label" for="mr_18">18 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[campak_rubella][]" value="5_tahun" id="mr_5">
                                    <label class="form-check-label" for="mr_5">5 Tahun</label>
                                </div>
                            </div>
                        </div>

                        <!-- 5. DPT-HB-Hib -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>5. DPT-HB-Hib</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="2_bulan" id="dpt_2">
                                    <label class="form-check-label" for="dpt_2">2 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="3_bulan" id="dpt_3">
                                    <label class="form-check-label" for="dpt_3">3 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="4_bulan" id="dpt_4">
                                    <label class="form-check-label" for="dpt_4">4 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="18_bulan" id="dpt_18">
                                    <label class="form-check-label" for="dpt_18">18 Bulan</label>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Pneumokokus (PCV) -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>6. Vaksin Pneumokokus (PCV)</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="2_bulan" id="pcv_2">
                                    <label class="form-check-label" for="pcv_2">2 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="4_bulan" id="pcv_4">
                                    <label class="form-check-label" for="pcv_4">4 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="6_bulan" id="pcv_6">
                                    <label class="form-check-label" for="pcv_6">6 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="12_15_bulan" id="pcv_12">
                                    <label class="form-check-label" for="pcv_12">12-15 Bulan</label>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Rotavirus -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>7. Vaksin Rotavirus Pentavalen</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[rotavirus][]" value="4_minggu" id="rota_4">
                                    <label class="form-check-label" for="rota_4">4 Minggu</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[rotavirus][]" value="6_minggu" id="rota_6">
                                    <label class="form-check-label" for="rota_6">6 Minggu</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[rotavirus][]" value="24_minggu" id="rota_24">
                                    <label class="form-check-label" for="rota_24">24 Minggu</label>
                                </div>
                            </div>
                        </div>

                        <!-- 8. Influenza -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>8. Vaksin Influenza</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[influenza][]" value="6_bulan" id="flu_6">
                                    <label class="form-check-label" for="flu_6">6 Bulan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="vaksin[influenza][]" value="ulangan" id="flu_ulang">
                                    <label class="form-check-label" for="flu_ulang">Ulangan</label>
                                </div>
                            </div>
                        </div>

                        <!-- 9. Vaksin Lainnya -->
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6>9. Vaksin Lainnya</h6>
                                <input type="text" class="form-control" name="vaksin[lainnya][]" placeholder="Tuliskan jenis vaksin lainnya jika ada...">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tahap 5: KPSP -->
                <div class="wizard-step" id="step5">
                    <h4 class="mb-4">Tahap 5: Skrining Perkembangan (KPSP)</h4>

                    <div class="mb-3">
                        <label class="form-label">Hasil Skrining <span class="text-danger">*</span></label>
                        <select name="hasil_skrining" class="form-select" required>
                            <option value="">-- Pilih Hasil --</option>
                            <option value="Sesuai">Sesuai (S)</option>
                            <option value="Meragukan">Meragukan (M)</option>
                            <option value="Penyimpangan">Penyimpangan (P)</option>
                        </select>
                        <small class="text-muted">S = Sesuai usia, M = Meragukan perlu evaluasi, P = Ada penyimpangan perlu rujukan</small>
                    </div>
                </div>

                <!-- Tahap 6: Gizi & Suplementasi -->
                <div class="wizard-step" id="step6">
                    <h4 class="mb-4">Tahap 6: Status Gizi & Suplementasi</h4>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="vitamin_a" value="1" id="vitamin_a">
                        <label class="form-check-label" for="vitamin_a">Dapat Vitamin A (6 bulan terakhir)</label>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="obat_cacing" value="1" id="obat_cacing">
                        <label class="form-check-label" for="obat_cacing">Dapat Obat Cacing (6 bulan terakhir)</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pola Makan</label>
                        <select name="pola_makan" class="form-select">
                            <option value="">-- Pilih Pola Makan --</option>
                            <option value="ASI Eksklusif">ASI Eksklusif</option>
                            <option value="ASI+MPASI">ASI + MPASI</option>
                            <option value="Sufor">Susu Formula (Sufor)</option>
                        </select>
                    </div>
                </div>

                <!-- Tahap 7: Swamedikasi -->
                <div class="wizard-step" id="step7">
                    <h4 class="mb-4">Tahap 7: Catatan Swamedikasi</h4>
                    <p class="text-muted">Jika anak sakit, biasanya Ibu memberi apa? (Pilih satu/lebih)</p>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="ke_nakes" value="1" id="ke_nakes">
                        <label class="form-check-label" for="ke_nakes">Dibawa ke Nakes/Bidan</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="obat_modern" value="1" id="obat_modern">
                        <label class="form-check-label" for="obat_modern">Diberi Obat Modern (beli di Warung/Apotek)</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="antibiotik" value="1" id="antibiotik">
                        <label class="form-check-label" for="antibiotik">Diberi Antibiotik (sisa resep/beli sendiri)</label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="etnomedisin" value="1" id="etnomedisin">
                        <label class="form-check-label" for="etnomedisin">Diberi Ramuan Etnomedisin/Jamu</label>
                    </div>
                </div>

                        <!-- Navigation Buttons -->
                        <div class="wizard-navigation mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display:none;">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                                Lanjut <i class="ti ti-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">
                                <i class="ti ti-check"></i> Simpan Data
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
let currentStep = 1;
const totalSteps = 7;

function changeStep(direction) {
    const currentStepEl = document.getElementById(`step${currentStep}`);
    
    if (direction === 1 && !validateStep(currentStep)) {
        return;
    }
    
    currentStepEl.classList.remove('active');
    currentStep += direction;
    
    const nextStepEl = document.getElementById(`step${currentStep}`);
    nextStepEl.classList.add('active');
    
    updateProgress();
    updateButtons();
}

function validateStep(step) {
    const stepEl = document.getElementById(`step${step}`);
    const inputs = stepEl.querySelectorAll('input[required], select[required]');
    
    for (let input of inputs) {
        if (!input.value) {
            alert('Mohon lengkapi semua field yang wajib diisi');
            input.focus();
            return false;
        }
    }
    return true;
}

function updateProgress() {
    const progress = (currentStep / totalSteps) * 100;
    const progressBar = document.getElementById('wizardProgress');
    progressBar.style.width = progress + '%';
    progressBar.textContent = `Tahap ${currentStep} dari ${totalSteps}`;
}

function updateButtons() {
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    
    prevBtn.style.display = currentStep === 1 ? 'none' : 'inline-block';
    nextBtn.style.display = currentStep === totalSteps ? 'none' : 'inline-block';
    submitBtn.style.display = currentStep === totalSteps ? 'inline-block' : 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    updateButtons();
});
</script>
<?= $this->endSection() ?>
