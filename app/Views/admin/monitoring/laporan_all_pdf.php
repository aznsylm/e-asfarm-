<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Monitoring Semua Kategori</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 20px; }
        h2 { color: #047d78; border-bottom: 2px solid #047d78; padding-bottom: 5px; margin-top: 20px; margin-bottom: 10px; font-size: 14px; }
        h3 { color: #047d78; font-size: 12px; margin-top: 15px; margin-bottom: 8px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px; }
        th { background-color: #047d78; color: white; padding: 8px; text-align: left; font-size: 10px; }
        td { padding: 6px 8px; border-bottom: 1px solid #ddd; font-size: 10px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 20px; font-size: 9px; color: #666; border-top: 1px solid #ddd; padding-top: 8px; text-align: center; }
    </style>
</head>
<body>
    <?php 
    $title = 'LAPORAN MONITORING KESEHATAN - SEMUA KATEGORI';
    $subtitle = 'Periode: ' . date('F', mktime(0,0,0,$bulan,1)) . ' ' . $tahun;
    echo view('admin/monitoring/export_header', compact('title', 'subtitle', 'adminPadukuhan', 'adminName', 'adminPhone'));
    ?>
    
    <!-- IBU HAMIL -->
    <h2>DATA IBU HAMIL & MENYUSUI (<?= count($dataIbuHamil) ?> Data)</h2>
    <?php if(!empty($dataIbuHamil)): ?>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Ibu</th>
                <th width="15%">Usia Kehamilan</th>
                <th width="15%">Trimester</th>
                <th width="15%">HPL</th>
                <th width="12%">Kunjungan</th>
                <th width="13%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
            foreach($dataIbuHamil as $d): 
                $totalKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->countAllResults();
                $kunjunganBulanIni = $kunjunganModel->where('monitoring_id', $d['id'])
                    ->where('MONTH(tanggal_kunjungan)', $bulan)
                    ->where('YEAR(tanggal_kunjungan)', $tahun)
                    ->countAllResults();
                $usiaKehamilan = $d['usia_kehamilan'] ?? 0;
                $trimester = $usiaKehamilan <= 13 ? 1 : ($usiaKehamilan <= 27 ? 2 : 3);
                $status = $totalKunjungan < 4 ? 'Perlu Perhatian' : 'Aktif';
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($d['nama_ibu'] ?? '-') ?></td>
                <td><?= $usiaKehamilan ?> minggu</td>
                <td>Trimester <?= $trimester ?></td>
                <td><?= isset($d['rencana_tanggal_persalinan']) ? date('d/m/Y', strtotime($d['rencana_tanggal_persalinan'])) : '-' ?></td>
                <td><?= $kunjunganBulanIni ?> / <?= $totalKunjungan ?></td>
                <td><?= $status ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p style="text-align: center; color: #999; padding: 20px;">Tidak ada data</p>
    <?php endif; ?>
    
    <!-- BALITA -->
    <h2>DATA BALITA & ANAK (<?= count($dataBalita) ?> Data)</h2>
    <?php if(!empty($dataBalita)): ?>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Anak</th>
                <th width="20%">Usia</th>
                <th width="15%">Kunjungan</th>
                <th width="15%">Total Kunjungan</th>
                <th width="15%">Status Gizi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
            foreach($dataBalita as $d): 
                $totalKunjungan = $kunjunganBalitaModel->where('monitoring_balita_id', $d['id'])->countAllResults();
                $kunjunganBulanIni = $kunjunganBalitaModel->where('monitoring_balita_id', $d['id'])
                    ->where('MONTH(tanggal_kunjungan)', $bulan)
                    ->where('YEAR(tanggal_kunjungan)', $tahun)
                    ->countAllResults();
                $usia = '-';
                if(isset($d['tanggal_lahir'])) {
                    $tglLahir = new \DateTime($d['tanggal_lahir']);
                    $today = new \DateTime();
                    $diff = $today->diff($tglLahir);
                    $usia = $diff->y . ' thn ' . $diff->m . ' bln';
                }
                $statusGizi = $totalKunjungan < 6 ? 'Perlu Pemantauan' : 'Normal';
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($d['nama_anak'] ?? '-') ?></td>
                <td><?= $usia ?></td>
                <td><?= $kunjunganBulanIni ?></td>
                <td><?= $totalKunjungan ?></td>
                <td><?= $statusGizi ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p style="text-align: center; color: #999; padding: 20px;">Tidak ada data</p>
    <?php endif; ?>
    
    <!-- REMAJA -->
    <h2>DATA REMAJA (<?= count($dataRemaja) ?> Data)</h2>
    <?php if(!empty($dataRemaja)): ?>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama</th>
                <th width="15%">Usia</th>
                <th width="15%">Jenis Kelamin</th>
                <th width="15%">Kunjungan</th>
                <th width="20%">Status Anemia</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
            foreach($dataRemaja as $d): 
                $totalKunjungan = $kunjunganRemajaModel->where('monitoring_id', $d['id'])->countAllResults();
                $kunjunganBulanIni = $kunjunganRemajaModel->where('monitoring_id', $d['id'])
                    ->where('MONTH(tanggal_kunjungan)', $bulan)
                    ->where('YEAR(tanggal_kunjungan)', $tahun)
                    ->countAllResults();
                $usia = '-';
                if(isset($d['tanggal_lahir'])) {
                    $tglLahir = new \DateTime($d['tanggal_lahir']);
                    $today = new \DateTime();
                    $diff = $today->diff($tglLahir);
                    $usia = $diff->y . ' tahun';
                }
                $jenisKelamin = isset($d['jenis_kelamin']) ? ($d['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-';
                $statusAnemia = $totalKunjungan < 4 ? 'Perlu Pemeriksaan' : 'Normal';
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($d['nama_lengkap'] ?? '-') ?></td>
                <td><?= $usia ?></td>
                <td><?= $jenisKelamin ?></td>
                <td><?= $kunjunganBulanIni ?> / <?= $totalKunjungan ?></td>
                <td><?= $statusAnemia ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
    <p style="text-align: center; color: #999; padding: 20px;">Tidak ada data</p>
    <?php endif; ?>
    
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis dari Sistem Monitoring Kesehatan e-Asfarm.<br>
        Untuk informasi lebih lanjut, hubungi admin yang tertera di atas.</p>
    </div>
</body>
</html>
