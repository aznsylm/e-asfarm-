<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail Monitoring</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 20px; }
        h2 { color: #047d78; border-bottom: 2px solid #047d78; padding-bottom: 5px; margin-top: 20px; margin-bottom: 10px; font-size: 14px; }
        h3 { color: #047d78; font-size: 12px; margin-top: 15px; margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        th { background-color: #047d78; color: white; padding: 8px; text-align: left; font-size: 10px; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; font-size: 10px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .info-table { background-color: #f9f9f9; }
        .info-table td { border: none; }
        .kunjungan-box { border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; background-color: #fafafa; }
        .footer { margin-top: 20px; font-size: 9px; color: #666; border-top: 1px solid #ddd; padding-top: 8px; text-align: center; }
    </style>
</head>
<body>
    <?php if($tab === 'ibu-hamil'): ?>
        <?php 
        $title = 'LAPORAN DETAIL MONITORING IBU HAMIL';
        $subtitle = esc($identitas['nama_ibu'] ?? '-');
        echo view('admin/monitoring/export_header', compact('title', 'subtitle', 'adminPadukuhan', 'adminName', 'adminPhone'));
        ?>
        <h2>DATA IDENTITAS</h2>
        <table class="info-table">
            <tr>
                <td width="25%"><strong>Nama Ibu</strong></td>
                <td width="25%"><?= esc($identitas['nama_ibu'] ?? '-') ?></td>
                <td width="25%"><strong>Nama Suami</strong></td>
                <td width="25%"><?= esc($identitas['nama_suami'] ?? '-') ?></td>
            </tr>
            <tr>
                <td><strong>Usia Ibu</strong></td>
                <td><?= esc($identitas['usia_ibu'] ?? '-') ?> tahun</td>
                <td><strong>Usia Suami</strong></td>
                <td><?= esc($identitas['usia_suami'] ?? '-') ?> tahun</td>
            </tr>
            <tr>
                <td><strong>Usia Kehamilan</strong></td>
                <td><?= esc($identitas['usia_kehamilan'] ?? '-') ?> minggu</td>
                <td><strong>Alamat</strong></td>
                <td><?= esc($identitas['alamat'] ?? '-') ?></td>
            </tr>
            <tr>
                <td><strong>Nomor Telepon</strong></td>
                <td><?= esc($identitas['nomor_telepon'] ?? '-') ?></td>
                <td><strong>Rencana Persalinan</strong></td>
                <td><?= isset($identitas['rencana_tanggal_persalinan']) ? date('d/m/Y', strtotime($identitas['rencana_tanggal_persalinan'])) : '-' ?></td>
            </tr>
            <?php if($skrining): ?>
            <tr>
                <td><strong>Tempat Persalinan</strong></td>
                <td><?= esc($skrining['tempat_persalinan'] ?? '-') ?></td>
                <td><strong>Penolong Persalinan</strong></td>
                <td><?= esc($skrining['penolong_persalinan'] ?? '-') ?></td>
            </tr>
            <?php endif; ?>
        </table>
        
        <?php if($riwayat): ?>
        <h2>RIWAYAT PENYAKIT</h2>
        <p style="margin: 5px 0; padding: 8px; background-color: #f9f9f9;">
            <?php if($riwayat['tidak_ada_riwayat'] === '1'): ?>
                <em>Tidak ada riwayat penyakit</em>
            <?php else: ?>
                <?= esc($riwayat['riwayat_penyakit']) ?>
            <?php endif; ?>
        </p>
        <?php endif; ?>
        
        <h2>RIWAYAT KUNJUNGAN (<?= count($kunjunganList) ?> Kunjungan)</h2>
        <?php foreach($kunjunganList as $idx => $k): ?>
        <div class="kunjungan-box">
            <h3>Kunjungan ke-<?= $k['kunjungan_ke'] ?> - <?= date('d/m/Y', strtotime($k['tanggal_kunjungan'])) ?></h3>
            
            <?php if($k['antropometri']): ?>
            <p style="margin: 5px 0;"><strong>Antropometri:</strong> 
                TD: <?= esc($k['antropometri']['tekanan_darah']) ?>, 
                BB: <?= esc($k['antropometri']['berat_badan']) ?> kg, 
                TB: <?= esc($k['antropometri']['tinggi_badan']) ?> cm, 
                LILA: <?= esc($k['antropometri']['lila']) ?> cm
            </p>
            <?php endif; ?>
            
            <?php if($k['keluhan']): ?>
            <p style="margin: 5px 0;"><strong>Keluhan:</strong> 
                <?= esc(str_replace(['[', ']', '"'], '', $k['keluhan']['keluhan'])) ?>
            </p>
            <?php endif; ?>
            
            <?php if($k['suplementasi']): ?>
            <p style="margin: 5px 0;"><strong>Suplementasi:</strong> 
                <?= esc($k['suplementasi']['nama_suplemen']) ?> - 
                <?= esc($k['suplementasi']['status_pemberian']) ?> 
                (<?= esc($k['suplementasi']['jumlah_tablet']) ?> tablet, <?= esc($k['suplementasi']['frekuensi']) ?>)
            </p>
            <?php endif; ?>
            
            <?php if($k['etnomedisin']): ?>
            <p style="margin: 5px 0;"><strong>Etnomedisin:</strong> 
                <?php if($k['etnomedisin']['menggunakan_obat_tradisional'] == '1'): ?>
                    Jenis: <?= esc(str_replace(['[', ']', '"'], '', $k['etnomedisin']['jenis_obat'] ?? '-')) ?>, 
                    Tujuan: <?= esc(str_replace(['[', ']', '"'], '', $k['etnomedisin']['tujuan_penggunaan'] ?? '-')) ?>
                <?php else: ?>
                    Tidak menggunakan obat tradisional
                <?php endif; ?>
            </p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        
    <?php elseif($tab === 'balita'): ?>
        <?php 
        $title = 'LAPORAN DETAIL MONITORING BALITA & ANAK';
        $subtitle = isset($identitas['nama_anak']) ? esc($identitas['nama_anak']) : '-';
        echo view('admin/monitoring/export_header', compact('title', 'subtitle', 'adminPadukuhan', 'adminName', 'adminPhone'));
        ?>
        
        <h2>DATA IDENTITAS</h2>
        <table class="info-table">
            <tr>
                <td width="25%"><strong>Nama Anak</strong></td>
                <td width="25%"><?= esc($identitas['nama_anak'] ?? '-') ?></td>
                <td width="25%"><strong>Tanggal Lahir</strong></td>
                <td width="25%"><?= isset($identitas['tanggal_lahir']) ? date('d/m/Y', strtotime($identitas['tanggal_lahir'])) : '-' ?></td>
            </tr>
            <tr>
                <td><strong>Jenis Kelamin</strong></td>
                <td><?= isset($identitas['jenis_kelamin']) ? ($identitas['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-' ?></td>
                <td><strong>Nama Wali</strong></td>
                <td><?= esc($identitas['nama_wali'] ?? '-') ?></td>
            </tr>
            <tr>
                <td><strong>No. HP Wali</strong></td>
                <td colspan="3"><?= esc($identitas['no_hp_wali'] ?? '-') ?></td>
            </tr>
        </table>
        
        <h2>RIWAYAT KUNJUNGAN (<?= count($kunjunganList) ?> Kunjungan)</h2>
        <?php foreach($kunjunganList as $idx => $kb): ?>
        <div class="kunjungan-box">
            <h3>Kunjungan ke-<?= $kb['kunjungan_ke'] ?> - <?= date('d/m/Y', strtotime($kb['tanggal_kunjungan'])) ?></h3>
            
            <?php if($kb['antropometri']): ?>
            <p style="margin: 5px 0;"><strong>Antropometri:</strong> 
                BB: <?= esc($kb['antropometri']['berat_badan']) ?> kg, 
                TB: <?= esc($kb['antropometri']['tinggi_badan']) ?> cm, 
                LK: <?= esc($kb['antropometri']['lingkar_kepala'] ?? '-') ?> cm
            </p>
            <?php endif; ?>
            
            <?php if($kb['keluhan']): ?>
            <p style="margin: 5px 0;"><strong>Keluhan:</strong> 
                <?php 
                $keluhanList = [];
                if($kb['keluhan']['batuk']) $keluhanList[] = 'Batuk';
                if($kb['keluhan']['pilek']) $keluhanList[] = 'Pilek';
                if($kb['keluhan']['demam']) $keluhanList[] = 'Demam';
                if($kb['keluhan']['diare']) $keluhanList[] = 'Diare';
                if($kb['keluhan']['sembelit']) $keluhanList[] = 'Sembelit';
                if($kb['keluhan']['gtm']) $keluhanList[] = 'GTM';
                if($kb['keluhan']['lainnya']) $keluhanList[] = esc($kb['keluhan']['lainnya']);
                echo !empty($keluhanList) ? implode(', ', $keluhanList) : 'Tidak ada keluhan';
                ?>
            </p>
            <?php endif; ?>
            
            <?php if($kb['imunisasi']): ?>
            <p style="margin: 5px 0;"><strong>Imunisasi & Alergi:</strong> 
                Status: <?= esc($kb['imunisasi']['status_imunisasi'] ?? '-') ?>, 
                Alergi: <?= esc($kb['imunisasi']['riwayat_alergi'] ?? '-') ?>
            </p>
            <?php endif; ?>
            
            <?php if($kb['swamedikasi']): ?>
            <p style="margin: 5px 0;"><strong>Swamedikasi:</strong> 
                <?php 
                $swamed = [];
                if($kb['swamedikasi']['ke_nakes']) $swamed[] = 'Ke Nakes';
                if($kb['swamedikasi']['obat_modern']) $swamed[] = 'Obat Modern';
                if($kb['swamedikasi']['antibiotik']) $swamed[] = 'Antibiotik';
                if($kb['swamedikasi']['etnomedisin']) $swamed[] = 'Etnomedisin';
                echo !empty($swamed) ? implode(', ', $swamed) : 'Tidak ada';
                ?>
            </p>
            <?php endif; ?>
            
            <?php if($kb['gizi']): ?>
            <p style="margin: 5px 0;"><strong>Data Gizi:</strong> 
                Vitamin A: <?= $kb['gizi']['vitamin_a'] ? 'Ya' : 'Tidak' ?>, 
                Obat Cacing: <?= $kb['gizi']['obat_cacing'] ? 'Ya' : 'Tidak' ?>
                <?php if($kb['gizi']['pola_makan']): ?>
                , Pola Makan: <?= esc(str_replace(['[', ']', '"'], '', $kb['gizi']['pola_makan'])) ?>
                <?php endif; ?>
            </p>
            <?php endif; ?>
            
            <?php if($kb['kpsp']): ?>
            <p style="margin: 5px 0;"><strong>Hasil KPSP:</strong> <?= esc($kb['kpsp']['hasil_skrining']) ?></p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
        
    <?php elseif($tab === 'remaja'): ?>
        <?php 
        $title = 'LAPORAN DETAIL MONITORING REMAJA';
        $subtitle = isset($identitas['nama_lengkap']) ? esc($identitas['nama_lengkap']) : '-';
        echo view('admin/monitoring/export_header', compact('title', 'subtitle', 'adminPadukuhan', 'adminName', 'adminPhone'));
        ?>
        
        <h2>DATA IDENTITAS</h2>
        <table class="info-table">
            <tr>
                <td width="25%"><strong>Nama Lengkap</strong></td>
                <td width="25%"><?= esc($identitas['nama_lengkap'] ?? '-') ?></td>
                <td width="25%"><strong>NIK</strong></td>
                <td width="25%"><?= esc($identitas['nik'] ?? '-') ?></td>
            </tr>
            <tr>
                <td><strong>Tanggal Lahir</strong></td>
                <td><?= isset($identitas['tanggal_lahir']) ? date('d/m/Y', strtotime($identitas['tanggal_lahir'])) : '-' ?></td>
                <td><strong>Jenis Kelamin</strong></td>
                <td><?= isset($identitas['jenis_kelamin']) ? ($identitas['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-' ?></td>
            </tr>
            <tr>
                <td><strong>Nama Wali</strong></td>
                <td><?= esc($identitas['nama_wali'] ?? '-') ?></td>
                <td><strong>No. HP Wali</strong></td>
                <td><?= esc($identitas['no_hp_wali'] ?? '-') ?></td>
            </tr>
        </table>
        
        <h2>RIWAYAT KUNJUNGAN (<?= count($kunjunganList) ?> Kunjungan)</h2>
        <?php foreach($kunjunganList as $idx => $kr): ?>
        <div class="kunjungan-box">
            <h3>Kunjungan ke-<?= $kr['kunjungan_ke'] ?> - <?= date('d/m/Y', strtotime($kr['tanggal_kunjungan'])) ?></h3>
            
            <?php if($kr['antropometri']): ?>
            <p style="margin: 5px 0;"><strong>Antropometri:</strong> 
                BB: <?= esc($kr['antropometri']['berat_badan']) ?> kg, 
                TB: <?= esc($kr['antropometri']['tinggi_badan']) ?> cm, 
                TD: <?= esc($kr['antropometri']['tekanan_darah']) ?>, 
                LP: <?= esc($kr['antropometri']['lingkar_perut'] ?? '-') ?> cm
            </p>
            <?php endif; ?>
            
            <?php if($kr['anemia']): ?>
            <p style="margin: 5px 0;"><strong>Gejala Anemia:</strong> 
                <?= esc(str_replace(['[', ']', '"'], '', $kr['anemia']['gejala_anemia'] ?? 'Tidak ada')) ?>
            </p>
            <?php endif; ?>
            
            <?php if($kr['haid']): ?>
            <p style="margin: 5px 0;"><strong>Data Menstruasi:</strong> 
                Sudah Menstruasi: <?= $kr['haid']['sudah_menstruasi'] ? 'Ya' : 'Tidak' ?>
                <?php if($kr['haid']['sudah_menstruasi']): ?>
                , Keteraturan: <?= esc($kr['haid']['keteraturan_haid'] ?? '-') ?>
                , Nyeri: <?= esc($kr['haid']['nyeri_haid'] ?? '-') ?>
                <?php endif; ?>
            </p>
            <?php endif; ?>
            
            <?php if($kr['suplementasi']): ?>
            <p style="margin: 5px 0;"><strong>Suplementasi:</strong> 
                Dapat TTD: <?= $kr['suplementasi']['dapat_ttd'] ? 'Ya' : 'Tidak' ?>, 
                Minum TTD: <?= $kr['suplementasi']['minum_ttd'] ? 'Ya' : 'Tidak' ?>, 
                Sarapan: <?= esc($kr['suplementasi']['kebiasaan_sarapan'] ?? '-') ?>
            </p>
            <?php endif; ?>
            
            <?php if($kr['gaya_hidup']): ?>
            <p style="margin: 5px 0;"><strong>Risiko PTM:</strong> 
                <?= esc(str_replace(['[', ']', '"'], '', $kr['gaya_hidup']['risiko_ptm'] ?? 'Tidak ada')) ?>
            </p>
            <?php endif; ?>
            
            <?php if($kr['swamedikasi']): ?>
            <p style="margin: 5px 0;"><strong>Perilaku Swamedikasi:</strong> 
                <?= esc(str_replace(['[', ']', '"'], '', $kr['swamedikasi']['perilaku_swamedikasi'] ?? 'Tidak ada')) ?>
            </p>
            <?php endif; ?>
            
            <?php if(!empty($kr['catatan'])): ?>
            <p style="margin: 5px 0;"><strong>Catatan:</strong> <?= esc($kr['catatan']) ?></p>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari Sistem Monitoring Kesehatan e-Asfarm.<br>
        Untuk informasi lebih lanjut, hubungi admin yang tertera di atas.</p>
    </div>
</body>
</html>
