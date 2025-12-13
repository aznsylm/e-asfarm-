<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/monitoring.css') ?>">

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/remaja') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <!-- Progress Bar -->
                    <div class="wizard-progress mb-4">
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar" id="wizardProgress" role="progressbar" style="width: 14%;">
                                Tahap 1 dari 7
                            </div>
                        </div>
                    </div>

                    <!-- Form Wizard -->
                    <form id="monitoringForm" method="POST" action="<?= base_url('admin/monitoring/remaja/store') ?>" novalidate>
                        <?= csrf_field() ?>

                        <!-- Step 1: Data Identitas -->
                        <div class="wizard-step active" id="step1">
                            <h4 class="mb-4">Tahap 1: Data Identitas</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pilih Pasien *</label>
                                    <select name="user_id" class="form-select" required>
                                        <option value="">-- Pilih Pasien --</option>
                                        <?php foreach($users as $user): ?>
                                            <option value="<?= $user['id'] ?>" <?= $selectedUserId == $user['id'] ? 'selected' : '' ?>>
                                                <?= esc($user['full_name']) ?> (<?= esc($user['username']) ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Siti Nurhaliza" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK</label>
                                    <input type="text" name="nik" class="form-control" maxlength="16" placeholder="Contoh: 3404012005010001">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal Lahir *</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Jenis Kelamin *</label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_l" value="L" required>
                                            <label class="form-check-label" for="jk_l">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_p" value="P" required>
                                            <label class="form-check-label" for="jk_p">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Wali *</label>
                                    <input type="text" name="nama_wali" class="form-control" placeholder="Contoh: Budi Santoso" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">No. HP Wali *</label>
                                    <input type="tel" name="no_hp_wali" class="form-control" placeholder="Contoh: 081234567890" required>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Antropometri -->
                        <div class="wizard-step" id="step2">
                            <h4 class="mb-4">Tahap 2: Data Antropometri</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Berat Badan (kg) *</label>
                                    <input type="number" name="berat_badan" class="form-control" step="0.1" min="20" max="150" placeholder="Contoh: 45.5" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tinggi Badan (cm) *</label>
                                    <input type="number" name="tinggi_badan" class="form-control" step="0.1" min="100" max="200" placeholder="Contoh: 155.0" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lingkar Perut (cm) *</label>
                                    <input type="number" name="lingkar_perut" class="form-control" step="0.1" min="40" max="150" placeholder="Contoh: 65.0" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tekanan Darah *</label>
                                    <input type="text" name="tekanan_darah" class="form-control" placeholder="Contoh: 120/80" required>
                                    <small class="text-muted">Format: Sistolik/Diastolik</small>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Skrining Anemia -->
                        <div class="wizard-step" id="step3">
                            <h4 class="mb-4">Tahap 3: Skrining Anemia</h4>
                            <p class="text-muted">Pilih gejala anemia yang dialami (bisa lebih dari satu)</p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Pucat" id="a1">
                                        <label class="form-check-label" for="a1">Pucat (5P: Pucat di mata, muka, mulut, telapak tangan, pinggir kuku)</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="5L" id="a2">
                                        <label class="form-check-label" for="a2">5L (Letih, Lemah, Lesu, Lelah, Lunglai)</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Pusing" id="a3">
                                        <label class="form-check-label" for="a3">Pusing</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Sulit Konsentrasi" id="a4">
                                        <label class="form-check-label" for="a4">Sulit Konsentrasi</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Tidak Ada" id="a5">
                                        <label class="form-check-label" for="a5">Tidak Ada Gejala</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Riwayat Haid (Conditional) -->
                        <div class="wizard-step" id="step4">
                            <h4 class="mb-4">Tahap 4: Riwayat Haid</h4>
                            <div id="haidSection" style="display:none;">
                                <p class="text-muted">Khusus untuk remaja perempuan</p>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Sudah Menstruasi?</label>
                                        <select name="sudah_menstruasi" id="sudah_menstruasi" class="form-select">
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Keteraturan Haid</label>
                                        <select name="keteraturan_haid" id="keteraturan_haid" class="form-select">
                                            <option value="Teratur">Teratur</option>
                                            <option value="Tidak Teratur">Tidak Teratur</option>
                                            <option value="Belum Menstruasi">Belum Menstruasi</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nyeri Haid?</label>
                                        <select name="nyeri_haid" id="nyeri_haid" class="form-select">
                                            <option value="Ya">Ya</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="haidSkipMessage">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Tahap ini khusus untuk remaja perempuan. Silakan lanjut ke tahap berikutnya.
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Gaya Hidup -->
                        <div class="wizard-step" id="step5">
                            <h4 class="mb-4">Tahap 5: Gaya Hidup & Risiko PTM</h4>
                            <p class="text-muted">Pilih perilaku berisiko yang dilakukan (bisa lebih dari satu)</p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Merokok" id="r1">
                                        <label class="form-check-label" for="r1">Merokok</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Kurang Aktivitas Fisik" id="r2">
                                        <label class="form-check-label" for="r2">Kurang Aktivitas Fisik (Mager)</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Minum Manis" id="r3">
                                        <label class="form-check-label" for="r3">Sering Minum Minuman Manis</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Makan Asin" id="r4">
                                        <label class="form-check-label" for="r4">Sering Makan Makanan Asin</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Begadang" id="r5">
                                        <label class="form-check-label" for="r5">Sering Begadang</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Tidak Ada" id="r6">
                                        <label class="form-check-label" for="r6">Tidak Ada Perilaku Berisiko</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 6: Suplementasi -->
                        <div class="wizard-step" id="step6">
                            <h4 class="mb-4">Tahap 6: Suplementasi & Gizi</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Dapat TTD (Tablet Tambah Darah)?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="dapat_ttd" value="1" id="ttd1">
                                        <label class="form-check-label" for="ttd1">Ya, dapat TTD</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Minum TTD Rutin?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="minum_ttd" value="1" id="ttd2">
                                        <label class="form-check-label" for="ttd2">Ya, minum rutin</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kebiasaan Sarapan</label>
                                    <select name="kebiasaan_sarapan" class="form-select">
                                        <option value="Selalu">Selalu Sarapan</option>
                                        <option value="Sering">Sering Sarapan</option>
                                        <option value="Kadang-kadang">Kadang-kadang</option>
                                        <option value="Jarang">Jarang Sarapan</option>
                                        <option value="Tidak Pernah">Tidak Pernah Sarapan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Step 7: Swamedikasi -->
                        <div class="wizard-step" id="step7">
                            <h4 class="mb-4">Tahap 7: Perilaku Swamedikasi</h4>
                            <p class="text-muted">Jika sakit, biasanya melakukan apa? (bisa lebih dari satu)</p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Konsultasi Nakes" id="s1">
                                        <label class="form-check-label" for="s1">Konsultasi ke Tenaga Kesehatan</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Obat Modern" id="s2">
                                        <label class="form-check-label" for="s2">Beli Obat Modern (Apotek/Warung)</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Etnomedisin" id="s3">
                                        <label class="form-check-label" for="s3">Menggunakan Etnomedisin/Obat Tradisional</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Skincare" id="s4">
                                        <label class="form-check-label" for="s4">Menggunakan Skincare/Kosmetik</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Dibiarkan" id="s5">
                                        <label class="form-check-label" for="s5">Dibiarkan Saja</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="wizard-navigation mt-4">
                            <button type="button" class="btn btn-secondary" id="prevBtn" onclick="changeStep(-1)" style="display:none;">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn" onclick="changeStep(1)">
                                Lanjut <i class="fas fa-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success" id="submitBtn" style="display:none;">
                                <i class="fas fa-check"></i> Simpan Data
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
    // Skip validasi tahap 4 jika jenis kelamin laki-laki
    if (step === 4) {
        const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
        if (jenisKelamin && jenisKelamin.value === 'L') {
            return true;
        }
    }
    
    const stepEl = document.getElementById(`step${step}`);
    const inputs = stepEl.querySelectorAll('input[required], select[required], textarea[required]');
    
    for (let input of inputs) {
        if (!input.value && input.type !== 'radio' && input.type !== 'checkbox') {
            alert('Mohon lengkapi semua field yang wajib diisi');
            input.focus();
            return false;
        }
        
        if (input.type === 'radio') {
            const radioGroup = stepEl.querySelectorAll(`input[name="${input.name}"]`);
            let checked = false;
            radioGroup.forEach(radio => {
                if (radio.checked) checked = true;
            });
            if (!checked) {
                alert('Mohon pilih salah satu opsi');
                return false;
            }
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

// Conditional field untuk riwayat haid
document.addEventListener('DOMContentLoaded', function() {
    const jenisKelaminInputs = document.querySelectorAll('input[name="jenis_kelamin"]');
    const haidSection = document.getElementById('haidSection');
    const haidSkipMessage = document.getElementById('haidSkipMessage');
    
    jenisKelaminInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === 'P') {
                haidSection.style.display = 'block';
                haidSkipMessage.style.display = 'none';
            } else {
                haidSection.style.display = 'none';
                haidSkipMessage.style.display = 'block';
            }
        });
    });

    // Form submit handler
    const form = document.getElementById('monitoringForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Debug: pastikan tombol ada
    console.log('Submit button found:', submitBtn);
    
    // Tambahkan event listener langsung ke tombol
    submitBtn.addEventListener('click', function(e) {
        console.log('Submit button clicked!');
        // Tidak perlu preventDefault, biarkan form submit
    });
    
    form.addEventListener('submit', function(e) {
        console.log('Form submitting...');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    });
    
    updateButtons();
    
    // Debug: cek style tombol
    console.log('Submit button style:', window.getComputedStyle(submitBtn).display);
    console.log('Submit button disabled:', submitBtn.disabled);
    console.log('Submit button pointer-events:', window.getComputedStyle(submitBtn).pointerEvents);
});
</script>
<?= $this->endSection() ?>
