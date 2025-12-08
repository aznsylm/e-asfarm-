<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$monitoring['id']) ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <h2>Input Kunjungan Rutin Balita</h2>
            <p class="text-muted">
                Pasien: <strong><?= esc($identitas['nama_anak']) ?></strong> | 
                Kunjungan ke-<strong><?= $nextKunjungan ?></strong>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

            <form action="<?= base_url('admin/monitoring/balita/store-kunjungan') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="monitoring_balita_id" value="<?= $monitoring['id'] ?>">
                <input type="hidden" name="kunjungan_ke" value="<?= $nextKunjungan ?>">

                <div class="mb-3">
                    <label class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_kunjungan" class="form-control" value="<?= date('Y-m-d') ?>" required>
                </div>

                <hr>
                <h6 class="mb-3">Antropometri</h6>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Berat Badan (kg) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="berat_badan" class="form-control" placeholder="Contoh: 8.5" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="tinggi_badan" class="form-control" placeholder="Contoh: 72.5" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Lingkar Kepala (cm)</label>
                        <input type="number" step="0.01" name="lingkar_kepala" class="form-control" placeholder="Contoh: 45.0">
                    </div>
                </div>

                <hr>
                <h6 class="mb-3">Keluhan</h6>
                <div class="row">
                    <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="batuk" value="1" id="batuk"><label class="form-check-label" for="batuk">Batuk</label></div></div>
                    <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="pilek" value="1" id="pilek"><label class="form-check-label" for="pilek">Pilek</label></div></div>
                    <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="demam" value="1" id="demam"><label class="form-check-label" for="demam">Demam</label></div></div>
                    <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="diare" value="1" id="diare"><label class="form-check-label" for="diare">Diare</label></div></div>
                    <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="sembelit" value="1" id="sembelit"><label class="form-check-label" for="sembelit">Sembelit</label></div></div>
                    <div class="col-md-2"><div class="form-check"><input class="form-check-input" type="checkbox" name="gtm" value="1" id="gtm"><label class="form-check-label" for="gtm">GTM</label></div></div>
                </div>
                <div class="mb-3 mt-2">
                    <textarea name="lainnya" class="form-control" rows="2" placeholder="Keluhan lainnya..."></textarea>
                </div>

                <hr>
                <h6 class="mb-3">Imunisasi & Alergi</h6>
                <div class="mb-3">
                    <label class="form-label">Riwayat Alergi</label>
                    <input type="text" name="riwayat_alergi" class="form-control" placeholder='Contoh: "Susu Sapi", "Telur"'>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status Imunisasi <span class="text-danger">*</span></label>
                    <select name="status_imunisasi" class="form-select" required>
                        <option value="Lengkap">Lengkap</option>
                        <option value="Terlewat">Terlewat</option>
                        <option value="Belum">Belum</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Jenis Imunisasi Wajib (0-18 Tahun)</label>
                    <p class="text-muted small">Centang vaksin yang sudah diberikan beserta waktu pemberiannya</p>

                    <!-- 1. Hepatitis B -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>1. Hepatitis B</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="2_bulan" id="hepb_2">
                                <label class="form-check-label" for="hepb_2">2 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="3_bulan" id="hepb_3">
                                <label class="form-check-label" for="hepb_3">3 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="4_bulan" id="hepb_4">
                                <label class="form-check-label" for="hepb_4">4 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[hepatitis_b][]" value="18_bulan" id="hepb_18">
                                <label class="form-check-label" for="hepb_18">18 Bulan</label>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Polio/IPV -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>2. Polio / IPV</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="saat_lahir" id="polio_lahir">
                                <label class="form-check-label" for="polio_lahir">Saat Lahir</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="2_bulan" id="polio_2">
                                <label class="form-check-label" for="polio_2">2 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="3_bulan" id="polio_3">
                                <label class="form-check-label" for="polio_3">3 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[polio][]" value="4_bulan" id="polio_4">
                                <label class="form-check-label" for="polio_4">4 Bulan</label>
                            </div>
                        </div>
                    </div>

                    <!-- 3. BCG -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>3. BCG (Tuberkulosis/TBC)</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[bcg][]" value="saat_lahir" id="bcg_lahir">
                                <label class="form-check-label" for="bcg_lahir">Saat Lahir</label>
                            </div>
                            <div class="input-group mt-2" style="max-width: 300px;">
                                <span class="input-group-text">Lainnya</span>
                                <input type="text" class="form-control" name="vaksin[bcg][]" placeholder="... bulan">
                            </div>
                        </div>
                    </div>

                    <!-- 4. Campak Rubella (MR) -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>4. Campak Rubella (MR)</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[campak_rubella][]" value="9_bulan" id="mr_9">
                                <label class="form-check-label" for="mr_9">9 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[campak_rubella][]" value="18_bulan" id="mr_18">
                                <label class="form-check-label" for="mr_18">18 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[campak_rubella][]" value="5_tahun" id="mr_5">
                                <label class="form-check-label" for="mr_5">5 Tahun</label>
                            </div>
                        </div>
                    </div>

                    <!-- 5. DPT-HB-Hib -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>5. DPT-HB-Hib</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="2_bulan" id="dpt_2">
                                <label class="form-check-label" for="dpt_2">2 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="3_bulan" id="dpt_3">
                                <label class="form-check-label" for="dpt_3">3 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="4_bulan" id="dpt_4">
                                <label class="form-check-label" for="dpt_4">4 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[dpt_hb_hib][]" value="18_bulan" id="dpt_18">
                                <label class="form-check-label" for="dpt_18">18 Bulan</label>
                            </div>
                        </div>
                    </div>

                    <!-- 6. Pneumokokus (PCV) -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>6. Vaksin Pneumokokus (PCV)</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="2_bulan" id="pcv_2">
                                <label class="form-check-label" for="pcv_2">2 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="4_bulan" id="pcv_4">
                                <label class="form-check-label" for="pcv_4">4 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="6_bulan" id="pcv_6">
                                <label class="form-check-label" for="pcv_6">6 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[pneumokokus][]" value="12_15_bulan" id="pcv_12">
                                <label class="form-check-label" for="pcv_12">12-15 Bulan</label>
                            </div>
                        </div>
                    </div>

                    <!-- 7. Rotavirus -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>7. Vaksin Rotavirus Pentavalen</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[rotavirus][]" value="4_minggu" id="rota_4">
                                <label class="form-check-label" for="rota_4">4 Minggu</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[rotavirus][]" value="6_minggu" id="rota_6">
                                <label class="form-check-label" for="rota_6">6 Minggu</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[rotavirus][]" value="24_minggu" id="rota_24">
                                <label class="form-check-label" for="rota_24">24 Minggu</label>
                            </div>
                        </div>
                    </div>

                    <!-- 8. Influenza -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>8. Vaksin Influenza</h6>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[influenza][]" value="6_bulan" id="flu_6">
                                <label class="form-check-label" for="flu_6">6 Bulan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="vaksin[influenza][]" value="ulangan" id="flu_ulang">
                                <label class="form-check-label" for="flu_ulang">Ulangan</label>
                            </div>
                        </div>
                    </div>

                    <!-- 9. Vaksin Lainnya -->
                    <div class="card mb-2">
                        <div class="card-body">
                            <h6>9. Vaksin Lainnya</h6>
                            <input type="text" class="form-control" name="vaksin[lainnya][]" placeholder="Tuliskan jenis vaksin lainnya jika ada...">
                        </div>
                    </div>
                </div>

                <hr>
                <h6 class="mb-3">KPSP</h6>
                <div class="mb-3">
                    <label class="form-label">Hasil Skrining <span class="text-danger">*</span></label>
                    <select name="hasil_skrining" class="form-select" required>
                        <option value="Sesuai">Sesuai (S)</option>
                        <option value="Meragukan">Meragukan (M)</option>
                        <option value="Penyimpangan">Penyimpangan (P)</option>
                    </select>
                </div>

                <hr>
                <h6 class="mb-3">Gizi & Suplementasi</h6>
                <div class="row">
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="vitamin_a" value="1" id="vitamin_a"><label class="form-check-label" for="vitamin_a">Vitamin A</label></div></div>
                    <div class="col-md-4"><div class="form-check"><input class="form-check-input" type="checkbox" name="obat_cacing" value="1" id="obat_cacing"><label class="form-check-label" for="obat_cacing">Obat Cacing</label></div></div>
                    <div class="col-md-4">
                        <select name="pola_makan" class="form-select">
                            <option value="">Pola Makan</option>
                            <option value="ASI Eksklusif">ASI Eksklusif</option>
                            <option value="ASI+MPASI">ASI+MPASI</option>
                            <option value="Sufor">Sufor</option>
                        </select>
                    </div>
                </div>

                <hr>
                <h6 class="mb-3">Swamedikasi</h6>
                <div class="row">
                    <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="ke_nakes" value="1" id="ke_nakes"><label class="form-check-label" for="ke_nakes">Ke Nakes</label></div></div>
                    <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="obat_modern" value="1" id="obat_modern"><label class="form-check-label" for="obat_modern">Obat Modern</label></div></div>
                    <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="antibiotik" value="1" id="antibiotik"><label class="form-check-label" for="antibiotik">Antibiotik</label></div></div>
                    <div class="col-md-3"><div class="form-check"><input class="form-check-input" type="checkbox" name="etnomedisin" value="1" id="etnomedisin"><label class="form-check-label" for="etnomedisin">Etnomedisin</label></div></div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-check"></i> Simpan Kunjungan</button>
                    <a href="<?= base_url('admin/monitoring/balita/riwayat/' . $monitoring['id']) ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
