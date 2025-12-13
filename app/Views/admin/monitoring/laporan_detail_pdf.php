<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Detail Monitoring</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #047d78; margin-bottom: 20px; }
        .info-section { margin-bottom: 20px; }
        .info-row { margin-bottom: 8px; }
        .label { font-weight: bold; display: inline-block; width: 150px; }
        .value { display: inline-block; }
        h2 { color: #047d78; border-bottom: 2px solid #047d78; padding-bottom: 5px; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th { background-color: #047d78; color: white; padding: 10px; text-align: left; font-size: 11px; }
        td { padding: 8px; border-bottom: 1px solid #ddd; font-size: 11px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .footer { margin-top: 30px; font-size: 10px; color: #666; border-top: 1px solid #ddd; padding-top: 10px; }
    </style>
</head>
<body>
    <?php if($tab === 'ibu-hamil'): ?>
        <h1>LAPORAN DETAIL MONITORING IBU HAMIL</h1>
        
        <div class="info-section">
            <div class="info-row">
                <span class="label">Nama Ibu:</span>
                <span class="value"><?= esc($data['nama_ibu'] ?? '-') ?></span>
            </div>
            <div class="info-row">
                <span class="label">NIK:</span>
                <span class="value"><?= esc($data['nik'] ?? '-') ?></span>
            </div>
            <div class="info-row">
                <span class="label">Usia Kehamilan:</span>
                <span class="value"><?= esc($data['usia_kehamilan'] ?? '-') ?> minggu</span>
            </div>
            <div class="info-row">
                <span class="label">HPHT:</span>
                <span class="value"><?= isset($data['hpht']) ? date('d/m/Y', strtotime($data['hpht'])) : '-' ?></span>
            </div>
            <div class="info-row">
                <span class="label">HPL:</span>
                <span class="value"><?= isset($data['hpl']) ? date('d/m/Y', strtotime($data['hpl'])) : '-' ?></span>
            </div>
        </div>
        
        <h2>RIWAYAT KUNJUNGAN</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keluhan</th>
                    <th>TD</th>
                    <th>BB</th>
                    <th>LILA</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($kunjungan as $k): 
                    $antropometri = $antropometriModel->where('kunjungan_id', $k['id'])->first();
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d/m/Y', strtotime($k['tanggal_kunjungan'])) ?></td>
                    <td><?= esc($k['keluhan'] ?? '-') ?></td>
                    <td><?= esc($antropometri['tekanan_darah'] ?? '-') ?></td>
                    <td><?= esc($antropometri['berat_badan'] ?? '-') ?></td>
                    <td><?= esc($antropometri['lila'] ?? '-') ?></td>
                    <td><?= esc($k['catatan'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    <?php elseif($tab === 'balita'): ?>
        <h1>LAPORAN DETAIL MONITORING BALITA</h1>
        
        <div class="info-section">
            <div class="info-row">
                <span class="label">Nama Anak:</span>
                <span class="value"><?= esc($data['nama_anak'] ?? '-') ?></span>
            </div>
            <div class="info-row">
                <span class="label">NIK:</span>
                <span class="value"><?= esc($data['nik'] ?? '-') ?></span>
            </div>
            <div class="info-row">
                <span class="label">Tanggal Lahir:</span>
                <span class="value"><?= isset($data['tanggal_lahir']) ? date('d/m/Y', strtotime($data['tanggal_lahir'])) : '-' ?></span>
            </div>
            <div class="info-row">
                <span class="label">Jenis Kelamin:</span>
                <span class="value"><?= esc($data['jenis_kelamin'] ?? '-') ?></span>
            </div>
        </div>
        
        <h2>RIWAYAT KUNJUNGAN</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>BB (kg)</th>
                    <th>TB (cm)</th>
                    <th>LK (cm)</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($kunjungan as $k): 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d/m/Y', strtotime($k['tanggal_kunjungan'])) ?></td>
                    <td><?= esc($k['berat_badan'] ?? '-') ?></td>
                    <td><?= esc($k['tinggi_badan'] ?? '-') ?></td>
                    <td><?= esc($k['lingkar_kepala'] ?? '-') ?></td>
                    <td><?= esc($k['catatan'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    <?php elseif($tab === 'remaja'): ?>
        <h1>LAPORAN DETAIL MONITORING REMAJA</h1>
        
        <div class="info-section">
            <div class="info-row">
                <span class="label">Nama:</span>
                <span class="value"><?= esc($data['nama_lengkap'] ?? '-') ?></span>
            </div>
            <div class="info-row">
                <span class="label">NIK:</span>
                <span class="value"><?= esc($data['nik'] ?? '-') ?></span>
            </div>
            <div class="info-row">
                <span class="label">Tanggal Lahir:</span>
                <span class="value"><?= isset($data['tanggal_lahir']) ? date('d/m/Y', strtotime($data['tanggal_lahir'])) : '-' ?></span>
            </div>
            <div class="info-row">
                <span class="label">Jenis Kelamin:</span>
                <span class="value"><?= isset($data['jenis_kelamin']) ? ($data['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-' ?></span>
            </div>
        </div>
        
        <h2>RIWAYAT KUNJUNGAN</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>BB (kg)</th>
                    <th>TB (cm)</th>
                    <th>TD</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($kunjungan as $k): 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d/m/Y', strtotime($k['tanggal_kunjungan'])) ?></td>
                    <td><?= esc($k['berat_badan'] ?? '-') ?></td>
                    <td><?= esc($k['tinggi_badan'] ?? '-') ?></td>
                    <td><?= esc($k['tekanan_darah'] ?? '-') ?></td>
                    <td><?= esc($k['catatan'] ?? '-') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?> | Dicetak oleh: <?= session()->get('username') ?></p>
    </div>
</body>
</html>
