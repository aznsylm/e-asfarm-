<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/monitoring.css') ?>">

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Input Data Monitoring Kesehatan</h2>
            <p class="text-muted">Form Input 7 Tahap - Kesehatan Ibu Hamil dan Menyusui</p>
        </div>
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
                    <form id="monitoringForm" method="POST" action="<?= base_url('admin/monitoring/store') ?>">
                        <?= csrf_field() ?>

                        <!-- Step 1: Pilih Pasien & Data Identitas -->
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
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Ibu *</label>
                                    <input type="text" name="nama_ibu" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Suami *</label>
                                    <input type="text" name="nama_suami" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Usia Ibu (tahun) *</label>
                                    <input type="number" name="usia_ibu" class="form-control" min="15" max="50" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Usia Suami (tahun) *</label>
                                    <input type="number" name="usia_suami" class="form-control" min="18" max="70" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Alamat *</label>
                                    <textarea name="alamat" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nomor Telepon *</label>
                                    <input type="tel" name="nomor_telepon" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Usia Kehamilan (bulan) *</label>
                                    <input type="number" name="usia_kehamilan" class="form-control" min="1" max="9" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rencana Tanggal Persalinan *</label>
                                    <input type="date" name="rencana_tanggal_persalinan" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Data Antropometri -->
                        <div class="wizard-step" id="step2">
                            <h4 class="mb-4">Tahap 2: Data Antropometri</h4>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tekanan Darah (TD) *</label>
                                    <input type="text" name="tekanan_darah" class="form-control" placeholder="120/80" required>
                                    <small class="text-muted">Format: Sistolik/Diastolik (contoh: 120/80)</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Berat Badan (kg) *</label>
                                    <input type="number" name="berat_badan" class="form-control" step="0.1" min="30" max="150" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tinggi Badan (cm) *</label>
                                    <input type="number" name="tinggi_badan" class="form-control" step="0.1" min="130" max="200" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Lila - Lingkar Lengan Atas (cm) *</label>
                                    <input type="number" name="lila" class="form-control" step="0.1" min="15" max="50" required>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Keluhan & Gejala -->
                        <div class="wizard-step" id="step3">
                            <h4 class="mb-4">Tahap 3: Keluhan & Gejala</h4>
                            <p class="text-muted">Pilih keluhan yang dialami (bisa lebih dari satu)</p>
                            
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Mual/muntah berlebihan" id="k1">
                                        <label class="form-check-label" for="k1">Mual/muntah berlebihan</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Perdarahan sedikit/banyak" id="k2">
                                        <label class="form-check-label" for="k2">Perdarahan sedikit/banyak</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Gerakan janin" id="k3">
                                        <label class="form-check-label" for="k3">Gerakan janin</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Kaki bengkak" id="k4">
                                        <label class="form-check-label" for="k4">Kaki bengkak</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Sakit kepala hebat" id="k5">
                                        <label class="form-check-label" for="k5">Sakit kepala hebat</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Gangguan penglihatan" id="k6">
                                        <label class="form-check-label" for="k6">Gangguan penglihatan</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Lainnya" id="k7">
                                        <label class="form-check-label" for="k7">Lainnya</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="keluhan[]" value="Tidak ada keluhan" id="k8">
                                        <label class="form-check-label" for="k8">Tidak ada keluhan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php include 'input_steps.php'; ?>

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
<script src="<?= base_url('assets/js/monitoring-wizard.js') ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Loaded - Initializing form handler');
    
    const form = document.getElementById('monitoringForm');
    if (!form) {
        console.error('Form not found!');
        return;
    }
    
    console.log('Form found, attaching submit handler');
    
    form.addEventListener('submit', function(e) {
        console.log('Form submitted!');
        
        if (typeof validateStep === 'function' && !validateStep(currentStep)) {
            e.preventDefault();
            console.log('Validation failed');
            return false;
        }
        
        console.log('Validation passed, submitting...');
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="ti ti-loader"></i> Menyimpan...';
    });
});
</script>
<?= $this->endSection() ?>
