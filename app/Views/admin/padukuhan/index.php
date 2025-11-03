<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Kelola Padukuhan</h2>
            <p class="text-muted">Kelola data master padukuhan</p>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Data Padukuhan</h5>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus"></i> Tambah Padukuhan
            </button>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Padukuhan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($padukuhan as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= esc($p['kode_padukuhan']) ?></td>
                        <td><?= esc($p['nama_padukuhan']) ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editPadukuhan(<?= $p['id'] ?>, '<?= esc($p['kode_padukuhan']) ?>', '<?= esc($p['nama_padukuhan']) ?>')">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <a href="<?= base_url('admin/padukuhan/delete/'.$p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/padukuhan/store') ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Padukuhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode Padukuhan</label>
                        <input type="text" name="kode_padukuhan" class="form-control" required placeholder="PDK-XX">
                    </div>
                    <div class="mb-3">
                        <label>Nama Padukuhan</label>
                        <input type="text" name="nama_padukuhan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEdit" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Padukuhan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode Padukuhan</label>
                        <input type="text" name="kode_padukuhan" id="edit_kode" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nama Padukuhan</label>
                        <input type="text" name="nama_padukuhan" id="edit_nama" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editPadukuhan(id, kode, nama) {
    document.getElementById('formEdit').action = '<?= base_url('admin/padukuhan/update/') ?>' + id;
    document.getElementById('edit_kode').value = kode;
    document.getElementById('edit_nama').value = nama;
    new bootstrap.Modal(document.getElementById('modalEdit')).show();
}
</script>

<?= $this->endSection() ?>
