<!-- Modal Pengguna -->
<div class="modal fade" id="modalPengguna" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlePengguna">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="formPengguna">
                <input type="hidden" id="penggunaId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Username *</label>
                        <div class="error-message text-danger small mb-1" id="error-username" style="display:none;"></div>
                        <input type="text" class="form-control form-control-sm" name="username" id="usernameInput" placeholder="Masukkan username" required>
                        <small class="text-muted helper-text" id="helper-username" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 3 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label>Email *</label>
                        <div class="error-message text-danger small mb-1" id="error-email" style="display:none;"></div>
                        <input type="email" class="form-control form-control-sm" name="email" id="emailInput" placeholder="contoh@email.com" required>
                        <small class="text-muted helper-text" id="helper-email" style="display:none;"><i class="bi bi-info-circle"></i> Gunakan format email yang valid</small>
                    </div>
                    <div class="mb-3" id="passwordFieldAdd">
                        <label>Password *</label>
                        <div class="error-message text-danger small mb-1" id="error-password" style="display:none;"></div>
                        <div class="input-group input-group-sm">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                        <small class="text-muted helper-text" id="helper-password" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 8 karakter, kombinasi huruf dan angka</small>
                    </div>
                    <div class="mb-3" id="passwordFieldEdit" style="display:none;">
                        <div class="form-check mb-2">
                            <input type="checkbox" id="resetPasswordCheck" class="form-check-input" onchange="togglePasswordReset()">
                            <label class="form-check-label" for="resetPasswordCheck">
                                <i class="bi bi-key"></i> Reset Password
                            </label>
                        </div>
                        <div id="passwordResetField" style="display:none;">
                            <label>Password Baru *</label>
                            <div class="error-message text-danger small mb-1" id="error-password-edit" style="display:none;"></div>
                            <div class="input-group input-group-sm">
                                <input type="password" class="form-control" name="password" id="password_edit">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordEdit()">
                                    <i class="bi bi-eye" id="toggleIconEdit"></i>
                                </button>
                            </div>
                            <small class="text-muted helper-text" id="helper-password-edit" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 8 karakter, kombinasi huruf dan angka</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Nomor WhatsApp *</label>
                        <div class="error-message text-danger small mb-1" id="error-phone_number" style="display:none;"></div>
                        <input type="text" class="form-control form-control-sm" name="phone_number" id="phone_number" 
                               placeholder="08xxxxxxxxxx" pattern="^08[0-9]{8,13}$" maxlength="15" required>
                        <small class="text-muted helper-text" id="helper-phone" style="display:none;"><i class="bi bi-info-circle"></i> Harus dimulai dengan 08, minimal 10 digit, maksimal 15 digit</small>
                    </div>
                    <div class="mb-2">
                        <label>Padukuhan</label>
                        <?php if (session()->get('role') === 'admin'): ?>
                            <?php 
                            $padukuhanModel = new \App\Models\PadukuhanModel();
                            $currentPadukuhan = $padukuhanModel->find(session()->get('padukuhan_id'));
                            ?>
                            <p class="text-muted small mb-0 mt-1"><i class="bi bi-info-circle"></i> <em>Pengguna ini akan otomatis terdaftar di Padukuhan: <strong><?= esc($currentPadukuhan['nama_padukuhan']) ?></strong></em></p>
                            <input type="hidden" name="padukuhan_id" value="<?= session()->get('padukuhan_id') ?>">
                        <?php else: ?>
                            <div class="error-message text-danger small mb-1" id="error-padukuhan_id" style="display:none;"></div>
                            <select class="form-select form-select-sm" name="padukuhan_id" id="padukuhan_id" required>
                                <option value="">-- Pilih Padukuhan --</option>
                                <?php 
                                $padukuhanModel = new \App\Models\PadukuhanModel();
                                $padukuhanList = $padukuhanModel->findAll();
                                foreach($padukuhanList as $p): 
                                ?>
                                <option value="<?= $p['id'] ?>"><?= esc($p['nama_padukuhan']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted helper-text" id="helper-padukuhan" style="display:none;"><i class="bi bi-info-circle"></i> Pilih padukuhan untuk pengguna ini</small>
                        <?php endif; ?>
                    </div>
                    <?php if (session()->get('role') === 'superadmin'): ?>
                    <div class="mb-2">
                        <label>Role *</label>
                        <select class="form-select form-select-sm" name="role" required>
                            <option value="pengguna">Pengguna</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}

function setModalTitle(title) {
    document.getElementById('titlePengguna').textContent = title;
}

function togglePasswordEdit() {
    const passwordInput = document.getElementById('password_edit');
    const toggleIcon = document.getElementById('toggleIconEdit');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}

function togglePasswordReset() {
    const checkbox = document.getElementById('resetPasswordCheck');
    const passwordField = document.getElementById('passwordResetField');
    const passwordInput = document.getElementById('password_edit');
    
    if (checkbox.checked) {
        passwordField.style.display = 'block';
        passwordInput.required = true;
        passwordInput.disabled = false;
    } else {
        passwordField.style.display = 'none';
        passwordInput.required = false;
        passwordInput.disabled = true;
        passwordInput.value = '';
        $('#helper-password-edit').hide();
    }
}

// Phone number validation
document.addEventListener('DOMContentLoaded', function() {
    // Initialize password fields on page load
    $('#password').attr('disabled', false).attr('required', true);
    $('#password_edit').attr('disabled', true);
    
    const phoneInput = document.getElementById('phone_number');
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value;
            // Hanya angka
            value = value.replace(/[^0-9]/g, '');
            // Maksimal 15 digit
            if (value.length > 15) value = value.slice(0, 15);
            e.target.value = value;
            
            // Validasi format
            if (value.length > 0 && !value.startsWith('08')) {
                e.target.setCustomValidity('Nomor harus dimulai dengan 08');
            } else if (value.length > 0 && value.length < 10) {
                e.target.setCustomValidity('Nomor minimal 10 digit');
            } else {
                e.target.setCustomValidity('');
            }
        });
    }
    
    // Show/hide helper text on focus/blur
    $('#usernameInput').on('focus', function() {
        $('#helper-username').slideDown(200);
    }).on('blur', function() {
        $('#helper-username').slideUp(200);
    });
    
    $('#emailInput').on('focus', function() {
        $('#helper-email').slideDown(200);
    }).on('blur', function() {
        $('#helper-email').slideUp(200);
    });
    
    $('#password').on('focus', function() {
        $('#helper-password').slideDown(200);
    }).on('blur', function() {
        $('#helper-password').slideUp(200);
    });
    
    $('#password_edit').on('focus', function() {
        $('#helper-password-edit').slideDown(200);
    }).on('blur', function() {
        $('#helper-password-edit').slideUp(200);
    });
    
    $('#phone_number').on('focus', function() {
        $('#helper-phone').slideDown(200);
    }).on('blur', function() {
        $('#helper-phone').slideUp(200);
    });
    
    $('#padukuhan_id').on('focus', function() {
        $('#helper-padukuhan').slideDown(200);
    }).on('blur', function() {
        $('#helper-padukuhan').slideUp(200);
    });
    
    // Modal Artikel
    $('#titleInput').on('focus', function() {
        $('#helper-title').slideDown(200);
    }).on('blur', function() {
        $('#helper-title').slideUp(200);
    });
    
    $('#contentArtikel').on('focus', function() {
        $('#helper-content').slideDown(200);
    }).on('blur', function() {
        $('#helper-content').slideUp(200);
    });
    
    // Modal FAQ
    $('#pertanyaanInput').on('focus', function() {
        $('#helper-pertanyaan').slideDown(200);
    }).on('blur', function() {
        $('#helper-pertanyaan').slideUp(200);
    });
    
    $('#jawabanFaq').on('focus', function() {
        $('#helper-jawaban').slideDown(200);
    }).on('blur', function() {
        $('#helper-jawaban').slideUp(200);
    });
    
    // Modal Poster
    $('#posterTitleInput').on('focus', function() {
        $('#helper-poster-title').slideDown(200);
    }).on('blur', function() {
        $('#helper-poster-title').slideUp(200);
    });
    
    $('#linkDriveInput').on('focus', function() {
        $('#helper-link-drive').slideDown(200);
    }).on('blur', function() {
        $('#helper-link-drive').slideUp(200);
    });
    
    // Modal Modul
    $('#modulTitleInput').on('focus', function() {
        $('#helper-modul-title').slideDown(200);
    }).on('blur', function() {
        $('#helper-modul-title').slideUp(200);
    });
    
    $('#modulLinkDriveInput').on('focus', function() {
        $('#helper-modul-link-drive').slideDown(200);
    }).on('blur', function() {
        $('#helper-modul-link-drive').slideUp(200);
    });
});
</script>

<!-- Modal Artikel -->
<div class="modal fade" id="modalArtikel" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleArtikel">Tambah Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="formArtikel" enctype="multipart/form-data">
                <input type="hidden" id="artikelId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul *</label>
                        <div class="error-message text-danger small mb-1" id="error-title" style="display:none;"></div>
                        <input type="text" class="form-control form-control-sm" name="title" id="titleInput" placeholder="Masukkan judul artikel" required>
                        <small class="text-muted helper-text" id="helper-title" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 10 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label>Kategori * <small class="text-muted">(Pilih minimal 1)</small></label>
                        <div class="error-message text-danger small mb-1" id="error-category" style="display:none;"></div>
                        <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                            <?php 
                            $categoryModel = new \App\Models\CategoryModel();
                            $artikelCategories = $categoryModel->getByType('artikel');
                            foreach($artikelCategories as $cat): 
                            ?>
                            <div class="form-check">
                                <input class="form-check-input artikel-category-checkbox" type="checkbox" name="categories[]" value="<?= $cat['id'] ?>" id="artCat<?= $cat['id'] ?>">
                                <label class="form-check-label" for="artCat<?= $cat['id'] ?>"><?= esc($cat['name']) ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Konten *</label>
                        <div class="error-message text-danger small mb-1" id="error-content" style="display:none;"></div>
                        <textarea class="form-control form-control-sm" name="content" id="contentArtikel" rows="5" placeholder="Tulis konten artikel di sini..." required></textarea>
                        <small class="text-muted helper-text" id="helper-content" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 50 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label>Gambar * 
                            <i class="bi bi-question-circle text-primary" data-toggle="tooltip" data-placement="right" title="Format: JPG, JPEG, PNG, WEBP | Maksimal: 2MB | Resolusi disarankan: 1200x630px"></i>
                        </label>
                        <div class="error-message text-danger small mb-1" id="error-image" style="display:none;"></div>
                        <input type="file" class="form-control form-control-sm" name="image" id="imageArtikel" accept="image/jpeg,image/jpg,image/png,image/webp" required>
                        <small class="text-muted"><i class="bi bi-info-circle"></i> Format: JPG, PNG, WEBP | Max: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal FAQ -->
<div class="modal fade" id="modalFaq" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleFaq">Tambah FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="formFaq">
                <input type="hidden" id="faqId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kategori * <small class="text-muted">(Pilih minimal 1)</small></label>
                        <div class="error-message text-danger small mb-1" id="error-faq-category" style="display:none;"></div>
                        <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                            <?php 
                            $categoryModel = new \App\Models\CategoryModel();
                            $faqCategories = $categoryModel->getByType('tanya_jawab');
                            foreach($faqCategories as $cat): 
                            ?>
                            <div class="form-check">
                                <input class="form-check-input faq-category-checkbox" type="checkbox" name="categories[]" value="<?= $cat['id'] ?>" id="faqCat<?= $cat['id'] ?>">
                                <label class="form-check-label" for="faqCat<?= $cat['id'] ?>"><?= esc($cat['name']) ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Pertanyaan *</label>
                        <div class="error-message text-danger small mb-1" id="error-pertanyaan" style="display:none;"></div>
                        <textarea class="form-control form-control-sm" name="pertanyaan" id="pertanyaanInput" rows="3" placeholder="Tulis pertanyaan di sini..." required></textarea>
                        <small class="text-muted helper-text" id="helper-pertanyaan" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 10 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label>Jawaban *</label>
                        <div class="error-message text-danger small mb-1" id="error-jawaban" style="display:none;"></div>
                        <textarea class="form-control form-control-sm" name="jawaban" id="jawabanFaq" rows="5" placeholder="Tulis jawaban di sini..." required></textarea>
                        <small class="text-muted helper-text" id="helper-jawaban" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 20 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Preview Artikel -->
<div class="modal fade" id="modalPreviewArtikel" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Detail Artikel</h5>
                <button type="button" class="close text-white" data-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-lg-8 border-end">
                        <div class="p-4">
                            <img id="previewImage" class="img-fluid rounded shadow-sm mb-4" style="max-height: 400px; width: 100%; object-fit: cover;">
                            <div class="mb-3">
                                <span class="badge bg-info fs-6 me-2" id="previewCategory"></span>
                                <span class="badge bg-secondary fs-6" id="previewStatusBadge"></span>
                            </div>
                            <h2 class="fw-bold mb-3" id="previewTitle"></h2>
                            <div class="d-flex align-items-center text-muted mb-4">
                                <i class="bi bi-person-circle me-2"></i>
                                <span id="previewAuthor"></span>
                                <i class="bi bi-calendar3 ms-3 me-2"></i>
                                <span id="previewDate"></span>
                            </div>
                            <hr>
                            <div id="previewContent" class="article-content" style="line-height: 1.8; font-size: 1.05rem;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 bg-light">
                        <div class="p-4">
                            <input type="hidden" id="previewArtikelId">
                            <h6 class="fw-bold mb-3">Panel Kelola</h6>
                            
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-white">
                                    <h6 class="mb-0 fw-semibold">Ubah Status</h6>
                                </div>
                                <div class="card-body">
                                    <label class="form-label">Status</label>
                                    <select class="form-select mb-3" id="previewStatus">
                                        <option value="pending">Menunggu Persetujuan</option>
                                        <option value="approved">Terbitkan</option>
                                        <option value="rejected">Tolak</option>
                                    </select>
                                    <div class="d-grid">
                                        <button class="btn btn-primary" onclick="updateStatusArtikel()">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card shadow-sm">
                                <div class="card-header bg-white">
                                    <h6 class="mb-0 fw-semibold">Lainnya</h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-warning" onclick="editArtikelFromPreview()">
                                            Edit Artikel
                                        </button>
                                        <button class="btn btn-outline-danger" onclick="hapusArtikelFromPreview()">
                                            Hapus Artikel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Poster -->
<div class="modal fade" id="modalPoster" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlePoster">Tambah Poster</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="formPoster" enctype="multipart/form-data">
                <input type="hidden" id="posterId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul *</label>
                        <div class="error-message text-danger small mb-1" id="error-poster-title" style="display:none;"></div>
                        <input type="text" class="form-control form-control-sm" name="title" id="posterTitleInput" placeholder="Masukkan judul poster" required>
                        <small class="text-muted helper-text" id="helper-poster-title" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 5 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label>Kategori * <small class="text-muted">(Pilih minimal 1)</small></label>
                        <div class="error-message text-danger small mb-1" id="error-poster-category" style="display:none;"></div>
                        <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                            <?php 
                            $categoryModel = new \App\Models\CategoryModel();
                            $posterCategories = $categoryModel->getByType('poster');
                            foreach($posterCategories as $cat): 
                            ?>
                            <div class="form-check">
                                <input class="form-check-input poster-category-checkbox" type="checkbox" name="categories[]" value="<?= $cat['id'] ?>" id="postCat<?= $cat['id'] ?>">
                                <label class="form-check-label" for="postCat<?= $cat['id'] ?>"><?= esc($cat['name']) ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Link Google Drive *</label>
                        <div class="error-message text-danger small mb-1" id="error-link_drive" style="display:none;"></div>
                        <input type="url" class="form-control form-control-sm" name="link_drive" id="linkDriveInput" placeholder="https://drive.google.com/..." required>
                        <small class="text-muted helper-text" id="helper-link-drive" style="display:none;"><i class="bi bi-info-circle"></i> Harus berupa link dari Google Drive</small>
                    </div>
                    <div class="mb-3">
                        <label>Thumbnail *</label>
                        <div class="error-message text-danger small mb-1" id="error-thumbnail" style="display:none;"></div>
                        <input type="file" class="form-control form-control-sm" name="thumbnail" id="thumbnailPoster" accept="image/*" required>
                        <small class="text-muted"><i class="bi bi-info-circle"></i> Format: JPG, PNG, WEBP | Max: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modul -->
<div class="modal fade" id="modalModul" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleModul">Tambah Modul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form id="formModul" enctype="multipart/form-data">
                <input type="hidden" id="modulId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Judul *</label>
                        <div class="error-message text-danger small mb-1" id="error-modul-title" style="display:none;"></div>
                        <input type="text" class="form-control form-control-sm" name="title" id="modulTitleInput" placeholder="Masukkan judul modul" required>
                        <small class="text-muted helper-text" id="helper-modul-title" style="display:none;"><i class="bi bi-info-circle"></i> Minimal 5 karakter</small>
                    </div>
                    <div class="mb-3">
                        <label>Kategori * <small class="text-muted">(Pilih minimal 1)</small></label>
                        <div class="error-message text-danger small mb-1" id="error-modul-category" style="display:none;"></div>
                        <div class="border rounded p-2" style="max-height: 150px; overflow-y: auto;">
                            <?php 
                            $categoryModel = new \App\Models\CategoryModel();
                            $modulCategories = $categoryModel->getByType('modul');
                            foreach($modulCategories as $cat): 
                            ?>
                            <div class="form-check">
                                <input class="form-check-input modul-category-checkbox" type="checkbox" name="categories[]" value="<?= $cat['id'] ?>" id="modCat<?= $cat['id'] ?>">
                                <label class="form-check-label" for="modCat<?= $cat['id'] ?>"><?= esc($cat['name']) ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Link Google Drive *</label>
                        <div class="error-message text-danger small mb-1" id="error-modul-link_drive" style="display:none;"></div>
                        <input type="url" class="form-control form-control-sm" name="link_drive" id="modulLinkDriveInput" placeholder="https://drive.google.com/..." required>
                        <small class="text-muted helper-text" id="helper-modul-link-drive" style="display:none;"><i class="bi bi-info-circle"></i> Harus berupa link dari Google Drive</small>
                    </div>
                    <div class="mb-3">
                        <label>Thumbnail *</label>
                        <div class="error-message text-danger small mb-1" id="error-modul-thumbnail" style="display:none;"></div>
                        <input type="file" class="form-control form-control-sm" name="thumbnail" id="thumbnailModul" accept="image/*" required>
                        <small class="text-muted"><i class="bi bi-info-circle"></i> Format: JPG, PNG, WEBP | Max: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
const dataUsers = <?= json_encode($users) ?>;
const dataArticles = <?= json_encode($articles) ?>;
const dataFaqs = <?= json_encode($faqs) ?>;
const dataPosters = <?= json_encode($posters) ?>;

// Initialize CKEditor
if (document.getElementById('contentArtikel')) {
    CKEDITOR.replace('contentArtikel', {
        height: 300,
        removeButtons: 'Save,NewPage,Preview,Print,Templates,Cut,Copy,Paste,PasteText,PasteFromWord,Undo,Redo,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,Blockquote,BidiLtr,BidiRtl,Language,Unlink,Anchor,Image,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Maximize,ShowBlocks,About'
    });
}

if (document.getElementById('jawabanFaq')) {
    CKEDITOR.replace('jawabanFaq', {
        height: 250,
        removeButtons: 'Save,NewPage,Preview,Print,Templates'
    });
}

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
</script>

