<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Padukuhan</h5>
        <button class="btn btn-primary btn-sm" onclick="tambahPadukuhan()"><i class="fas fa-plus"></i> Tambah</button>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Padukuhan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($padukuhan as $p): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($p['nama_padukuhan']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-xs" onclick="editPadukuhan(<?= $p['id'] ?>)"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger btn-xs" onclick="hapusPadukuhan(<?= $p['id'] ?>)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPadukuhan">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titlePadukuhan">Tambah Padukuhan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="formPadukuhan">
                <input type="hidden" id="padukuhanId">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Padukuhan *</label>
                        <input type="text" class="form-control" name="nama_padukuhan" id="padukuhanName" required>
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
function tambahPadukuhan() {
    $('#padukuhanId').val('');
    $('#padukuhanName').val('');
    $('#titlePadukuhan').text('Tambah Padukuhan');
    $('#modalPadukuhan').modal('show');
}

function editPadukuhan(id) {
    $.get('<?= base_url('admin/padukuhan/get/') ?>' + id, function(res) {
        if(res.success) {
            $('#padukuhanId').val(res.data.id);
            $('#padukuhanName').val(res.data.nama_padukuhan);
            $('#titlePadukuhan').text('Edit Padukuhan');
            $('#modalPadukuhan').modal('show');
        }
    });
}

function hapusPadukuhan(id) {
    if(confirm('Yakin hapus padukuhan ini?')) {
        $.post('<?= base_url('admin/padukuhan/delete/') ?>' + id, function(res) {
            alert(res.message);
            if(res.success) location.reload();
        });
    }
}

$('#formPadukuhan').submit(function(e) {
    e.preventDefault();
    const id = $('#padukuhanId').val();
    const url = id ? '<?= base_url('admin/padukuhan/update/') ?>' + id : '<?= base_url('admin/padukuhan/store') ?>';
    
    $.post(url, $(this).serialize(), function(res) {
        alert(res.message);
        if(res.success) {
            $('#modalPadukuhan').modal('hide');
            location.reload();
        }
    });
});
</script>
<?= $this->endSection() ?>
