<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/remaja/riwayat/'.$monitoring['id']) ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
<p class="mb-3">Edit data kunjungan ke-<?= $kunjunganData['kunjungan']['kunjungan_ke'] ?></p>

    <div class="row">
        <div class="col-12">
            <form method="POST" action="<?= base_url('admin/monitoring/remaja/update-kunjungan/'.$kunjunganData['kunjungan']['id']) ?>">
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (kg) *</label>
                                <input type="number" step="0.1" name="berat_badan" class="form-control" value="<?= esc($kunjunganData['antropometri']['berat_badan'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Badan (cm) *</label>
                                <input type="number" step="0.1" name="tinggi_badan" class="form-control" value="<?= esc($kunjunganData['antropometri']['tinggi_badan'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lingkar Perut (cm) *</label>
                                <input type="number" step="0.1" name="lingkar_perut" class="form-control" value="<?= esc($kunjunganData['antropometri']['lingkar_perut'] ?? '') ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tekanan Darah *</label>
                                <input type="text" name="tekanan_darah" class="form-control" value="<?= esc($kunjunganData['antropometri']['tekanan_darah'] ?? '') ?>" required>
                            </div>
                        </div>

                        <h6 class="mb-3">Skrining Anemia</h6>
                        <?php $gejalaAnemia = json_decode($kunjunganData['anemia']['gejala_anemia'] ?? '[]', true); ?>
                        <div class="row">
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Pucat" id="a1" <?= in_array('Pucat', $gejalaAnemia) ? 'checked' : '' ?>><label class="form-check-label" for="a1">Pucat (5P)</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="5L" id="a2" <?= in_array('5L', $gejalaAnemia) ? 'checked' : '' ?>><label class="form-check-label" for="a2">5L</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Pusing" id="a3" <?= in_array('Pusing', $gejalaAnemia) ? 'checked' : '' ?>><label class="form-check-label" for="a3">Pusing</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Sulit Konsentrasi" id="a4" <?= in_array('Sulit Konsentrasi', $gejalaAnemia) ? 'checked' : '' ?>><label class="form-check-label" for="a4">Sulit Konsentrasi</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Tidak Ada" id="a5" <?= in_array('Tidak Ada', $gejalaAnemia) ? 'checked' : '' ?>><label class="form-check-label" for="a5">Tidak Ada Gejala</label></div></div>
                        </div>

                        <?php if($identitas['jenis_kelamin'] === 'P' && $kunjunganData['haid']): ?>
                        <h6 class="mb-3 mt-3">Riwayat Haid</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Sudah Menstruasi?</label>
                                <select name="sudah_menstruasi" class="form-select">
                                    <option value="Ya" <?= ($kunjunganData['haid']['sudah_menstruasi'] ?? '') === 'Ya' ? 'selected' : '' ?>>Ya</option>
                                    <option value="Tidak" <?= ($kunjunganData['haid']['sudah_menstruasi'] ?? '') === 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Keteraturan Haid</label>
                                <select name="keteraturan_haid" class="form-select">
                                    <option value="Teratur" <?= ($kunjunganData['haid']['keteraturan_haid'] ?? '') === 'Teratur' ? 'selected' : '' ?>>Teratur</option>
                                    <option value="Tidak Teratur" <?= ($kunjunganData['haid']['keteraturan_haid'] ?? '') === 'Tidak Teratur' ? 'selected' : '' ?>>Tidak Teratur</option>
                                    <option value="Belum Menstruasi" <?= ($kunjunganData['haid']['keteraturan_haid'] ?? '') === 'Belum Menstruasi' ? 'selected' : '' ?>>Belum Menstruasi</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nyeri Haid?</label>
                                <select name="nyeri_haid" class="form-select">
                                    <option value="Ya" <?= ($kunjunganData['haid']['nyeri_haid'] ?? '') === 'Ya' ? 'selected' : '' ?>>Ya</option>
                                    <option value="Tidak" <?= ($kunjunganData['haid']['nyeri_haid'] ?? '') === 'Tidak' ? 'selected' : '' ?>>Tidak</option>
                                </select>
                            </div>
                        </div>
                        <?php endif; ?>

                        <h6 class="mb-3">Gaya Hidup & Risiko PTM</h6>
                        <?php $risikoPtm = json_decode($kunjunganData['gaya_hidup']['risiko_ptm'] ?? '[]', true); ?>
                        <div class="row">
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Merokok" id="r1" <?= in_array('Merokok', $risikoPtm) ? 'checked' : '' ?>><label class="form-check-label" for="r1">Merokok</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Kurang Aktivitas Fisik" id="r2" <?= in_array('Kurang Aktivitas Fisik', $risikoPtm) ? 'checked' : '' ?>><label class="form-check-label" for="r2">Kurang Aktivitas Fisik</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Minum Manis" id="r3" <?= in_array('Minum Manis', $risikoPtm) ? 'checked' : '' ?>><label class="form-check-label" for="r3">Minum Manis</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Makan Asin" id="r4" <?= in_array('Makan Asin', $risikoPtm) ? 'checked' : '' ?>><label class="form-check-label" for="r4">Makan Asin</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Begadang" id="r5" <?= in_array('Begadang', $risikoPtm) ? 'checked' : '' ?>><label class="form-check-label" for="r5">Begadang</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Tidak Ada" id="r6" <?= in_array('Tidak Ada', $risikoPtm) ? 'checked' : '' ?>><label class="form-check-label" for="r6">Tidak Ada</label></div></div>
                        </div>

                        <h6 class="mb-3 mt-3">Suplementasi & Gizi</h6>
                        <div class="row">
                            <div class="col-md-4 mb-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="dapat_ttd" value="1" id="ttd1" <?= $kunjunganData['suplementasi']['dapat_ttd'] ? 'checked' : '' ?>><label class="form-check-label" for="ttd1">Dapat TTD</label></div></div>
                            <div class="col-md-4 mb-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="minum_ttd" value="1" id="ttd2" <?= $kunjunganData['suplementasi']['minum_ttd'] ? 'checked' : '' ?>><label class="form-check-label" for="ttd2">Minum TTD</label></div></div>
                            <div class="col-md-4 mb-3">
                                <select name="kebiasaan_sarapan" class="form-select">
                                    <option value="Selalu" <?= ($kunjunganData['suplementasi']['kebiasaan_sarapan'] ?? '') === 'Selalu' ? 'selected' : '' ?>>Selalu</option>
                                    <option value="Sering" <?= ($kunjunganData['suplementasi']['kebiasaan_sarapan'] ?? '') === 'Sering' ? 'selected' : '' ?>>Sering</option>
                                    <option value="Kadang-kadang" <?= ($kunjunganData['suplementasi']['kebiasaan_sarapan'] ?? '') === 'Kadang-kadang' ? 'selected' : '' ?>>Kadang-kadang</option>
                                    <option value="Jarang" <?= ($kunjunganData['suplementasi']['kebiasaan_sarapan'] ?? '') === 'Jarang' ? 'selected' : '' ?>>Jarang</option>
                                    <option value="Tidak Pernah" <?= ($kunjunganData['suplementasi']['kebiasaan_sarapan'] ?? '') === 'Tidak Pernah' ? 'selected' : '' ?>>Tidak Pernah</option>
                                </select>
                            </div>
                        </div>

                        <h6 class="mb-3">Perilaku Swamedikasi</h6>
                        <?php $perilakuSwamedikasi = json_decode($kunjunganData['swamedikasi']['perilaku_swamedikasi'] ?? '[]', true); ?>
                        <div class="row">
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Konsultasi Nakes" id="s1" <?= in_array('Konsultasi Nakes', $perilakuSwamedikasi) ? 'checked' : '' ?>><label class="form-check-label" for="s1">Konsultasi Nakes</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Obat Modern" id="s2" <?= in_array('Obat Modern', $perilakuSwamedikasi) ? 'checked' : '' ?>><label class="form-check-label" for="s2">Obat Modern</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Etnomedisin" id="s3" <?= in_array('Etnomedisin', $perilakuSwamedikasi) ? 'checked' : '' ?>><label class="form-check-label" for="s3">Etnomedisin</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Skincare" id="s4" <?= in_array('Skincare', $perilakuSwamedikasi) ? 'checked' : '' ?>><label class="form-check-label" for="s4">Skincare</label></div></div>
                            <div class="col-md-6 mb-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Dibiarkan" id="s5" <?= in_array('Dibiarkan', $perilakuSwamedikasi) ? 'checked' : '' ?>><label class="form-check-label" for="s5">Dibiarkan</label></div></div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label">Catatan</label>
                            <textarea name="catatan" class="form-control" rows="3"><?= esc($kunjunganData['kunjungan']['catatan'] ?? '') ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <a href="<?= base_url('admin/monitoring/remaja/riwayat/'.$monitoring['id']) ?>" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
