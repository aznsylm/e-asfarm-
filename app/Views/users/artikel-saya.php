<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Artikel Saya</h2>
                <div>
                    <a href="<?= route_to('pengguna.dashboard') ?>" class="btn btn-outline-secondary me-2">Kembali ke Dashboard</a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalArtikel">
                        <i class="bi bi-plus-circle"></i> Buat Artikel Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($artikelSaya)): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Feedback Admin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($artikelSaya as $artikel): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($artikel['title']) ?></td>
                                        <td><?= esc($artikel['category']) ?></td>
                                        <td>
                                            <?php
                                            $badgeClass = match($artikel['status']) {
                                                'draft' => 'bg-secondary',
                                                'pending' => 'bg-warning text-dark',
                                                'approved' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                            $statusText = match($artikel['status']) {
                                                'draft' => 'Draft',
                                                'pending' => 'Menunggu Review',
                                                'approved' => 'Disetujui',
                                                'rejected' => 'Ditolak',
                                                default => 'Draft'
                                            };
                                            ?>
                                            <span class="badge <?= $badgeClass ?>"><?= $statusText ?></span>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($artikel['created_at'])) ?></td>
                                        <td>
                                            <?php if ($artikel['status'] === 'rejected'): ?>
                                                <small class="text-danger">Artikel ditolak admin</small>
                                            <?php elseif ($artikel['status'] === 'approved'): ?>
                                                <small class="text-success">Disetujui <?= $artikel['approved_at'] ? date('d/m/Y', strtotime($artikel['approved_at'])) : '' ?></small>
                                            <?php elseif ($artikel['status'] === 'pending'): ?>
                                                <small class="text-warning">Sedang direview admin</small>
                                            <?php else: ?>
                                                <small class="text-muted">-</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <?php if ($artikel['status'] === 'approved'): ?>
                                                    <a href="<?= base_url('artikel/baca/' . ($artikel['slug'] ?: $artikel['id'])) ?>" class="btn btn-outline-primary" target="_blank">Lihat</a>
                                                <?php endif; ?>
                                                
                                                <?php if (in_array($artikel['status'], ['pending', 'rejected'])): ?>
                                                    <button class="btn btn-outline-warning" onclick="editArtikel(<?= $artikel['id'] ?>)">Edit</button>
                                                <?php endif; ?>
                                                
                                                <?php if ($artikel['status'] === 'rejected'): ?>
                                                    <button class="btn btn-outline-danger" onclick="hapusArtikel(<?= $artikel['id'] ?>)">Hapus</button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <?= $pager->links() ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <h5 class="text-muted">Belum ada artikel</h5>
                            <p class="text-muted">Mulai menulis artikel pertama Anda!</p>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalArtikel">
                                <i class="bi bi-plus-circle"></i> Buat Artikel Baru
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Artikel -->
<div class="modal fade" id="modalArtikel" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleArtikel">Tambah Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formArtikel" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" id="artikelId">
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Judul *</label>
                        <input type="text" class="form-control form-control-sm" name="title" required>
                    </div>
                    <div class="mb-2">
                        <label>Kategori *</label>
                        <select class="form-select form-select-sm" name="category" required>
                            <option value="">Pilih</option>
                            <option value="Farmasi">Farmasi</option>
                            <option value="Gizi">Gizi</option>
                            <option value="Bidan">Bidan</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Konten *</label>
                        <textarea class="form-control form-control-sm" name="content" id="contentArtikel" rows="5" required></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Gambar * 
                            <i class="bi bi-question-circle text-primary" data-bs-toggle="tooltip" data-bs-placement="right" title="Format: JPG, JPEG, PNG, WEBP | Maksimal: 2MB | Resolusi disarankan: 1200x630px"></i>
                        </label>
                        <input type="file" class="form-control form-control-sm" name="image" id="imageArtikel" accept="image/jpeg,image/jpg,image/png,image/webp" required>
                        <small class="text-muted"><i class="bi bi-info-circle"></i> Format: JPG, PNG, WEBP | Max: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
const baseUrl = window.location.origin;
const artikelSaya = <?= json_encode($artikelSaya) ?>;

// Initialize CKEditor
if (document.getElementById('contentArtikel')) {
    CKEDITOR.replace('contentArtikel', {
        height: 300,
        removeButtons: 'Save,NewPage,Preview,Print,Templates'
    });
}

// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    if (typeof bootstrap !== 'undefined') {
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});

// Submit form
$(document).ready(function() {
    $('#formArtikel').on('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted');
        
        // Sync CKEditor
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
            CKEDITOR.instances.contentArtikel.updateElement();
            console.log('CKEditor synced');
        }
        
        const id = $('#artikelId').val();
        const url = id ? `${baseUrl}/pengguna/artikel/ubah/${id}` : `${baseUrl}/pengguna/artikel/tambah`;
        console.log('Submitting to:', url);
        
        $.ajax({
            url: url,
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(res) {
                console.log('Response:', res);
                if(res.success) {
                    alert(res.message);
                    location.reload();
                } else {
                    alert(res.errors ? Object.values(res.errors).join('\n') : res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Status:', status);
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Terjadi kesalahan: ' + error + '\nCek console untuk detail.');
            }
        });
    });
});

function editArtikel(id) {
    const article = artikelSaya.find(a => a.id == id);
    $('#titleArtikel').text('Edit Artikel');
    $('#artikelId').val(article.id);
    $('[name="title"]').val(article.title);
    $('[name="category"]').val(article.category);
    
    if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
        CKEDITOR.instances.contentArtikel.setData(article.content || '');
    }
    
    $('#imageArtikel').removeAttr('required');
    $('#modalArtikel').modal('show');
}

function hapusArtikel(id) {
    if(confirm('Yakin ingin menghapus artikel ini?')) {
        const formData = new FormData();
        formData.append('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
        
        $.ajax({
            url: `${baseUrl}/pengguna/artikel/hapus/${id}`,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                alert(res.message);
                if(res.success) location.reload();
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
                alert('Terjadi kesalahan saat menghapus artikel');
            }
        });
    }
}

// Reset modal
$(document).ready(function() {
    $('#modalArtikel').on('hidden.bs.modal', function() {
        $('#formArtikel')[0].reset();
        $('#artikelId').val('');
        $('#titleArtikel').text('Tambah Artikel');
        $('#imageArtikel').attr('required', 'required');
        
        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.contentArtikel) {
            CKEDITOR.instances.contentArtikel.setData('');
        }
    });
});
</script>

<?= $this->endSection() ?>