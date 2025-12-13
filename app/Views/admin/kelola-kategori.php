<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<?php if(session()->get('role') === 'admin'): ?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <i class="fas fa-info-circle"></i> <strong>Informasi Penting:</strong><br>
    Hubungi pengelola untuk mengubah atau menambahkan kategori yang diinginkan. Setiap padukuhan tidak boleh berbeda kategorinya.<br>
    <strong>Hubungi:</strong> <a href="https://wa.me/6281902808231" target="_blank" class="alert-link">+62 819-0280-8231 (Nurul Kusumawardani)</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<?php endif; ?>

<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#artikel">Artikel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tanyajawab">Tanya Jawab</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#poster">Poster</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#modul">Modul</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <!-- Tab Artikel -->
            <div class="tab-pane fade show active" id="artikel">
                <?php if(session()->get('role') === 'superadmin'): ?>
                <button class="btn btn-primary btn-sm mb-3" onclick="tambahKategori('artikel')"><i class="fas fa-plus"></i> Tambah</button>
                <?php endif; ?>
                <table class="table table-sm table-hover">
                    <thead><tr><th>No</th><th>Nama</th><th>Slug</th><th>Status</th><?php if(session()->get('role') === 'superadmin'): ?><th>Aksi</th><?php endif; ?></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($kategoriartikel as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($k['name']) ?></td>
                            <td><code><?= esc($k['slug']) ?></code></td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <?php if(session()->get('role') === 'superadmin'): ?>
                            <td>
                                <button class="btn btn-warning btn-xs" onclick="editKategori(<?= $k['id'] ?>)"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-xs" onclick="hapusKategori(<?= $k['id'] ?>)"><i class="fas fa-trash"></i></button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Tab Tanya Jawab -->
            <div class="tab-pane fade" id="tanyajawab">
                <?php if(session()->get('role') === 'superadmin'): ?>
                <button class="btn btn-primary btn-sm mb-3" onclick="tambahKategori('tanya_jawab')"><i class="fas fa-plus"></i> Tambah</button>
                <?php endif; ?>
                <table class="table table-sm table-hover">
                    <thead><tr><th>No</th><th>Nama</th><th>Slug</th><th>Status</th><?php if(session()->get('role') === 'superadmin'): ?><th>Aksi</th><?php endif; ?></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($kategoritanyajawab as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($k['name']) ?></td>
                            <td><code><?= esc($k['slug']) ?></code></td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <?php if(session()->get('role') === 'superadmin'): ?>
                            <td>
                                <button class="btn btn-warning btn-xs" onclick="editKategori(<?= $k['id'] ?>)"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-xs" onclick="hapusKategori(<?= $k['id'] ?>)"><i class="fas fa-trash"></i></button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Tab Poster -->
            <div class="tab-pane fade" id="poster">
                <?php if(session()->get('role') === 'superadmin'): ?>
                <button class="btn btn-primary btn-sm mb-3" onclick="tambahKategori('poster')"><i class="fas fa-plus"></i> Tambah</button>
                <?php endif; ?>
                <table class="table table-sm table-hover">
                    <thead><tr><th>No</th><th>Nama</th><th>Slug</th><th>Status</th><?php if(session()->get('role') === 'superadmin'): ?><th>Aksi</th><?php endif; ?></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($kategoriposter as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($k['name']) ?></td>
                            <td><code><?= esc($k['slug']) ?></code></td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <?php if(session()->get('role') === 'superadmin'): ?>
                            <td>
                                <button class="btn btn-warning btn-xs" onclick="editKategori(<?= $k['id'] ?>)"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-xs" onclick="hapusKategori(<?= $k['id'] ?>)"><i class="fas fa-trash"></i></button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Tab Modul -->
            <div class="tab-pane fade" id="modul">
                <?php if(session()->get('role') === 'superadmin'): ?>
                <button class="btn btn-primary btn-sm mb-3" onclick="tambahKategori('modul')"><i class="fas fa-plus"></i> Tambah</button>
                <?php endif; ?>
                <table class="table table-sm table-hover">
                    <thead><tr><th>No</th><th>Nama</th><th>Slug</th><th>Status</th><?php if(session()->get('role') === 'superadmin'): ?><th>Aksi</th><?php endif; ?></tr></thead>
                    <tbody>
                        <?php $no=1; foreach($kategorimodul as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($k['name']) ?></td>
                            <td><code><?= esc($k['slug']) ?></code></td>
                            <td><span class="badge badge-success">Aktif</span></td>
                            <?php if(session()->get('role') === 'superadmin'): ?>
                            <td>
                                <button class="btn btn-warning btn-xs" onclick="editKategori(<?= $k['id'] ?>)"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-xs" onclick="hapusKategori(<?= $k['id'] ?>)"><i class="fas fa-trash"></i></button>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Kategori -->
<div class="modal fade" id="modalKategori">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleKategori">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formKategori">
                <input type="hidden" id="kategoriId">
                <input type="hidden" id="kategoriType">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori *</label>
                        <input type="text" class="form-control" id="kategoriName" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function tambahKategori(type) {
    $('#kategoriId').val('');
    $('#kategoriType').val(type);
    $('#kategoriName').val('');
    $('#titleKategori').text('Tambah Kategori');
    $('#modalKategori').modal('show');
}

function editKategori(id) {
    $.get('<?= base_url('admin/kategori/get/') ?>' + id, function(res) {
        if(res.success) {
            $('#kategoriId').val(res.data.id);
            $('#kategoriType').val(res.data.type);
            $('#kategoriName').val(res.data.name);
            $('#titleKategori').text('Edit Kategori');
            $('#modalKategori').modal('show');
        }
    });
}

function hapusKategori(id) {
    if(confirm('Yakin hapus kategori ini?')) {
        $.post('<?= base_url('admin/kategori/hapus/') ?>' + id, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

$('#formKategori').submit(function(e) {
    e.preventDefault();
    const id = $('#kategoriId').val();
    const url = id ? '<?= base_url('admin/kategori/ubah/') ?>' + id : '<?= base_url('admin/kategori/tambah') ?>';
    const data = {
        name: $('#kategoriName').val(),
        type: $('#kategoriType').val()
    };
    
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(res) {
            alert(res.message);
            if(res.success) {
                $('#modalKategori').modal('hide');
                location.reload();
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr.responseText);
            alert('Terjadi kesalahan. Cek console untuk detail.');
        }
    });
});
</script>
<?= $this->endSection() ?>
