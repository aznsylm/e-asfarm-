<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Monitoring</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #047d78; margin-bottom: 5px; }
        h3 { text-align: center; margin-top: 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #047d78; color: white; padding: 10px; text-align: left; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <h1>LAPORAN MONITORING KESEHATAN</h1>
    <h3>Periode: <?= date('F', mktime(0,0,0,$bulan,1)) ?> <?= $tahun ?></h3>
    
    <table>
        <thead>
            <?php if($tab === 'ibu-hamil'): ?>
                <tr>
                    <th>No</th>
                    <th>Nama Ibu</th>
                    <th>Usia Kehamilan</th>
                    <th>Trimester</th>
                    <th>HPL</th>
                    <th>Kunjungan Bulan Ini</th>
                    <th>Total Kunjungan</th>
                    <th>Status</th>
                </tr>
            <?php elseif($tab === 'balita'): ?>
                <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>Usia</th>
                    <th>Kunjungan Bulan Ini</th>
                    <th>Total Kunjungan</th>
                    <th>Status Gizi</th>
                </tr>
            <?php elseif($tab === 'remaja'): ?>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Kunjungan Bulan Ini</th>
                    <th>Total Kunjungan</th>
                    <th>Status Anemia</th>
                </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            foreach($dataList as $d): 
                if($tab === 'ibu-hamil') {
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
                    <td><?= $kunjunganBulanIni ?></td>
                    <td><?= $totalKunjungan ?></td>
                    <td><?= $status ?></td>
                </tr>
            <?php 
                } elseif($tab === 'balita') {
                    $kunjunganBalitaModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
                    $totalKunjungan = $kunjunganBalitaModel->where('monitoring_balita_id', $d['id'])->countAllResults();
                    $kunjunganBulanIni = $kunjunganBalitaModel->where('monitoring_balita_id', $d['id'])
                        ->where('MONTH(tanggal_kunjungan)', $bulan)
                        ->where('YEAR(tanggal_kunjungan)', $tahun)
                        ->countAllResults();
                    $usia = '-';
                    if(isset($d['tanggal_lahir'])) {
                        $tglLahir = new DateTime($d['tanggal_lahir']);
                        $today = new DateTime();
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
            <?php 
                } elseif($tab === 'remaja') {
                    $kunjunganRemajaModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
                    $totalKunjungan = $kunjunganRemajaModel->where('monitoring_id', $d['id'])->countAllResults();
                    $kunjunganBulanIni = $kunjunganRemajaModel->where('monitoring_id', $d['id'])
                        ->where('MONTH(tanggal_kunjungan)', $bulan)
                        ->where('YEAR(tanggal_kunjungan)', $tahun)
                        ->countAllResults();
                    $usia = '-';
                    if(isset($d['tanggal_lahir'])) {
                        $tglLahir = new DateTime($d['tanggal_lahir']);
                        $today = new DateTime();
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
                    <td><?= $kunjunganBulanIni ?></td>
                    <td><?= $totalKunjungan ?></td>
                    <td><?= $statusAnemia ?></td>
                </tr>
            <?php 
                }
            endforeach; 
            ?>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?> | Dicetak oleh: <?= session()->get('username') ?></p>
    </div>
</body>
</html>
