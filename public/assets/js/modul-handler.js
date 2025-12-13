// MODUL
$('#formModul').on('submit', function(e) {
    e.preventDefault();
    
    $('.error-message').hide().text('');
    $('.form-control, .form-select').removeClass('is-invalid');
    
    let hasError = false;
    const id = $('#modulId').val();
    
    const title = $('#modulTitleInput').val().trim();
    if (!title) {
        $('#error-modul-title').text('Judul wajib diisi').show();
        $('#modulTitleInput').addClass('is-invalid');
        hasError = true;
    } else if (title.length < 5) {
        $('#error-modul-title').text('Judul minimal 5 karakter').show();
        $('#modulTitleInput').addClass('is-invalid');
        hasError = true;
    }
    
    const selectedCategories = $('.modul-category-checkbox:checked').length;
    if (selectedCategories === 0) {
        $('#error-modul-category').text('Kategori wajib dipilih (minimal 1)').show();
        hasError = true;
    }
    
    const linkDrive = $('#modulLinkDriveInput').val().trim();
    if (!linkDrive) {
        $('#error-modul-link_drive').text('Link Google Drive wajib diisi').show();
        $('#modulLinkDriveInput').addClass('is-invalid');
        hasError = true;
    } else if (!linkDrive.includes('drive.google.com')) {
        $('#error-modul-link_drive').text('Link harus dari Google Drive').show();
        $('#modulLinkDriveInput').addClass('is-invalid');
        hasError = true;
    }
    
    const thumbnailFile = $('#thumbnailModul')[0].files[0];
    if (!id && !thumbnailFile) {
        $('#error-modul-thumbnail').text('Thumbnail wajib diupload').show();
        $('#thumbnailModul').addClass('is-invalid');
        hasError = true;
    } else if (thumbnailFile) {
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!allowedTypes.includes(thumbnailFile.type)) {
            $('#error-modul-thumbnail').text('Format gambar harus JPG, PNG, atau WEBP').show();
            $('#thumbnailModul').addClass('is-invalid');
            hasError = true;
        } else if (thumbnailFile.size > 2 * 1024 * 1024) {
            $('#error-modul-thumbnail').text('Ukuran gambar maksimal 2MB').show();
            $('#thumbnailModul').addClass('is-invalid');
            hasError = true;
        }
    }
    
    if (hasError) return false;
    
    const url = id ? `${baseUrl}/admin/modul/ubah/${id}` : `${baseUrl}/admin/modul/tambah`;
    
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
                        const errorDiv = $(`#error-modul-${field}`);
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

function editModul(id) {
    const modul = dataModuls.find(m => m.id == id);
    $('#titleModul').text('Edit Modul');
    $('#modulId').val(modul.id);
    $('#modulTitleInput').val(modul.title);
    $('#modulCategoryInput').val(modul.category);
    $('#modulLinkDriveInput').val(modul.link_drive);
    $('#thumbnailModul').removeAttr('required');
    $('#modalModul').modal('show');
}

function hapusModul(id) {
    if(confirm('Yakin hapus modul ini?')) {
        $.post(`${baseUrl}/admin/modul/hapus/${id}`, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}
