const baseUrl = window.location.origin;

// PENGGUNA
$('#formPengguna').on('submit', function(e) {
    e.preventDefault();
    const id = $('#penggunaId').val();
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
                alert(res.errors ? Object.values(res.errors).join('\n') : res.message);
            }
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
    
    // Sync CKEditor content
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
        CKEDITOR.instances.contentArtikel.updateElement();
    }
    
    const id = $('#artikelId').val();
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
                alert(res.errors ? Object.values(res.errors).join('\n') : res.message);
            }
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

// FAQ
$('#formFaq').on('submit', function(e) {
    e.preventDefault();
    const id = $('#faqId').val();
    const url = id ? `${baseUrl}/admin/faq/ubah/${id}` : `${baseUrl}/admin/faq/tambah`;
    
    $.post(url, $(this).serialize(), function(res) {
        if(res.success) {
            alert(res.message);
            location.reload();
        } else {
            alert(res.errors ? Object.values(res.errors).join('\n') : res.message);
        }
    });
});

function editFaq(id) {
    const faq = dataFaqs.find(f => f.id == id);
    $('#titleFaq').text('Edit FAQ');
    $('#faqId').val(faq.id);
    $('#formFaq [name="category"]').val(faq.category);
    $('[name="pertanyaan"]').val(faq.pertanyaan);
    $('[name="jawaban"]').val(faq.jawaban);
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
    const id = $('#unduhanId').val();
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
                alert(res.errors ? Object.values(res.errors).join('\n') : res.message);
            }
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
    
    // Reset CKEditor
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
        CKEDITOR.instances.contentArtikel.setData('');
    }
    
    // Reset password fields
    $('#passwordFieldAdd').show();
    $('#password').attr('disabled', false).attr('required', 'required');
    
    $('#passwordFieldEdit').hide();
    $('#password_edit').attr('disabled', true).removeAttr('required');
    $('#resetPasswordCheck').prop('checked', false);
    $('#passwordResetField').hide();
});
