<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('assets/css/monitoring.css') ?>">

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/remaja/riwayat/'.$monitoring['id']) ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>
<p class="mb-3">Pasien: <strong><?= esc($identitas['nama_lengkap']) ?></strong> | Kunjungan ke-<strong><?= $kunjunganKe ?></strong></p>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="<?= base_url('admin/monitoring/remaja/store-kunjungan/'.$monitoring['id']) ?>">
                        <?= csrf_field() ?>

                        <!-- Tanggal Kunjungan -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Kunjungan *</label>
                                <input type="date" name="tanggal_kunjungan" class="form-control" value="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>

                        <hr>

                        <!-- Antropometri -->
                        <h5 class="mb-3"><i class="fas fa-ruler"></i> Data Antropometri</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Berat Badan (kg) *</label>
                                <input type="number" name="berat_badan" class="form-control" step="0.1" min="20" max="150" placeholder="Contoh: 45.5" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tinggi Badan (cm) *</label>
                                <input type="number" name="tinggi_badan" class="form-control" step="0.1" min="100" max="200" placeholder="Contoh: 155.0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lingkar Perut (cm) *</label>
                                <input type="number" name="lingkar_perut" class="form-control" step="0.1" min="40" max="150" placeholder="Contoh: 65.0" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tekanan Darah *</label>
                                <input type="text" name="tekanan_darah" class="form-control" placeholder="120/80" required>
                            </div>
                        </div>

                        <hr>

                        <!-- Skrining Anemia -->
                        <h5 class="mb-3"><i class="fas fa-heartbeat"></i> Skrining Anemia</h5>
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="text-muted">Pilih gejala anemia yang dialami</p>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Pucat" id="a1">
                                            <label class="form-check-label" for="a1">Pucat (5P)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="5L" id="a2">
                                            <label class="form-check-label" for="a2">5L (Letih, Lemah, Lesu, Lelah, Lunglai)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Pusing" id="a3">
                                            <label class="form-check-label" for="a3">Pusing</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Sulit Konsentrasi" id="a4">
                                            <label class="form-check-label" for="a4">Sulit Konsentrasi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="gejala_anemia[]" value="Tidak Ada" id="a5">
                                            <label class="form-check-label" for="a5">Tidak Ada Gejala</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Riwayat Haid (Conditional) -->
                        <?php if($identitas['jenis_kelamin'] === 'P'): ?>
                        <h5 class="mb-3"><i class="fas fa-calendar"></i> Riwayat Haid</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sudah Menstruasi? *</label>
                                <select name="sudah_menstruasi" class="form-select" required>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Keteraturan Haid *</label>
                                <select name="keteraturan_haid" class="form-select" required>
                                    <option value="Teratur">Teratur</option>
                                    <option value="Tidak Teratur">Tidak Teratur</option>
                                    <option value="Belum Menstruasi">Belum Menstruasi</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nyeri Haid? *</label>
                                <select name="nyeri_haid" class="form-select" required>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <?php endif; ?>

                        <!-- Gaya Hidup -->
                        <h5 class="mb-3"><i class="fas fa-running"></i> Gaya Hidup & Risiko PTM</h5>
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="text-muted">Pilih perilaku berisiko yang dilakukan</p>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Merokok" id="r1">
                                            <label class="form-check-label" for="r1">Merokok</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Kurang Aktivitas Fisik" id="r2">
                                            <label class="form-check-label" for="r2">Kurang Aktivitas Fisik (Mager)</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Minum Manis" id="r3">
                                            <label class="form-check-label" for="r3">Sering Minum Minuman Manis</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Makan Asin" id="r4">
                                            <label class="form-check-label" for="r4">Sering Makan Makanan Asin</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Begadang" id="r5">
                                            <label class="form-check-label" for="r5">Sering Begadang</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="risiko_ptm[]" value="Tidak Ada" id="r6">
                                            <label class="form-check-label" for="r6">Tidak Ada Perilaku Berisiko</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Suplementasi -->
                        <h5 class="mb-3"><i class="fas fa-pills"></i> Suplementasi & Gizi</h5>
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Dapat TTD (Tablet Tambah Darah)?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="dapat_ttd" value="1" id="ttd1">
                                    <label class="form-check-label" for="ttd1">Ya, dapat TTD</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Minum TTD Rutin?</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="minum_ttd" value="1" id="ttd2">
                                    <label class="form-check-label" for="ttd2">Ya, minum rutin</label>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kebiasaan Sarapan *</label>
                                <select name="kebiasaan_sarapan" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Selalu">Selalu Sarapan</option>
                                    <option value="Sering">Sering Sarapan</option>
                                    <option value="Kadang-kadang">Kadang-kadang</option>
                                    <option value="Jarang">Jarang Sarapan</option>
                                    <option value="Tidak Pernah">Tidak Pernah Sarapan</option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <!-- Swamedikasi -->
                        <h5 class="mb-3"><i class="fas fa-first-aid"></i> Perilaku Swamedikasi</h5>
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="text-muted">Jika sakit, biasanya melakukan apa?</p>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Konsultasi Nakes" id="s1">
                                            <label class="form-check-label" for="s1">Konsultasi ke Tenaga Kesehatan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Obat Modern" id="s2">
                                            <label class="form-check-label" for="s2">Beli Obat Modern</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Etnomedisin" id="s3">
                                            <label class="form-check-label" for="s3">Menggunakan Etnomedisin</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Skincare" id="s4">
                                            <label class="form-check-label" for="s4">Menggunakan Skincare/Kosmetik</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="perilaku_swamedikasi[]" value="Dibiarkan" id="s5">
                                            <label class="form-check-label" for="s5">Dibiarkan Saja</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Catatan -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label">Catatan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="3" placeholder="Catatan tambahan..."></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-right">
                            <a href="<?= base_url('admin/monitoring/remaja/riwayat/'.$monitoring['id']) ?>" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Simpan Kunjungan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
