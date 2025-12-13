<?= $this->extend('layouts/app') ?>
<?= $this->section('content') ?>

<style>
.login-wrapper {
    min-height: 80vh;
    display: flex;
    align-items: center;
    background: #f5f5f5;
    padding: 40px 15px;
    overflow-x: hidden;
}
.login-card {
    border: none;
    border-radius: 0;
    overflow: hidden;
}
.login-header {
    background: #047d78;
    padding: 40px 30px;
    text-align: center;
    border-bottom: 4px solid #036663;
}
.login-body {
    padding: 40px 30px;
    background: #fff;
}
.form-control {
    border-radius: 0;
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
    transition: all 0.3s;
}
.form-control:focus {
    border-color: #047d78;
    box-shadow: none;
    border-width: 2px;
}
.form-control.is-invalid {
    border-color: #dc3545;
}
.btn-login {
    padding: 12px;
    border-radius: 0;
    font-weight: 600;
    background: #047d78;
    border: none;
    transition: all 0.3s;
}
.btn-login:hover {
    background: #036663;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(4, 125, 120, 0.3);
}
.input-group-text {
    border-radius: 0;
    border-left: 0;
    background: white;
    cursor: pointer;
    border: 1px solid #e0e0e0;
    transition: all 0.3s;
}
.input-group:focus-within .input-group-text {
    border-color: #047d78;
    border-width: 2px;
}
.login-link {
    color: #047d78;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
}
.login-link:hover {
    color: #036663;
}
</style>

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="card login-card shadow">
                    <div class="login-header">
                        <img src="<?= base_url('assets/images/logos/E-Asfarm-Logo.png'); ?>" alt="E-Asfarm" style="height: 50px; margin-bottom: 20px;">
                        <h3 class="text-white mb-2 fw-bold">Selamat Datang</h3>
                        <p class="text-white mb-0" style="opacity: 0.9;">Silakan login ke E-Asfarm</p>
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
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="/" class="login-link"><i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda</a>
                            <a href="#" class="login-link" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">
                                <i class="fas fa-key me-1"></i>Lupa Password?
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <p class="text-muted small"><i class="fas fa-shield-alt me-2"></i>Login Anda dilindungi dengan enkripsi</p>
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

<!-- Modal Lupa Password -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 0;">
            <div class="modal-header" style="background: #047d78; border: none;">
                <h5 class="modal-title text-white">Lupa Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <i class="fas fa-user-cog" style="font-size: 3rem; color: #047d78; margin-bottom: 20px;"></i>
                <p class="mb-3">Untuk reset password, silakan hubungi:</p>
                <h6 class="fw-bold" style="color: #047d78;">Teknisi Website</h6>
                <p class="mb-2">Aizan Syalim</p>
                <a href="https://wa.me/6282255693035" target="_blank" class="btn btn-login w-100 mt-3">
                    Hubungi via WhatsApp
                </a>
                <p class="text-muted small mt-3 mb-0">082255693035</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>