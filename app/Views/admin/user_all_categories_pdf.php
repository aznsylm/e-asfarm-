<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Monitoring Lengkap</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 10pt; margin: 20px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #047d78; padding-bottom: 10px; }
        .header h2 { margin: 5px 0; color: #047d78; font-size: 16pt; }
        .header h3 { margin: 5px 0; color: #555; font-size: 12pt; }
        .info-table { width: 100%; margin-bottom: 15px; border-collapse: collapse; }
        .info-table td { padding: 5px; border: 1px solid #ddd; }
        .info-table td:first-child { background: #f5f5f5; font-weight: bold; width: 30%; }
        .section-title { background: #047d78; color: white; padding: 8px; margin: 20px 0 10px 0; font-weight: bold; font-size: 12pt; }
        .identity-box { border: 1px solid #ddd; padding: 10px; margin-bottom: 15px; background: #f9f9f9; }
        .identity-box table { width: 100%; }
        .identity-box td { padding: 3px 5px; }
        .identity-box td:first-child { font-weight: bold; width: 35%; }
        .kunjungan-box { border: 1px solid #047d78; padding: 10px; margin-bottom: 10px; page-break-inside: avoid; }
        .kunjungan-box h4 { margin: 0 0 8px 0; color: #047d78; font-size: 11pt; }
        .kunjungan-box table { width: 100%; font-size: 9pt; }
        .kunjungan-box td { padding: 2px 5px; vertical-align: top; }
        .kunjungan-box td:first-child { font-weight: bold; width: 30%; }
        .footer { margin-top: 30px; padding-top: 10px; border-top: 1px solid #ddd; font-size: 8pt; color: #666; text-align: center; }
        .no-data { text-align: center; padding: 20px; color: #999; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM INFORMASI MONITORING KESEHATAN</h2>
        <h3>Laporan Monitoring Lengkap - <?= esc($user['username']) ?></h3>
    </div>

    <table class="info-table">
        <tr><td>Padukuhan</td><td><?= esc($adminInfo['nama_padukuhan'] ?? '-') ?></td></tr>
        <tr><td>Admin</td><td><?= esc($adminInfo['username'] ?? '-') ?></td></tr>
        <tr><td>No. Telepon</td><td><?= esc($adminInfo['phone_number'] ?? '-') ?></td></tr>
        <tr><td>Tanggal Export</td><td><?= date('d-m-Y') ?></td></tr>
    </table>

    <!-- IBU HAMIL -->
    <div class="section-title">DATA IBU HAMIL & MENYUSUI</div>
    <?php if ($dataIbuHamil): ?>
        <div class="identity-box">
            <table>
                <tr><td>Nama Ibu</td><td><?= esc($dataIbuHamil['identitas']['nama_ibu']) ?></td></tr>
                <tr><td>Nama Suami</td><td><?= esc($dataIbuHamil['identitas']['nama_suami'] ?? '-') ?></td></tr>
                <tr><td>Usia Ibu</td><td><?= esc($dataIbuHamil['identitas']['usia_ibu'] ?? '-') ?> tahun</td></tr>
                <tr><td>Usia Suami</td><td><?= esc($dataIbuHamil['identitas']['usia_suami'] ?? '-') ?> tahun</td></tr>
                <tr><td>Usia Kehamilan</td><td><?= esc($dataIbuHamil['identitas']['usia_kehamilan']) ?> minggu</td></tr>
                <tr><td>HPL</td><td><?= date('d-m-Y', strtotime($dataIbuHamil['identitas']['rencana_tanggal_persalinan'])) ?></td></tr>
                <tr><td>Alamat</td><td><?= esc($dataIbuHamil['identitas']['alamat'] ?? '-') ?></td></tr>
                <tr><td>No. Telepon</td><td><?= esc($dataIbuHamil['identitas']['nomor_telepon'] ?? '-') ?></td></tr>
            </table>
        </div>

        <?php if (!empty($dataIbuHamil['riwayat'])): ?>
        <p style="margin: 10px 0 5px 0; font-weight: bold;">Riwayat Penyakit:</p>
        <div style="margin-left: 15px; font-size: 9pt;">
            <?php
            $riwayat = [];
            if (!empty($dataIbuHamil['riwayat']['hipertensi'])) $riwayat[] = 'Hipertensi';
            if (!empty($dataIbuHamil['riwayat']['diabetes'])) $riwayat[] = 'Diabetes';
            if (!empty($dataIbuHamil['riwayat']['jantung'])) $riwayat[] = 'Penyakit Jantung';
            if (!empty($dataIbuHamil['riwayat']['asma'])) $riwayat[] = 'Asma';
            if (!empty($dataIbuHamil['riwayat']['riwayat_penyakit'])) $riwayat[] = esc($dataIbuHamil['riwayat']['riwayat_penyakit']);
            echo !empty($riwayat) ? implode(', ', $riwayat) : 'Tidak ada riwayat penyakit';
            ?>
        </div>
        <?php endif; ?>

        <?php foreach ($dataIbuHamil['kunjungan'] as $k): ?>
        <div class="kunjungan-box">
            <h4>Kunjungan ke-<?= $k['kunjungan_ke'] ?> - <?= date('d-m-Y', strtotime($k['tanggal_kunjungan'])) ?></h4>
            <table>
                <?php if ($k['antropometri']): ?>
                <tr><td>Tekanan Darah</td><td><?= esc($k['antropometri']['tekanan_darah']) ?></td></tr>
                <tr><td>Berat Badan</td><td><?= esc($k['antropometri']['berat_badan']) ?> kg</td></tr>
                <tr><td>Tinggi Badan</td><td><?= esc($k['antropometri']['tinggi_badan']) ?> cm</td></tr>
                <tr><td>LILA</td><td><?= esc($k['antropometri']['lila']) ?> cm</td></tr>
                <?php endif; ?>
                <?php if ($k['keluhan']): ?>
                <tr><td>Keluhan</td><td>
                    <?php
                    if (!empty($k['keluhan']['keluhan'])) {
                        $keluhan = str_replace(['[', ']', '"'], '', $k['keluhan']['keluhan']);
                        echo esc($keluhan);
                    } else {
                        echo 'Tidak ada keluhan';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['suplementasi']): ?>
                <tr><td>Suplementasi</td><td>
                    <?php
                    $sup = [];
                    if (!empty($k['suplementasi']['nama_suplemen'])) $sup[] = 'Suplemen: ' . esc($k['suplementasi']['nama_suplemen']);
                    if (!empty($k['suplementasi']['status_pemberian'])) $sup[] = 'Status: ' . esc($k['suplementasi']['status_pemberian']);
                    if (!empty($k['suplementasi']['jumlah_tablet'])) $sup[] = 'Jumlah: ' . esc($k['suplementasi']['jumlah_tablet']) . ' tablet';
                    if (!empty($k['suplementasi']['frekuensi'])) $sup[] = 'Frekuensi: ' . esc($k['suplementasi']['frekuensi']);
                    echo !empty($sup) ? implode(', ', $sup) : 'Tidak ada';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['etnomedisin']): ?>
                <tr><td>Etnomedisin</td><td>
                    <?php
                    if (!empty($k['etnomedisin']['menggunakan_obat_tradisional'])) {
                        $etno = [];
                        if (!empty($k['etnomedisin']['jenis_obat'])) {
                            $jenis = str_replace(['[', ']', '"'], '', $k['etnomedisin']['jenis_obat']);
                            $etno[] = 'Jenis: ' . esc($jenis);
                        }
                        if (!empty($k['etnomedisin']['tujuan_penggunaan'])) {
                            $tujuan = str_replace(['[', ']', '"'], '', $k['etnomedisin']['tujuan_penggunaan']);
                            $etno[] = 'Tujuan: ' . esc($tujuan);
                        }
                        echo !empty($etno) ? implode(', ', $etno) : 'Menggunakan obat tradisional';
                    } else {
                        echo 'Tidak menggunakan';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
            </table>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-data">Tidak ada data monitoring ibu hamil</div>
    <?php endif; ?>

    <!-- BALITA -->
    <div class="section-title" style="margin-top: 30px;">DATA BALITA & ANAK</div>
    <?php if ($dataBalita): ?>
        <div class="identity-box">
            <table>
                <tr><td>Nama Anak</td><td><?= esc($dataBalita['identitas']['nama_anak']) ?></td></tr>
                <tr><td>Tanggal Lahir</td><td><?= date('d-m-Y', strtotime($dataBalita['identitas']['tanggal_lahir'])) ?></td></tr>
                <tr><td>Jenis Kelamin</td><td><?= !empty($dataBalita['identitas']['jenis_kelamin']) ? ($dataBalita['identitas']['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-' ?></td></tr>
                <tr><td>Nama Wali</td><td><?= esc($dataBalita['identitas']['nama_wali'] ?? '-') ?></td></tr>
                <tr><td>No. HP Wali</td><td><?= esc($dataBalita['identitas']['no_hp_wali'] ?? '-') ?></td></tr>
            </table>
        </div>

        <?php foreach ($dataBalita['kunjungan'] as $k): ?>
        <div class="kunjungan-box">
            <h4>Kunjungan ke-<?= $k['kunjungan_ke'] ?> - <?= date('d-m-Y', strtotime($k['tanggal_kunjungan'])) ?></h4>
            <table>
                <?php if ($k['antropometri']): ?>
                <tr><td>Berat Badan</td><td><?= esc($k['antropometri']['berat_badan']) ?> kg</td></tr>
                <tr><td>Tinggi Badan</td><td><?= esc($k['antropometri']['tinggi_badan']) ?> cm</td></tr>
                <tr><td>Lingkar Kepala</td><td><?= esc($k['antropometri']['lingkar_kepala'] ?? '-') ?> cm</td></tr>
                <?php endif; ?>
                <?php if ($k['keluhan']): ?>
                <tr><td>Keluhan</td><td>
                    <?php
                    $keluhan = [];
                    if (!empty($k['keluhan']['batuk'])) $keluhan[] = 'Batuk';
                    if (!empty($k['keluhan']['pilek'])) $keluhan[] = 'Pilek';
                    if (!empty($k['keluhan']['demam'])) $keluhan[] = 'Demam';
                    if (!empty($k['keluhan']['diare'])) $keluhan[] = 'Diare';
                    if (!empty($k['keluhan']['sembelit'])) $keluhan[] = 'Sembelit';
                    if (!empty($k['keluhan']['gtm'])) $keluhan[] = 'GTM';
                    if (!empty($k['keluhan']['lainnya'])) $keluhan[] = esc($k['keluhan']['lainnya']);
                    echo !empty($keluhan) ? implode(', ', $keluhan) : 'Tidak ada keluhan';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['imunisasi']): ?>
                <tr><td>Imunisasi & Alergi</td><td>
                    <?php
                    $imun = [];
                    if (!empty($k['imunisasi']['status_imunisasi'])) $imun[] = 'Status: ' . esc($k['imunisasi']['status_imunisasi']);
                    if (!empty($k['imunisasi']['riwayat_alergi'])) $imun[] = 'Alergi: ' . esc($k['imunisasi']['riwayat_alergi']);
                    echo !empty($imun) ? implode(', ', $imun) : 'Tidak ada data';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['swamedikasi']): ?>
                <tr><td>Swamedikasi</td><td>
                    <?php
                    $swamed = [];
                    if (!empty($k['swamedikasi']['ke_nakes'])) $swamed[] = 'Ke Nakes';
                    if (!empty($k['swamedikasi']['obat_modern'])) $swamed[] = 'Obat Modern';
                    if (!empty($k['swamedikasi']['antibiotik'])) $swamed[] = 'Antibiotik';
                    if (!empty($k['swamedikasi']['etnomedisin'])) $swamed[] = 'Etnomedisin';
                    echo !empty($swamed) ? implode(', ', $swamed) : 'Tidak ada';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['gizi']): ?>
                <tr><td>Vitamin A</td><td><?= !empty($k['gizi']['vitamin_a']) ? 'Sudah' : 'Belum' ?></td></tr>
                <tr><td>Obat Cacing</td><td><?= !empty($k['gizi']['obat_cacing']) ? 'Sudah' : 'Belum' ?></td></tr>
                <?php if (!empty($k['gizi']['pola_makan'])): ?>
                <tr><td>Pola Makan</td><td><?= esc(str_replace(['[', ']', '"'], '', $k['gizi']['pola_makan'])) ?></td></tr>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($k['kpsp']): ?>
                <tr><td>Hasil KPSP</td><td><?= esc($k['kpsp']['hasil_skrining'] ?? '-') ?></td></tr>
                <?php endif; ?>
            </table>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-data">Tidak ada data monitoring balita</div>
    <?php endif; ?>

    <!-- REMAJA -->
    <div class="section-title" style="margin-top: 30px;">DATA REMAJA</div>
    <?php if ($dataRemaja): ?>
        <div class="identity-box">
            <table>
                <tr><td>Nama Lengkap</td><td><?= esc($dataRemaja['identitas']['nama_lengkap']) ?></td></tr>
                <tr><td>NIK</td><td><?= esc($dataRemaja['identitas']['nik'] ?? '-') ?></td></tr>
                <tr><td>Tanggal Lahir</td><td><?= date('d-m-Y', strtotime($dataRemaja['identitas']['tanggal_lahir'])) ?></td></tr>
                <tr><td>Jenis Kelamin</td><td><?= !empty($dataRemaja['identitas']['jenis_kelamin']) ? ($dataRemaja['identitas']['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-' ?></td></tr>
                <tr><td>Nama Wali</td><td><?= esc($dataRemaja['identitas']['nama_wali'] ?? '-') ?></td></tr>
                <tr><td>No. HP Wali</td><td><?= esc($dataRemaja['identitas']['no_hp_wali'] ?? '-') ?></td></tr>
            </table>
        </div>

        <?php foreach ($dataRemaja['kunjungan'] as $k): ?>
        <div class="kunjungan-box">
            <h4>Kunjungan ke-<?= $k['kunjungan_ke'] ?> - <?= date('d-m-Y', strtotime($k['tanggal_kunjungan'])) ?></h4>
            <table>
                <?php if ($k['antropometri']): ?>
                <tr><td>Berat Badan</td><td><?= esc($k['antropometri']['berat_badan']) ?> kg</td></tr>
                <tr><td>Tinggi Badan</td><td><?= esc($k['antropometri']['tinggi_badan']) ?> cm</td></tr>
                <tr><td>Tekanan Darah</td><td><?= esc($k['antropometri']['tekanan_darah']) ?></td></tr>
                <tr><td>Lingkar Perut</td><td><?= esc($k['antropometri']['lingkar_perut'] ?? '-') ?> cm</td></tr>
                <?php endif; ?>
                <?php if ($k['anemia']): ?>
                <tr><td>Gejala Anemia</td><td>
                    <?php
                    if (!empty($k['anemia']['gejala_anemia'])) {
                        $gejala = str_replace(['[', ']', '"'], '', $k['anemia']['gejala_anemia']);
                        echo esc($gejala);
                    } else {
                        echo 'Tidak ada gejala';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['suplementasi']): ?>
                <tr><td>Suplementasi</td><td>
                    <?php
                    $sup = [];
                    if (!empty($k['suplementasi']['dapat_ttd'])) $sup[] = 'Dapat TTD';
                    if (!empty($k['suplementasi']['minum_ttd'])) $sup[] = 'Minum TTD';
                    if (!empty($k['suplementasi']['kebiasaan_sarapan'])) $sup[] = 'Sarapan: ' . esc($k['suplementasi']['kebiasaan_sarapan']);
                    echo !empty($sup) ? implode(', ', $sup) : 'Tidak ada data';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['gaya_hidup']): ?>
                <tr><td>Gaya Hidup & Risiko PTM</td><td>
                    <?php
                    if (!empty($k['gaya_hidup']['risiko_ptm'])) {
                        $risiko = str_replace(['[', ']', '"'], '', $k['gaya_hidup']['risiko_ptm']);
                        echo esc($risiko);
                    } else {
                        echo 'Tidak ada data';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['swamedikasi']): ?>
                <tr><td>Perilaku Swamedikasi</td><td>
                    <?php
                    if (!empty($k['swamedikasi']['perilaku_swamedikasi'])) {
                        $swamed = str_replace(['[', ']', '"'], '', $k['swamedikasi']['perilaku_swamedikasi']);
                        echo esc($swamed);
                    } else {
                        echo 'Tidak ada data';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($k['haid'] && !empty($dataRemaja['identitas']['jenis_kelamin']) && $dataRemaja['identitas']['jenis_kelamin'] == 'P'): ?>
                <tr><td>Data Menstruasi</td><td>
                    <?php
                    $haidInfo = [];
                    if (!empty($k['haid']['sudah_menstruasi'])) $haidInfo[] = 'Sudah menstruasi: ' . ucfirst($k['haid']['sudah_menstruasi']);
                    if (!empty($k['haid']['keteraturan_haid'])) $haidInfo[] = 'Keteraturan: ' . esc($k['haid']['keteraturan_haid']);
                    if (!empty($k['haid']['nyeri_haid'])) $haidInfo[] = 'Nyeri: ' . ucfirst($k['haid']['nyeri_haid']);
                    echo !empty($haidInfo) ? implode(', ', $haidInfo) : '-';
                    ?>
                </td></tr>
                <?php endif; ?>
            </table>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="no-data">Tidak ada data monitoring remaja</div>
    <?php endif; ?>

    <div class="footer">
        <p><strong>Disclaimer:</strong> Dokumen ini bersifat rahasia dan hanya untuk keperluan monitoring kesehatan. Dilarang menyebarluaskan tanpa izin.</p>
        <p>Dicetak pada: <?= date('d-m-Y H:i:s') ?> | Sistem Informasi Monitoring Kesehatan e-Asfarm</p>
    </div>
</body>
</html>
