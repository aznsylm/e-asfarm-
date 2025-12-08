const baseUrl = window.location.origin;

// PENGGUNA
$('#formPengguna').on('submit', function(e) {
    e.preventDefault();
    
    // Clear previous errors
    $('.error-message').hide().text('');
    $('.form-control, .form-select').removeClass('is-invalid');
    
    let hasError = false;
    const id = $('#penggunaId').val();
    
    // Validate username
    const username = $('#usernameInput').val().trim();
    if (!username) {
        $('#error-username').text('Username wajib diisi').show();
        $('#usernameInput').addClass('is-invalid');
        hasError = true;
    } else if (username.length < 3) {
        $('#error-username').text('Username minimal 3 karakter').show();
        $('#usernameInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate email
    const email = $('#emailInput').val().trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email) {
        $('#error-email').text('Email wajib diisi').show();
        $('#emailInput').addClass('is-invalid');
        hasError = true;
    } else if (!emailRegex.test(email)) {
        $('#error-email').text('Format email tidak valid').show();
        $('#emailInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate password (only for new user or when reset is checked)
    if (!id) {
        const password = $('#password').val();
        if (!password) {
            $('#error-password').text('Password wajib diisi').show();
            $('#password').addClass('is-invalid');
            hasError = true;
        } else if (password.length < 8) {
            $('#error-password').text('Password minimal 8 karakter').show();
            $('#password').addClass('is-invalid');
            hasError = true;
        }
    } else if ($('#resetPasswordCheck').is(':checked')) {
        const passwordEdit = $('#password_edit').val();
        if (!passwordEdit) {
            $('#error-password-edit').text('Password baru wajib diisi').show();
            $('#password_edit').addClass('is-invalid');
            hasError = true;
        } else if (passwordEdit.length < 8) {
            $('#error-password-edit').text('Password minimal 8 karakter').show();
            $('#password_edit').addClass('is-invalid');
            hasError = true;
        }
    }
    
    // Validate phone number
    const phone = $('#phone_number').val().trim();
    if (!phone) {
        $('#error-phone_number').text('Nomor WhatsApp wajib diisi').show();
        $('#phone_number').addClass('is-invalid');
        hasError = true;
    } else if (!phone.startsWith('08')) {
        $('#error-phone_number').text('Nomor harus dimulai dengan 08').show();
        $('#phone_number').addClass('is-invalid');
        hasError = true;
    } else if (phone.length < 10 || phone.length > 15) {
        $('#error-phone_number').text('Nomor harus 10-15 digit').show();
        $('#phone_number').addClass('is-invalid');
        hasError = true;
    }
    
    if (hasError) {
        return false;
    }
    
    const url = id ? `${baseUrl}/admin/pengguna/ubah/${id}` : `${baseUrl}/admin/pengguna/tambah`;
    
    $.ajax({
        url: url,
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(res) {
            if(res.success) {
                alert(res.message);
                location.reload();
            } else {
                if (res.errors) {
                    Object.keys(res.errors).forEach(field => {
                        const errorDiv = $(`#error-${field}`);
                        if (errorDiv.length) {
                            errorDiv.text('' + res.errors[field]).show();
                            $(`[name="${field}"]`).addClass('is-invalid');
                        }
                    });
                } else {
                    alert(res.message);
                }
            }
        },
        error: function() {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
});

function editPengguna(id) {
    const user = dataUsers.find(u => u.id == id);
    $('#titlePengguna').text('Edit Pengguna');
    $('#penggunaId').val(user.id);
    $('[name="username"]').val(user.username);
    $('[name="email"]').val(user.email);
    $('#phone_number').val(user.phone_number);
    $('#padukuhan_id').val(user.padukuhan_id);
    if ($('[name="role"]').length) {
        $('[name="role"]').val(user.role);
    }
    
    // Hide add password field, show edit password field
    $('#passwordFieldAdd').hide();
    $('#password').attr('disabled', true).removeAttr('required');
    
    $('#passwordFieldEdit').show();
    $('#password_edit').attr('disabled', false);
    $('#resetPasswordCheck').prop('checked', false);
    $('#passwordResetField').hide();
    $('#password_edit').removeAttr('required').val('');
    
    $('#modalPengguna').modal('show');
}

function hapusPengguna(id) {
    if(confirm('Yakin hapus pengguna ini?')) {
        $.post(`${baseUrl}/admin/pengguna/hapus/${id}`, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

// ARTIKEL
$('#formArtikel').on('submit', function(e) {
    e.preventDefault();
    
    // Clear previous errors
    $('.error-message').hide().text('');
    $('.form-control, .form-select').removeClass('is-invalid');
    
    // Sync CKEditor content
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
        CKEDITOR.instances.contentArtikel.updateElement();
    }
    
    // Client-side validation
    let hasError = false;
    
    // Validate title
    const title = $('#titleInput').val().trim();
    if (!title) {
        $('#error-title').text('Judul artikel wajib diisi').show();
        $('#titleInput').addClass('is-invalid');
        hasError = true;
    } else if (title.length < 10) {
        $('#error-title').text('Judul minimal 10 karakter').show();
        $('#titleInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate category
    const category = $('#categoryInput').val();
    if (!category) {
        $('#error-category').text('Kategori wajib dipilih').show();
        $('#categoryInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate content
    const content = CKEDITOR.instances.contentArtikel ? CKEDITOR.instances.contentArtikel.getData().trim() : $('#contentArtikel').val().trim();
    if (!content || content === '') {
        $('#error-content').text('Konten artikel wajib diisi').show();
        hasError = true;
    } else if (content.length < 50) {
        $('#error-content').text('Konten minimal 50 karakter').show();
        hasError = true;
    }
    
    // Validate image (only for new article)
    const id = $('#artikelId').val();
    const imageFile = $('#imageArtikel')[0].files[0];
    if (!id && !imageFile) {
        $('#error-image').text('Gambar artikel wajib diupload').show();
        $('#imageArtikel').addClass('is-invalid');
        hasError = true;
    } else if (imageFile) {
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(imageFile.type)) {
            $('#error-image').text('Format gambar harus JPG, PNG, atau WEBP').show();
            $('#imageArtikel').addClass('is-invalid');
            hasError = true;
        } else if (imageFile.size > 2 * 1024 * 1024) {
            $('#error-image').text('Ukuran gambar maksimal 2MB').show();
            $('#imageArtikel').addClass('is-invalid');
            hasError = true;
        }
    }
    
    if (hasError) {
        return false;
    }
    
    const url = id ? `${baseUrl}/admin/artikel/ubah/${id}` : `${baseUrl}/admin/artikel/tambah`;
    
    $.ajax({
        url: url,
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(res) {
            if(res.success) {
                alert(res.message);
                location.reload();
            } else {
                // Display server-side errors
                if (res.errors) {
                    Object.keys(res.errors).forEach(field => {
                        const errorDiv = $(`#error-${field}`);
                        if (errorDiv.length) {
                            errorDiv.text('' + res.errors[field]).show();
                            $(`[name="${field}"]`).addClass('is-invalid');
                        }
                    });
                } else {
                    alert(res.message);
                }
            }
        },
        error: function() {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
});

function editArtikel(id) {
    const article = dataArticles.find(a => a.id == id);
    $('#titleArtikel').text('Edit Artikel');
    $('#artikelId').val(article.id);
    $('[name="title"]').val(article.title);
    $('[name="category"]').val(article.category);
    
    // Set CKEditor content
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
        CKEDITOR.instances.contentArtikel.setData(article.content || '');
    } else {
        $('[name="content"]').val(article.content);
    }
    
    $('#imageArtikel').removeAttr('required');
    $('#modalArtikel').modal('show');
}

function hapusArtikel(id) {
    if(confirm('Yakin hapus artikel ini?')) {
        $.post(`${baseUrl}/admin/artikel/hapus/${id}`, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

function setujuiArtikel(id) {
    if(confirm('Setujui artikel ini?')) {
        $.post(`${baseUrl}/admin/artikel/setujui/${id}`, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

function tolakArtikel(id) {
    if(confirm('Tolak artikel ini?')) {
        $.post(`${baseUrl}/admin/artikel/tolak/${id}`, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

function previewArtikel(id) {
    const article = dataArticles.find(a => a.id == id);
    if (!article) return;
    
    $('#previewArtikelId').val(article.id);
    $('#previewTitle').text(article.title);
    $('#previewCategory').text(article.category);
    $('#previewAuthor').text(article.author_name);
    $('#previewContent').html(article.content);
    
    const status = article.status || 'pending';
    $('#previewStatus').val(status);
    
    const statusText = {
        'pending': 'Menunggu Persetujuan',
        'approved': 'Disetujui',
        'rejected': 'Ditolak'
    };
    const statusClass = {
        'pending': 'bg-warning',
        'approved': 'bg-success',
        'rejected': 'bg-danger'
    };
    $('#previewStatusBadge').text(statusText[status]).attr('class', 'badge fs-6 ' + statusClass[status]);
    
    const date = article.created_at ? new Date(article.created_at).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-';
    $('#previewDate').text(date);
    
    const imgPath = article.image.includes('uploads/articles/') ? article.image : 'uploads/articles/' + article.image;
    $('#previewImage').attr('src', `${baseUrl}/${imgPath}`);
    
    $('#modalPreviewArtikel').modal('show');
}

function updateStatusArtikel() {
    const id = $('#previewArtikelId').val();
    const status = $('#previewStatus').val();
    
    const statusText = {
        'pending': 'Pending (Menunggu Review)',
        'approved': 'Approved (Publish ke Publik)',
        'rejected': 'Rejected (Tidak Disetujui)'
    };
    
    if(confirm(`Ubah status artikel menjadi ${statusText[status]}?`)) {
        $.post(`${baseUrl}/admin/artikel/update-status/${id}`, {status: status}, function(res) {
            alert(res.message);
            if(res.success) {
                $('#modalPreviewArtikel').modal('hide');
                location.reload();
            }
        });
    }
}

function quickApprove() {
    $('#previewStatus').val('approved');
    updateStatusArtikel();
}

function quickPending() {
    $('#previewStatus').val('pending');
    updateStatusArtikel();
}

function quickReject() {
    $('#previewStatus').val('rejected');
    updateStatusArtikel();
}

function editArtikelFromPreview() {
    const id = $('#previewArtikelId').val();
    $('#modalPreviewArtikel').modal('hide');
    setTimeout(() => editArtikel(id), 300);
}

function hapusArtikelFromPreview() {
    const id = $('#previewArtikelId').val();
    $('#modalPreviewArtikel').modal('hide');
    setTimeout(() => hapusArtikel(id), 300);
}

// FAQ
$('#formFaq').on('submit', function(e) {
    e.preventDefault();
    
    // Clear previous errors
    $('.error-message').hide().text('');
    $('.form-control, .form-select').removeClass('is-invalid');
    
    // Sync CKEditor content
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.jawabanFaq) {
        CKEDITOR.instances.jawabanFaq.updateElement();
    }
    
    let hasError = false;
    
    // Validate category
    const category = $('#faqCategoryInput').val();
    if (!category) {
        $('#error-faq-category').text('Kategori wajib dipilih').show();
        $('#faqCategoryInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate pertanyaan
    const pertanyaan = $('#pertanyaanInput').val().trim();
    if (!pertanyaan) {
        $('#error-pertanyaan').text('Pertanyaan wajib diisi').show();
        $('#pertanyaanInput').addClass('is-invalid');
        hasError = true;
    } else if (pertanyaan.length < 10) {
        $('#error-pertanyaan').text('Pertanyaan minimal 10 karakter').show();
        $('#pertanyaanInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate jawaban
    const jawaban = CKEDITOR.instances.jawabanFaq ? CKEDITOR.instances.jawabanFaq.getData().trim() : $('#jawabanFaq').val().trim();
    if (!jawaban || jawaban === '') {
        $('#error-jawaban').text('Jawaban wajib diisi').show();
        hasError = true;
    } else if (jawaban.length < 20) {
        $('#error-jawaban').text('Jawaban minimal 20 karakter').show();
        hasError = true;
    }
    
    if (hasError) {
        return false;
    }
    
    const id = $('#faqId').val();
    const url = id ? `${baseUrl}/admin/faq/ubah/${id}` : `${baseUrl}/admin/faq/tambah`;
    
    $.post(url, $(this).serialize(), function(res) {
        if(res.success) {
            alert(res.message);
            location.reload();
        } else {
            if (res.errors) {
                Object.keys(res.errors).forEach(field => {
                    const errorDiv = field === 'category' ? $('#error-faq-category') : $(`#error-${field}`);
                    if (errorDiv.length) {
                        errorDiv.text('' + res.errors[field]).show();
                        $(`[name="${field}"]`).addClass('is-invalid');
                    }
                });
            } else {
                alert(res.message);
            }
        }
    });
});

function editFaq(id) {
    const faq = dataFaqs.find(f => f.id == id);
    $('#titleFaq').text('Edit FAQ');
    $('#faqId').val(faq.id);
    $('#formFaq [name="category"]').val(faq.category);
    $('[name="pertanyaan"]').val(faq.pertanyaan);
    
    // Set CKEditor content
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.jawabanFaq) {
        CKEDITOR.instances.jawabanFaq.setData(faq.jawaban || '');
    } else {
        $('[name="jawaban"]').val(faq.jawaban);
    }
    
    $('#modalFaq').modal('show');
}

function hapusFaq(id) {
    if(confirm('Yakin hapus FAQ ini?')) {
        $.post(`${baseUrl}/admin/faq/hapus/${id}`, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

// UNDUHAN
$('#formUnduhan').on('submit', function(e) {
    e.preventDefault();
    
    // Clear previous errors
    $('.error-message').hide().text('');
    $('.form-control, .form-select').removeClass('is-invalid');
    
    let hasError = false;
    const id = $('#unduhanId').val();
    
    // Validate title
    const title = $('#unduhanTitleInput').val().trim();
    if (!title) {
        $('#error-unduhan-title').text('Judul wajib diisi').show();
        $('#unduhanTitleInput').addClass('is-invalid');
        hasError = true;
    } else if (title.length < 5) {
        $('#error-unduhan-title').text('Judul minimal 5 karakter').show();
        $('#unduhanTitleInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate category
    const category = $('#unduhanCategoryInput').val();
    if (!category) {
        $('#error-unduhan-category').text('Kategori wajib dipilih').show();
        $('#unduhanCategoryInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate link drive
    const linkDrive = $('#linkDriveInput').val().trim();
    if (!linkDrive) {
        $('#error-link_drive').text('Link Google Drive wajib diisi').show();
        $('#linkDriveInput').addClass('is-invalid');
        hasError = true;
    } else if (!linkDrive.includes('drive.google.com')) {
        $('#error-link_drive').text('Link harus dari Google Drive').show();
        $('#linkDriveInput').addClass('is-invalid');
        hasError = true;
    }
    
    // Validate thumbnail (only for new upload)
    const thumbnailFile = $('#thumbnailUnduhan')[0].files[0];
    if (!id && !thumbnailFile) {
        $('#error-thumbnail').text('Thumbnail wajib diupload').show();
        $('#thumbnailUnduhan').addClass('is-invalid');
        hasError = true;
    } else if (thumbnailFile) {
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(thumbnailFile.type)) {
            $('#error-thumbnail').text('Format gambar harus JPG, PNG, atau WEBP').show();
            $('#thumbnailUnduhan').addClass('is-invalid');
            hasError = true;
        } else if (thumbnailFile.size > 2 * 1024 * 1024) {
            $('#error-thumbnail').text('Ukuran gambar maksimal 2MB').show();
            $('#thumbnailUnduhan').addClass('is-invalid');
            hasError = true;
        }
    }
    
    if (hasError) {
        return false;
    }
    
    const url = id ? `${baseUrl}/admin/unduhan/ubah/${id}` : `${baseUrl}/admin/unduhan/tambah`;
    
    $.ajax({
        url: url,
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(res) {
            if(res.success) {
                alert(res.message);
                location.reload();
            } else {
                if (res.errors) {
                    Object.keys(res.errors).forEach(field => {
                        const errorDiv = field === 'title' ? $('#error-unduhan-title') : 
                                       field === 'category' ? $('#error-unduhan-category') : 
                                       $(`#error-${field}`);
                        if (errorDiv.length) {
                            errorDiv.text('' + res.errors[field]).show();
                            $(`[name="${field}"]`).addClass('is-invalid');
                        }
                    });
                } else {
                    alert(res.message);
                }
            }
        },
        error: function() {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        }
    });
});

function editUnduhan(id) {
    const download = dataDownloads.find(d => d.id == id);
    $('#titleUnduhan').text('Edit Unduhan');
    $('#unduhanId').val(download.id);
    $('[name="title"]').val(download.title);
    $('[name="category"]').val(download.category);
    $('[name="link_drive"]').val(download.link_drive);
    $('#thumbnailUnduhan').removeAttr('required');
    $('#modalUnduhan').modal('show');
}

function hapusUnduhan(id) {
    if(confirm('Yakin hapus unduhan ini?')) {
        $.post(`${baseUrl}/admin/unduhan/hapus/${id}`, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

// Reset modal
$('.modal').on('hidden.bs.modal', function() {
    $(this).find('form')[0].reset();
    $(this).find('[type="hidden"]').val('');
    $(this).find('.modal-title').text($(this).find('.modal-title').text().replace('Edit', 'Tambah'));
    $(this).find('[type="file"]').attr('required', 'required');
    
    // Clear error messages
    $('.error-message').hide().text('');
    $('.form-control, .form-select').removeClass('is-invalid');
    
    // Reset CKEditor
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
        CKEDITOR.instances.contentArtikel.setData('');
    }
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.jawabanFaq) {
        CKEDITOR.instances.jawabanFaq.setData('');
    }
    
    // Reset password fields
    $('#passwordFieldAdd').show();
    $('#password').attr('disabled', false).attr('required', 'required');
    
    $('#passwordFieldEdit').hide();
    $('#password_edit').attr('disabled', true).removeAttr('required');
    $('#resetPasswordCheck').prop('checked', false);
    $('#passwordResetField').hide();
});

// Clear error on input change - Artikel
$('#titleInput, #categoryInput, #imageArtikel').on('change input', function() {
    const fieldName = $(this).attr('name');
    $(`#error-${fieldName}`).hide().text('');
    $(this).removeClass('is-invalid');
});

// Clear error on input change - Pengguna
$('#usernameInput, #emailInput, #password, #password_edit, #phone_number').on('change input', function() {
    const fieldName = $(this).attr('name');
    const errorId = this.id === 'password_edit' ? 'error-password-edit' : `error-${fieldName}`;
    $(`#${errorId}`).hide().text('');
    $(this).removeClass('is-invalid');
});

// Clear error on input change - FAQ
$('#faqCategoryInput, #pertanyaanInput').on('change input', function() {
    const fieldName = $(this).attr('name');
    const errorId = fieldName === 'category' ? 'error-faq-category' : `error-${fieldName}`;
    $(`#${errorId}`).hide().text('');
    $(this).removeClass('is-invalid');
});

// Clear error on input change - Unduhan
$('#unduhanTitleInput, #unduhanCategoryInput, #linkDriveInput, #thumbnailUnduhan').on('change input', function() {
    const fieldName = $(this).attr('name');
    const errorId = fieldName === 'title' ? 'error-unduhan-title' : 
                   fieldName === 'category' ? 'error-unduhan-category' : 
                   `error-${fieldName}`;
    $(`#${errorId}`).hide().text('');
    $(this).removeClass('is-invalid');
});
