<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('admin/monitoring/riwayat/'.$monitoring['id']) ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <h2>Edit Data Master</h2>
            <p class="text-muted">Edit data identitas, riwayat penyakit, dan skrining</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="POST" action="<?= base_url('admin/monitoring/update-master/'.$monitoring['id']) ?>">
                <?= csrf_field() ?>

                <!-- Identitas -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Data Identitas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Ibu *</label>
                                <input type="text" name="nama_ibu" class="form-control" value="<?= esc($identitas['nama_ibu']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Suami *</label>
                                <input type="text" name="nama_suami" class="form-control" value="<?= esc($identitas['nama_suami']) ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Usia Ibu (tahun) *</label>
                                <input type="number" name="usia_ibu" class="form-control" value="<?= esc($identitas['usia_ibu']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Usia Suami (tahun) *</label>
                                <input type="number" name="usia_suami" class="form-control" value="<?= esc($identitas['usia_suami']) ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="form-label">Alamat *</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?= esc($identitas['alamat']) ?></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nomor Telepon *</label>
                                <input type="tel" name="nomor_telepon" class="form-control" value="<?= esc($identitas['nomor_telepon']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Usia Kehamilan (bulan) *</label>
                                <input type="number" name="usia_kehamilan" class="form-control" value="<?= esc($identitas['usia_kehamilan']) ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rencana Tanggal Persalinan *</label>
                                <input type="date" name="rencana_tanggal_persalinan" class="form-control" value="<?= esc($identitas['rencana_tanggal_persalinan']) ?>" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat Penyakit -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Riwayat Penyakit</h5>
                    </div>
                    <div class="card-body">
                        <?php 
                        $riwayat = json_decode($riwayatPenyakit['riwayat_penyakit'], true) ?? [];
                        ?>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Hipertensi" id="r1" <?= in_array('Hipertensi', $riwayat) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="r1">Hipertensi</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Diabetes" id="r2" <?= in_array('Diabetes', $riwayat) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="r2">Diabetes</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Jantung" id="r3" <?= in_array('Jantung', $riwayat) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="r3">Jantung</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Asma" id="r4" <?= in_array('Asma', $riwayat) ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="r4">Asma</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" type="checkbox" name="tidak_ada_riwayat" value="1" id="tidakAda" <?= $riwayatPenyakit['tidak_ada_riwayat'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="tidakAda">Tidak ada riwayat penyakit</label>
                        </div>
                    </div>
                </div>

                <!-- Skrining -->
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Skrining Rencana Persalinan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Persalinan *</label>
                                <select name="tempat_persalinan" class="form-select" required>
                                    <option value="">-- Pilih Tempat --</option>
                                    <option value="Rumah Sakit" <?= $skrining['tempat_persalinan'] === 'Rumah Sakit' ? 'selected' : '' ?>>Rumah Sakit</option>
                                    <option value="Puskesmas" <?= $skrining['tempat_persalinan'] === 'Puskesmas' ? 'selected' : '' ?>>Puskesmas</option>
                                    <option value="Klinik" <?= $skrining['tempat_persalinan'] === 'Klinik' ? 'selected' : '' ?>>Klinik</option>
                                    <option value="Rumah" <?= $skrining['tempat_persalinan'] === 'Rumah' ? 'selected' : '' ?>>Rumah</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Penolong Persalinan *</label>
                                <select name="penolong_persalinan" class="form-select" required>
                                    <option value="">-- Pilih Penolong --</option>
                                    <option value="Dokter" <?= $skrining['penolong_persalinan'] === 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                                    <option value="Bidan" <?= $skrining['penolong_persalinan'] === 'Bidan' ? 'selected' : '' ?>>Bidan</option>
                                    <option value="Dukun" <?= $skrining['penolong_persalinan'] === 'Dukun' ? 'selected' : '' ?>>Dukun</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="<?= base_url('admin/monitoring/riwayat/'.$monitoring['id']) ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
