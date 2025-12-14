<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Monitoring - Kunjungan Terakhir</title>
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
        <h3>Laporan Kunjungan Terakhir - <?= esc($user['username']) ?></h3>
    </div>

    <table class="info-table">
        <tr><td>Username</td><td><?= esc($user['username']) ?></td></tr>
        <tr><td>Email</td><td><?= esc($user['email']) ?></td></tr>
        <tr><td>No. WhatsApp</td><td><?= esc($user['phone_number'] ?? '-') ?></td></tr>
        <tr><td>Padukuhan</td><td><?= $padukuhan ? esc($padukuhan['nama_padukuhan']) : '-' ?></td></tr>
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

        <div class="kunjungan-box">
            <h4>Kunjungan ke-<?= $dataIbuHamil['kunjungan']['kunjungan_ke'] ?> - <?= date('d-m-Y', strtotime($dataIbuHamil['kunjungan']['tanggal_kunjungan'])) ?></h4>
            <table>
                <?php if ($dataIbuHamil['antropometri']): ?>
                <tr><td>Tekanan Darah</td><td><?= esc($dataIbuHamil['antropometri']['tekanan_darah']) ?></td></tr>
                <tr><td>Berat Badan</td><td><?= esc($dataIbuHamil['antropometri']['berat_badan']) ?> kg</td></tr>
                <tr><td>Tinggi Badan</td><td><?= esc($dataIbuHamil['antropometri']['tinggi_badan']) ?> cm</td></tr>
                <tr><td>LILA</td><td><?= esc($dataIbuHamil['antropometri']['lila']) ?> cm</td></tr>
                <?php endif; ?>
                <?php if ($dataIbuHamil['keluhan']): ?>
                <tr><td>Keluhan</td><td>
                    <?php
                    if (!empty($dataIbuHamil['keluhan']['keluhan'])) {
                        $keluhan = str_replace(['[', ']', '"'], '', $dataIbuHamil['keluhan']['keluhan']);
                        echo esc($keluhan);
                    } else {
                        echo 'Tidak ada keluhan';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataIbuHamil['suplementasi']): ?>
                <tr><td>Suplementasi</td><td>
                    <?php
                    $sup = [];
                    if (!empty($dataIbuHamil['suplementasi']['nama_suplemen'])) $sup[] = 'Suplemen: ' . esc($dataIbuHamil['suplementasi']['nama_suplemen']);
                    if (!empty($dataIbuHamil['suplementasi']['status_pemberian'])) $sup[] = 'Status: ' . esc($dataIbuHamil['suplementasi']['status_pemberian']);
                    if (!empty($dataIbuHamil['suplementasi']['jumlah_tablet'])) $sup[] = 'Jumlah: ' . esc($dataIbuHamil['suplementasi']['jumlah_tablet']) . ' tablet';
                    if (!empty($dataIbuHamil['suplementasi']['frekuensi'])) $sup[] = 'Frekuensi: ' . esc($dataIbuHamil['suplementasi']['frekuensi']);
                    echo !empty($sup) ? implode(', ', $sup) : 'Tidak ada';
                    ?>
                </td></tr>
                <?php endif; ?>
            </table>
        </div>
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

        <div class="kunjungan-box">
            <h4>Kunjungan ke-<?= $dataBalita['kunjungan']['kunjungan_ke'] ?> - <?= date('d-m-Y', strtotime($dataBalita['kunjungan']['tanggal_kunjungan'])) ?></h4>
            <table>
                <?php if ($dataBalita['antropometri']): ?>
                <tr><td>Berat Badan</td><td><?= esc($dataBalita['antropometri']['berat_badan']) ?> kg</td></tr>
                <tr><td>Tinggi Badan</td><td><?= esc($dataBalita['antropometri']['tinggi_badan']) ?> cm</td></tr>
                <tr><td>Lingkar Kepala</td><td><?= esc($dataBalita['antropometri']['lingkar_kepala'] ?? '-') ?> cm</td></tr>
                <?php endif; ?>
                <?php if ($dataBalita['keluhan']): ?>
                <tr><td>Keluhan</td><td>
                    <?php
                    $keluhan = [];
                    if (!empty($dataBalita['keluhan']['batuk'])) $keluhan[] = 'Batuk';
                    if (!empty($dataBalita['keluhan']['pilek'])) $keluhan[] = 'Pilek';
                    if (!empty($dataBalita['keluhan']['demam'])) $keluhan[] = 'Demam';
                    if (!empty($dataBalita['keluhan']['diare'])) $keluhan[] = 'Diare';
                    if (!empty($dataBalita['keluhan']['sembelit'])) $keluhan[] = 'Sembelit';
                    if (!empty($dataBalita['keluhan']['gtm'])) $keluhan[] = 'GTM';
                    if (!empty($dataBalita['keluhan']['lainnya'])) $keluhan[] = esc($dataBalita['keluhan']['lainnya']);
                    echo !empty($keluhan) ? implode(', ', $keluhan) : 'Tidak ada keluhan';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataBalita['imunisasi']): ?>
                <tr><td>Imunisasi & Alergi</td><td>
                    <?php
                    $imun = [];
                    if (!empty($dataBalita['imunisasi']['status_imunisasi'])) $imun[] = 'Status: ' . esc($dataBalita['imunisasi']['status_imunisasi']);
                    if (!empty($dataBalita['imunisasi']['riwayat_alergi'])) $imun[] = 'Alergi: ' . esc($dataBalita['imunisasi']['riwayat_alergi']);
                    echo !empty($imun) ? implode(', ', $imun) : 'Tidak ada data';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataBalita['swamedikasi']): ?>
                <tr><td>Swamedikasi</td><td>
                    <?php
                    $swamed = [];
                    if (!empty($dataBalita['swamedikasi']['ke_nakes'])) $swamed[] = 'Ke Nakes';
                    if (!empty($dataBalita['swamedikasi']['obat_modern'])) $swamed[] = 'Obat Modern';
                    if (!empty($dataBalita['swamedikasi']['antibiotik'])) $swamed[] = 'Antibiotik';
                    if (!empty($dataBalita['swamedikasi']['etnomedisin'])) $swamed[] = 'Etnomedisin';
                    echo !empty($swamed) ? implode(', ', $swamed) : 'Tidak ada';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataBalita['gizi']): ?>
                <tr><td>Vitamin A</td><td><?= !empty($dataBalita['gizi']['vitamin_a']) ? 'Sudah' : 'Belum' ?></td></tr>
                <tr><td>Obat Cacing</td><td><?= !empty($dataBalita['gizi']['obat_cacing']) ? 'Sudah' : 'Belum' ?></td></tr>
                <?php if (!empty($dataBalita['gizi']['pola_makan'])): ?>
                <tr><td>Pola Makan</td><td><?= esc(str_replace(['[', ']', '"'], '', $dataBalita['gizi']['pola_makan'])) ?></td></tr>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($dataBalita['kpsp']): ?>
                <tr><td>Hasil KPSP</td><td><?= esc($dataBalita['kpsp']['hasil_skrining'] ?? '-') ?></td></tr>
                <?php endif; ?>
            </table>
        </div>
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

        <div class="kunjungan-box">
            <h4>Kunjungan ke-<?= $dataRemaja['kunjungan']['kunjungan_ke'] ?> - <?= date('d-m-Y', strtotime($dataRemaja['kunjungan']['tanggal_kunjungan'])) ?></h4>
            <table>
                <?php if ($dataRemaja['antropometri']): ?>
                <tr><td>Berat Badan</td><td><?= esc($dataRemaja['antropometri']['berat_badan']) ?> kg</td></tr>
                <tr><td>Tinggi Badan</td><td><?= esc($dataRemaja['antropometri']['tinggi_badan']) ?> cm</td></tr>
                <tr><td>Tekanan Darah</td><td><?= esc($dataRemaja['antropometri']['tekanan_darah']) ?></td></tr>
                <tr><td>Lingkar Perut</td><td><?= esc($dataRemaja['antropometri']['lingkar_perut'] ?? '-') ?> cm</td></tr>
                <?php endif; ?>
                <?php if ($dataRemaja['anemia']): ?>
                <tr><td>Gejala Anemia</td><td>
                    <?php
                    if (!empty($dataRemaja['anemia']['gejala_anemia'])) {
                        $gejala = str_replace(['[', ']', '"'], '', $dataRemaja['anemia']['gejala_anemia']);
                        echo esc($gejala);
                    } else {
                        echo 'Tidak ada gejala';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataRemaja['suplementasi']): ?>
                <tr><td>Suplementasi</td><td>
                    <?php
                    $sup = [];
                    if (!empty($dataRemaja['suplementasi']['dapat_ttd'])) $sup[] = 'Dapat TTD';
                    if (!empty($dataRemaja['suplementasi']['minum_ttd'])) $sup[] = 'Minum TTD';
                    if (!empty($dataRemaja['suplementasi']['kebiasaan_sarapan'])) $sup[] = 'Sarapan: ' . esc($dataRemaja['suplementasi']['kebiasaan_sarapan']);
                    echo !empty($sup) ? implode(', ', $sup) : 'Tidak ada data';
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataRemaja['gaya_hidup']): ?>
                <tr><td>Gaya Hidup & Risiko PTM</td><td>
                    <?php
                    if (!empty($dataRemaja['gaya_hidup']['risiko_ptm'])) {
                        $risiko = str_replace(['[', ']', '"'], '', $dataRemaja['gaya_hidup']['risiko_ptm']);
                        echo esc($risiko);
                    } else {
                        echo 'Tidak ada data';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataRemaja['swamedikasi']): ?>
                <tr><td>Perilaku Swamedikasi</td><td>
                    <?php
                    if (!empty($dataRemaja['swamedikasi']['perilaku_swamedikasi'])) {
                        $swamed = str_replace(['[', ']', '"'], '', $dataRemaja['swamedikasi']['perilaku_swamedikasi']);
                        echo esc($swamed);
                    } else {
                        echo 'Tidak ada data';
                    }
                    ?>
                </td></tr>
                <?php endif; ?>
                <?php if ($dataRemaja['haid'] && !empty($dataRemaja['identitas']['jenis_kelamin']) && $dataRemaja['identitas']['jenis_kelamin'] == 'P'): ?>
                <tr><td>Data Menstruasi</td><td>
                    <?php
                    $haidInfo = [];
                    if (!empty($dataRemaja['haid']['sudah_menstruasi'])) $haidInfo[] = 'Sudah menstruasi: ' . ucfirst($dataRemaja['haid']['sudah_menstruasi']);
                    if (!empty($dataRemaja['haid']['keteraturan_haid'])) $haidInfo[] = 'Keteraturan: ' . esc($dataRemaja['haid']['keteraturan_haid']);
                    if (!empty($dataRemaja['haid']['nyeri_haid'])) $haidInfo[] = 'Nyeri: ' . ucfirst($dataRemaja['haid']['nyeri_haid']);
                    echo !empty($haidInfo) ? implode(', ', $haidInfo) : '-';
                    ?>
                </td></tr>
                <?php endif; ?>
            </table>
        </div>
    <?php else: ?>
        <div class="no-data">Tidak ada data monitoring remaja</div>
    <?php endif; ?>

    <div class="footer">
        <p><strong>Disclaimer:</strong> Dokumen ini bersifat rahasia dan hanya untuk keperluan monitoring kesehatan. Dilarang menyebarluaskan tanpa izin.</p>
        <p>Dicetak pada: <?= date('d-m-Y H:i:s') ?> | Sistem Informasi Monitoring Kesehatan e-Asfarm</p>
    </div>
</body>
</html>
