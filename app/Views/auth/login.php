<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
.login-wrapper {
    min-height: 80vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    margin: -20px -15px;
    padding: 40px 15px;
}
.login-card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
}
.login-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 30px;
    text-align: center;
}
.login-body {
    padding: 40px 30px;
}
.form-control {
    border-radius: 8px;
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
}
.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}
.form-control.is-invalid {
    border-color: #dc3545;
}
.btn-login {
    padding: 12px;
    border-radius: 8px;
    font-weight: 600;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}
.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
}
.input-group-text {
    border-radius: 0 8px 8px 0;
    border-left: 0;
    background: white;
    cursor: pointer;
}
</style>

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="card login-card shadow-lg">
                    <div class="login-header">
                        <h3 class="text-white mb-2">Selamat Datang</h3>
                        <p class="text-white-50 mb-0">Silakan login ke E-Asfarm</p>
                    </div>
                    
                    <div class="login-body">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?= session()->getFlashdata('success') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="/auth/login" method="post" id="loginForm" novalidate>
                            <?= csrf_field() ?>
                            
                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">Email / Nomor HP</label>
                                <input type="text" class="form-control" id="email" name="email" 
                                       placeholder="nama@email.com atau 08xxxxxxxxxx" required>
                                <small class="text-muted"><i class="fas fa-info-circle"></i> Anda dapat login menggunakan email atau nomor HP</small>
                                <div class="invalid-feedback">Email atau nomor HP harus diisi</div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Masukkan password" required minlength="6">
                                    <span class="input-group-text" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                                <div class="invalid-feedback">Password harus diisi minimal 6 karakter</div>
                            </div>
                            
                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-login">Masuk</button>
                            </div>
                        </form>
                        
                        <div class="text-center mt-4">
                            <a href="/" class="text-decoration-none">← Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-white small">Login Anda dilindungi dengan enkripsi</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});

// Form validation
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const form = this;
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    let isValid = true;
    
    // Reset validation
    email.classList.remove('is-invalid');
    password.classList.remove('is-invalid');
    
    // Validate email or phone
    if (!email.value.trim()) {
        email.classList.add('is-invalid');
        isValid = false;
    }
    
    // Validate password
    if (!password.value.trim() || password.value.length < 6) {
        password.classList.add('is-invalid');
        isValid = false;
    }
    
    if (!isValid) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    form.classList.add('was-validated');
});

// Real-time validation
document.getElementById('email').addEventListener('input', function() {
    if (this.value.trim()) {
        this.classList.remove('is-invalid');
    }
});

document.getElementById('password').addEventListener('input', function() {
    if (this.value.length >= 6) {
        this.classList.remove('is-invalid');
    }
});
</script>

<?= $this->endSection() ?>