<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$monitoring['id']) ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <h2>Edit Kunjungan Balita</h2>
            <p class="text-muted">Edit data kunjungan ke-<?= $kunjunganData['kunjungan']['kunjungan_ke'] ?></p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form method="POST" action="<?= base_url('admin/monitoring/balita/update-kunjungan/'.$kunjunganData['kunjungan']['id']) ?>">
                <?= csrf_field() ?>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5>Data Kunjungan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kunjungan *</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control" value="<?= esc($kunjunganData['kunjungan']['tanggal_kunjungan']) ?>" required>
                        </div>

                        <h6 class="mb-3">Antropometri</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Berat Badan (kg) *</label>
                                <input type="number" step="0.01" name="berat_badan" class="form-control" value="<?= esc($kunjunganData['antropometri']['berat_badan'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tinggi Badan (cm) *</label>
                                <input type="number" step="0.01" name="tinggi_badan" class="form-control" value="<?= esc($kunjunganData['antropometri']['tinggi_badan'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Lingkar Kepala (cm)</label>
                                <input type="number" step="0.01" name="lingkar_kepala" class="form-control" value="<?= esc($kunjunganData['antropometri']['lingkar_kepala'] ?? '') ?>">
                            </div>
                        </div>

                        <h6 class="mb-3">Keluhan</h6>
                        <div class="row">
                            <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="batuk" value="1" id="batuk" <?= $kunjunganData['keluhan']['batuk'] ? 'checked' : '' ?>><label class="form-check-label" for="batuk">Batuk</label></div></div>
                            <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="pilek" value="1" id="pilek" <?= $kunjunganData['keluhan']['pilek'] ? 'checked' : '' ?>><label class="form-check-label" for="pilek">Pilek</label></div></div>
                            <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="demam" value="1" id="demam" <?= $kunjunganData['keluhan']['demam'] ? 'checked' : '' ?>><label class="form-check-label" for="demam">Demam</label></div></div>
                            <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="diare" value="1" id="diare" <?= $kunjunganData['keluhan']['diare'] ? 'checked' : '' ?>><label class="form-check-label" for="diare">Diare</label></div></div>
                            <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="sembelit" value="1" id="sembelit" <?= $kunjunganData['keluhan']['sembelit'] ? 'checked' : '' ?>><label class="form-check-label" for="sembelit">Sembelit</label></div></div>
                            <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="gtm" value="1" id="gtm" <?= $kunjunganData['keluhan']['gtm'] ? 'checked' : '' ?>><label class="form-check-label" for="gtm">GTM</label></div></div>
                        </div>
                        <div class="mb-3 mt-2">
                            <textarea name="lainnya" class="form-control" rows="2" placeholder="Keluhan lainnya..."><?= esc($kunjunganData['keluhan']['lainnya'] ?? '') ?></textarea>
                        </div>

                        <h6 class="mb-3">Imunisasi & Alergi</h6>
                        <div class="mb-3">
                            <label class="form-label">Riwayat Alergi</label>
                            <input type="text" name="riwayat_alergi" class="form-control" value="<?= esc($kunjunganData['imunisasi']['riwayat_alergi'] ?? '') ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Imunisasi *</label>
                            <select name="status_imunisasi" class="form-select" required>
                                <option value="Lengkap" <?= ($kunjunganData['imunisasi']['status_imunisasi'] ?? '') === 'Lengkap' ? 'selected' : '' ?>>Lengkap</option>
                                <option value="Terlewat" <?= ($kunjunganData['imunisasi']['status_imunisasi'] ?? '') === 'Terlewat' ? 'selected' : '' ?>>Terlewat</option>
                                <option value="Belum" <?= ($kunjunganData['imunisasi']['status_imunisasi'] ?? '') === 'Belum' ? 'selected' : '' ?>>Belum</option>
                            </select>
                        </div>

                        <h6 class="mb-3">KPSP</h6>
                        <div class="mb-3">
                            <label class="form-label">Hasil Skrining *</label>
                            <select name="hasil_skrining" class="form-select" required>
                                <option value="Sesuai" <?= ($kunjunganData['kpsp']['hasil_skrining'] ?? '') === 'Sesuai' ? 'selected' : '' ?>>Sesuai (S)</option>
                                <option value="Meragukan" <?= ($kunjunganData['kpsp']['hasil_skrining'] ?? '') === 'Meragukan' ? 'selected' : '' ?>>Meragukan (M)</option>
                                <option value="Penyimpangan" <?= ($kunjunganData['kpsp']['hasil_skrining'] ?? '') === 'Penyimpangan' ? 'selected' : '' ?>>Penyimpangan (P)</option>
                            </select>
                        </div>

                        <h6 class="mb-3">Gizi & Suplementasi</h6>
                        <div class="row">
                            <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="vitamin_a" value="1" id="vitamin_a" <?= $kunjunganData['gizi']['vitamin_a'] ? 'checked' : '' ?>><label class="form-check-label" for="vitamin_a">Vitamin A</label></div></div>
                            <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="obat_cacing" value="1" id="obat_cacing" <?= $kunjunganData['gizi']['obat_cacing'] ? 'checked' : '' ?>><label class="form-check-label" for="obat_cacing">Obat Cacing</label></div></div>
                            <div class="col-md-4">
                                <input type="text" name="pola_makan" class="form-control" placeholder="Pola Makan" value="<?= esc($kunjunganData['gizi']['pola_makan'] ?? '') ?>">
                            </div>
                        </div>

                        <h6 class="mb-3 mt-3">Swamedikasi</h6>
                        <div class="row">
                            <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="ke_nakes" value="1" id="ke_nakes" <?= $kunjunganData['swamedikasi']['ke_nakes'] ? 'checked' : '' ?>><label class="form-check-label" for="ke_nakes">Ke Nakes</label></div></div>
                            <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="obat_modern" value="1" id="obat_modern" <?= $kunjunganData['swamedikasi']['obat_modern'] ? 'checked' : '' ?>><label class="form-check-label" for="obat_modern">Obat Modern</label></div></div>
                            <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="antibiotik" value="1" id="antibiotik" <?= $kunjunganData['swamedikasi']['antibiotik'] ? 'checked' : '' ?>><label class="form-check-label" for="antibiotik">Antibiotik</label></div></div>
                            <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="etnomedisin" value="1" id="etnomedisin" <?= $kunjunganData['swamedikasi']['etnomedisin'] ? 'checked' : '' ?>><label class="form-check-label" for="etnomedisin">Etnomedisin</label></div></div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$monitoring['id']) ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
