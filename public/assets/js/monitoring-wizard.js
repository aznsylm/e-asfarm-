let currentStep = 1;
const totalSteps = 7;

function changeStep(direction) {
    const currentStepEl = document.getElementById(`step${currentStep}`);
    
    // Validate current step before moving forward
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

function toggleEtnomedisin(show) {
    const form = document.getElementById('etnomedisinForm');
    form.style.display = show ? 'block' : 'none';
}

function toggleLainnyaRiwayat(checkbox) {
    const input = document.getElementById('riwayatLainnya');
    input.style.display = checkbox.checked ? 'block' : 'none';
}

function toggleLainnyaObat(checkbox) {
    const input = document.getElementById('obatLainnya');
    input.style.display = checkbox.checked ? 'block' : 'none';
}

function toggleLainnyaTujuan(checkbox) {
    const input = document.getElementById('tujuanLainnya');
    input.style.display = checkbox.checked ? 'block' : 'none';
}


