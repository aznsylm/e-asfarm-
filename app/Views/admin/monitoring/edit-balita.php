<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$monitoring['id']) ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

    <div class="row">
        <div class="col-12">
            <form method="POST" action="<?= base_url('admin/monitoring/balita/update-master/'.$monitoring['id']) ?>">
                <?= csrf_field() ?>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Data Identitas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Anak *</label>
                                <input type="text" name="nama_anak" class="form-control" value="<?= esc($identitas['nama_anak']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir *</label>
                                <input type="date" name="tanggal_lahir" class="form-control" value="<?= esc($identitas['tanggal_lahir']) ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Wali *</label>
                                <input type="text" name="nama_wali" class="form-control" value="<?= esc($identitas['nama_wali']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP Wali *</label>
                                <input type="tel" name="no_hp_wali" class="form-control" value="<?= esc($identitas['no_hp_wali']) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$monitoring['id']) ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
