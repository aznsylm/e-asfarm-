<!-- Step 4: Riwayat Penyakit -->
<div class="wizard-step" id="step4">
    <h4 class="mb-4">Tahap 4: Riwayat Penyakit</h4>
    
    <div class="mb-3">
        <label class="form-label">Riwayat penyakit sebelumnya</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Jantung" id="r1">
            <label class="form-check-label" for="r1">Jantung</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Hipertensi" id="r2">
            <label class="form-check-label" for="r2">Hipertensi</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Diabetes" id="r3">
            <label class="form-check-label" for="r3">Diabetes</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="riwayat_penyakit[]" value="Hiperkolesterol" id="r4">
            <label class="form-check-label" for="r4">Hiperkolesterol</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="r5" onchange="toggleLainnyaRiwayat(this)">
            <label class="form-check-label" for="r5">Lainnya</label>
        </div>
        <input type="text" name="riwayat_penyakit_lainnya" class="form-control mt-2" id="riwayatLainnya" placeholder="Sebutkan..." style="display:none;">
    </div>

    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="tidak_ada_riwayat" value="1" id="tidakAdaRiwayat">
        <label class="form-check-label" for="tidakAdaRiwayat">Tidak ada riwayat penyakit</label>
    </div>
</div>

<!-- Step 5: Skrining Kesehatan -->
<div class="wizard-step" id="step5">
    <h4 class="mb-4">Tahap 5: Skrining Kesehatan</h4>
    
    <div class="mb-4">
        <label class="form-label">Tempat Persalinan *</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_persalinan" value="Puskesmas atau Klinik Kesehatan" id="t1" required>
            <label class="form-check-label" for="t1">Puskesmas atau Klinik Kesehatan</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_persalinan" value="Rumah Sakit (RS) terdekat" id="t2">
            <label class="form-check-label" for="t2">Rumah Sakit (RS) terdekat</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_persalinan" value="Bidan Praktik Mandiri di Desa" id="t3">
            <label class="form-check-label" for="t3">Bidan Praktik Mandiri di Desa</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="tempat_persalinan" value="Rumah Bersalin (RB) atau Klinik Bersalin" id="t4">
            <label class="form-check-label" for="t4">Rumah Bersalin (RB) atau Klinik Bersalin</label>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label">Penolong Persalinan *</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penolong_persalinan" value="Dokter Spesialis Kandungan" id="p1" required>
            <label class="form-check-label" for="p1">Dokter Spesialis Kandungan</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penolong_persalinan" value="Bidan Bersertifikat" id="p2">
            <label class="form-check-label" for="p2">Bidan Bersertifikat</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penolong_persalinan" value="Dokter Umum yang bertugas di Puskesmas" id="p3">
            <label class="form-check-label" for="p3">Dokter Umum yang bertugas di Puskesmas</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penolong_persalinan" value="Tenaga Kesehatan Terlatih" id="p4">
            <label class="form-check-label" for="p4">Tenaga Kesehatan Terlatih</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="penolong_persalinan" value="Dukun Beranak/Tradisional" id="p5">
            <label class="form-check-label" for="p5">Dukun Beranak/Tradisional</label>
        </div>
    </div>
</div>

<!-- Step 6: Suplementasi -->
<div class="wizard-step" id="step6">
    <h4 class="mb-4">Tahap 6: Penggunaan Tablet Tambah Darah atau Suplementasi Kehamilan</h4>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nama Suplemen *</label>
            <input type="text" name="nama_suplemen" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Status Pemberian *</label>
            <select name="status_pemberian" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="sudah_diberikan">Sudah diberikan</option>
                <option value="belum_diberikan">Belum diberikan</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Jumlah Tablet yang Diberikan</label>
            <input type="number" name="jumlah_tablet" class="form-control" min="0">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Frekuensi Pemberian *</label>
            <select name="frekuensi" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="1x sehari">1x sehari</option>
                <option value="2x sehari">2x sehari</option>
                <option value="3x sehari">3x sehari</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Catatan Khusus (Efek Samping)</label>
        <div class="row">
            <div class="col-md-6">
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Mual" id="e1"><label class="form-check-label" for="e1">Mual</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Muntah" id="e2"><label class="form-check-label" for="e2">Muntah</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Diare" id="e3"><label class="form-check-label" for="e3">Diare</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Sembelit" id="e4"><label class="form-check-label" for="e4">Sembelit (susah BAB)</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Nyeri perut" id="e5"><label class="form-check-label" for="e5">Nyeri atau tidak nyaman pada perut</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Tinja hitam" id="e6"><label class="form-check-label" for="e6">Perubahan warna tinja menjadi hitam</label></div>
            </div>
            <div class="col-md-6">
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Rasa logam" id="e7"><label class="form-check-label" for="e7">Perubahan rasa mulut (rasa logam)</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Kehilangan nafsu makan" id="e8"><label class="form-check-label" for="e8">Kehilangan nafsu makan</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Reaksi alergi" id="e9"><label class="form-check-label" for="e9">Reaksi alergi (gatal, ruam, bengkak)</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Pusing" id="e10"><label class="form-check-label" for="e10">Efek pusing atau kepala ringan</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="efek_samping[]" value="Tidak ada" id="e11"><label class="form-check-label" for="e11">Tidak ada efek samping</label></div>
            </div>
        </div>
    </div>
</div>

<!-- Step 7: Etnomedisin -->
<div class="wizard-step" id="step7">
    <h4 class="mb-4">Tahap 7: Penggunaan Etnomedisin</h4>
    
    <div class="mb-4">
        <label class="form-label">Apakah ibu hamil menggunakan obat tradisional? *</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="menggunakan_obat_tradisional" value="ya" id="etno_ya" onchange="toggleEtnomedisin(true)" required>
            <label class="form-check-label" for="etno_ya">Ya</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="menggunakan_obat_tradisional" value="tidak" id="etno_tidak" onchange="toggleEtnomedisin(false)">
            <label class="form-check-label" for="etno_tidak">Tidak</label>
        </div>
    </div>

    <div id="etnomedisinForm" style="display:none;">
        <div class="mb-3">
            <label class="form-label">Jenis obat tradisional yang digunakan</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Jahe" id="j1"><label class="form-check-label" for="j1">Jahe</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Kunyit" id="j2"><label class="form-check-label" for="j2">Kunyit</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Habbatussauda" id="j3"><label class="form-check-label" for="j3">Habbatussauda</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Daun Ketari" id="j4"><label class="form-check-label" for="j4">Daun Ketari</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Kayu Manis" id="j5"><label class="form-check-label" for="j5">Kayu Manis</label></div>
                </div>
                <div class="col-md-6">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Daun Selasih" id="j6"><label class="form-check-label" for="j6">Daun Selasih</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Minyak Kelapa" id="j7"><label class="form-check-label" for="j7">Minyak Kelapa</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="jenis_obat[]" value="Pasak Bumi" id="j8"><label class="form-check-label" for="j8">Pasak Bumi</label></div>
                    <div class="form-check mb-2"><input class="form-check-input" type="checkbox" value="1" id="j9"><label class="form-check-label" for="j9">Lainnya</label></div>
                    <input type="text" name="jenis_obat_lainnya" class="form-control" id="obatLainnya" placeholder="Sebutkan jenis obat lainnya...">
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Tujuan penggunaan</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Mengatasi mual" id="tu1"><label class="form-check-label" for="tu1">Mengatasi mual</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Menguatkan kandungan" id="tu2"><label class="form-check-label" for="tu2">Menguatkan kandungan</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Mengurangi nyeri" id="tu3"><label class="form-check-label" for="tu3">Mengurangi nyeri</label></div>
                </div>
                <div class="col-md-6">
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Mengatasi keputihan" id="tu4"><label class="form-check-label" for="tu4">Mengatasi keputihan</label></div>
                    <div class="form-check"><input class="form-check-input" type="checkbox" name="tujuan_penggunaan[]" value="Menjaga stamina ibu hamil" id="tu5"><label class="form-check-label" for="tu5">Menjaga stamina ibu hamil</label></div>
                    <div class="form-check mb-2"><input class="form-check-input" type="checkbox" value="1" id="tu6"><label class="form-check-label" for="tu6">Lainnya</label></div>
                    <input type="text" name="tujuan_lainnya" class="form-control" id="tujuanLainnya" placeholder="Sebutkan tujuan lainnya...">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Dosis dan frekuensi penggunaan</label>
                <select name="dosis_frekuensi" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option value="Setiap hari">Setiap hari</option>
                    <option value="2-3 kali seminggu">2-3 kali seminggu</option>
                    <option value="Mingguan">Mingguan</option>
                    <option value="Sesuai kebutuhan">Sesuai kebutuhan</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Edukasi tentang manfaat dan risiko</label>
                <select name="edukasi_diberikan" class="form-select">
                    <option value="">-- Pilih --</option>
                    <option value="sudah">Sudah diberi edukasi</option>
                    <option value="belum">Belum diberi edukasi</option>
                </select>
            </div>
        </div>
    </div>
</div>
