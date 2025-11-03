<?= $this->extend('layouts/superadmin') ?>
<?= $this->section('content') ?>

<div class="body-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Pengaturan Sistem</h5>
                        
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Aplikasi</label>
                                        <input type="text" class="form-control" value="E-Asfarm">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Admin</label>
                                        <input type="email" class="form-control" value="admin@e-asfarm.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Maksimal Upload File (MB)</label>
                                        <input type="number" class="form-control" value="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Zona Waktu</label>
                                        <select class="form-control">
                                            <option>Asia/Jakarta</option>
                                            <option>Asia/Makassar</option>
                                            <option>Asia/Jayapura</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Mode Maintenance</label>
                                        <select class="form-control">
                                            <option>Tidak Aktif</option>
                                            <option>Aktif</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Registrasi Pengguna</label>
                                        <select class="form-control">
                                            <option>Diizinkan</option>
                                            <option>Ditutup</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>