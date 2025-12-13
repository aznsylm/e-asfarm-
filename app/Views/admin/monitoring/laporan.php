<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="mb-3">
    <a href="<?= base_url('admin/monitoring/dashboard') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row mb-3">
    <div class="col-md-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalIbuHamil ?></h3>
                <p>Total Ibu Hamil</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-nurse"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $totalBalita ?></h3>
                <p>Total Balita & Anak</p>
            </div>
            <div class="icon">
                <i class="fas fa-baby"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $totalRemaja ?></h3>
                <p>Total Remaja</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-8">
        <form method="GET" action="<?= base_url('admin/monitoring/laporan') ?>" class="form-inline">
            <input type="hidden" name="tab" value="<?= esc($tab) ?>">
            <div class="form-group mr-2">
                <select name="bulan" class="form-control">
                    <?php for($i=1; $i<=12; $i++): ?>
                        <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' ?>>
                            <?= date('F', mktime(0,0,0,$i,1)) ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group mr-2">
                <select name="tahun" class="form-control">
                    <?php for($y=date('Y'); $y>=2020; $y--): ?>
                        <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
        </form>
    </div>
    <div class="col-md-4 text-right">
        <a href="<?= base_url('admin/monitoring/laporan/export-excel?tab='.$tab.'&bulan='.$bulan.'&tahun='.$tahun.'&search='.$search) ?>" class="btn btn-success btn-sm">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="<?= base_url('admin/monitoring/laporan/export-pdf?tab='.$tab.'&bulan='.$bulan.'&tahun='.$tahun.'&search='.$search) ?>" class="btn btn-danger btn-sm">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header p-0">
        <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'ibu-hamil' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/monitoring/laporan?tab=ibu-hamil') ?>">
                        Ibu Hamil
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'balita' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/monitoring/laporan?tab=balita') ?>">
                        Balita & Anak
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?= $tab === 'remaja' ? 'active' : '' ?>" 
                       href="<?= base_url('admin/monitoring/laporan?tab=remaja') ?>">
                        Remaja
                    </a>
                </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="mb-3">
                <form method="GET" action="<?= base_url('admin/monitoring/laporan') ?>">
                    <input type="hidden" name="tab" value="<?= esc($tab) ?>">
                    <input type="hidden" name="bulan" value="<?= esc($bulan) ?>">
                    <input type="hidden" name="tahun" value="<?= esc($tahun) ?>">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama..." value="<?= esc($search ?? '') ?>">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                            <?php if(!empty($search)): ?>
                                <a href="<?= base_url('admin/monitoring/laporan?tab='.$tab) ?>" class="btn btn-secondary"><i class="fas fa-times"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>

            <?php if($tab === 'ibu-hamil'): ?>
                <?php if(empty($dataList)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-inbox" style="font-size: 4rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">Belum ada data</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                        <th>No</th>
                                        <th>Nama Ibu</th>
                                        <th>Usia Kehamilan</th>
                                        <th>Trimester</th>
                                        <th>HPL</th>
                                        <th>Kunjungan Bulan Ini</th>
                                        <th>Total Kunjungan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                                    foreach($dataList as $d): 
                                        $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
                                        $totalKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->countAllResults();
                                        $kunjunganBulanIni = $kunjunganModel->where('monitoring_id', $d['id'])
                                            ->where('MONTH(tanggal_kunjungan)', $bulan)
                                            ->where('YEAR(tanggal_kunjungan)', $tahun)
                                            ->countAllResults();
                                        
                                        // Calculate trimester
                                        $usiaKehamilan = $d['usia_kehamilan'] ?? 0;
                                        $trimester = $usiaKehamilan <= 13 ? 1 : ($usiaKehamilan <= 27 ? 2 : 3);
                                        
                                        // Determine status
                                        $status = 'Aktif';
                                        $statusClass = 'success';
                                        if ($totalKunjungan < 4) {
                                            $status = 'Perlu Perhatian';
                                            $statusClass = 'warning';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($d['nama_ibu'] ?? '-') ?></td>
                                        <td><?= esc($usiaKehamilan) ?> minggu</td>
                                        <td>Trimester <?= $trimester ?></td>
                                        <td><?= isset($d['rencana_tanggal_persalinan']) ? date('d/m/Y', strtotime($d['rencana_tanggal_persalinan'])) : '-' ?></td>
                                        <td><?= $kunjunganBulanIni ?> kunjungan</td>
                                        <td><?= $totalKunjungan ?></td>
                                        <td><span class="badge badge-<?= $statusClass ?>"><?= $status ?></span></td>
                                        <td>
                                            <a href="<?= base_url('admin/monitoring/riwayat/'.$d['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('admin/monitoring/laporan/export-detail-excel/ibu-hamil/'.$d['id']) ?>" class="btn btn-sm btn-success" title="Export Excel">
                                                <i class="fas fa-file-excel"></i>
                                            </a>
                                            <a href="<?= base_url('admin/monitoring/laporan/export-detail-pdf/ibu-hamil/'.$d['id']) ?>" class="btn btn-sm btn-danger" title="Export PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

            <?php elseif($tab === 'balita'): ?>
                <?php if(empty($dataList)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-inbox" style="font-size: 4rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">Belum ada data</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                        <th>No</th>
                                        <th>Nama Anak</th>
                                        <th>Usia</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kunjungan Bulan Ini</th>
                                        <th>Total Kunjungan</th>
                                        <th>Status Gizi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                                    foreach($dataList as $d): 
                                        $kunjunganModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
                                        $totalKunjungan = $kunjunganModel->where('monitoring_balita_id', $d['id'])->countAllResults();
                                        $kunjunganBulanIni = $kunjunganModel->where('monitoring_balita_id', $d['id'])
                                            ->where('MONTH(tanggal_kunjungan)', $bulan)
                                            ->where('YEAR(tanggal_kunjungan)', $tahun)
                                            ->countAllResults();
                                        
                                        // Calculate age
                                        $usia = '-';
                                        if(isset($d['tanggal_lahir'])) {
                                            $tglLahir = new DateTime($d['tanggal_lahir']);
                                            $today = new DateTime();
                                            $diff = $today->diff($tglLahir);
                                            $usia = $diff->y . ' thn ' . $diff->m . ' bln';
                                        }
                                        
                                        // Status Gizi (simplified)
                                        $statusGizi = 'Normal';
                                        $statusClass = 'success';
                                        if ($totalKunjungan < 6) {
                                            $statusGizi = 'Perlu Pemantauan';
                                            $statusClass = 'warning';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($d['nama_anak'] ?? '-') ?></td>
                                        <td><?= $usia ?></td>
                                        <td>-</td>
                                        <td><?= $kunjunganBulanIni ?> kunjungan</td>
                                        <td><?= $totalKunjungan ?></td>
                                        <td><span class="badge badge-<?= $statusClass ?>"><?= $statusGizi ?></span></td>
                                        <td>
                                            <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$d['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('admin/monitoring/laporan/export-detail-excel/balita/'.$d['id']) ?>" class="btn btn-sm btn-success" title="Export Excel">
                                                <i class="fas fa-file-excel"></i>
                                            </a>
                                            <a href="<?= base_url('admin/monitoring/laporan/export-detail-pdf/balita/'.$d['id']) ?>" class="btn btn-sm btn-danger" title="Export PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>

            <?php elseif($tab === 'remaja'): ?>
                <?php if(empty($dataList)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-inbox" style="font-size: 4rem; color: #ccc;"></i>
                        <p class="text-muted mt-3">Belum ada data</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Usia</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Kunjungan Bulan Ini</th>
                                        <th>Total Kunjungan</th>
                                        <th>Status Anemia</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                                    foreach($dataList as $d): 
                                        $kunjunganModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
                                        $totalKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->countAllResults();
                                        $kunjunganBulanIni = $kunjunganModel->where('monitoring_id', $d['id'])
                                            ->where('MONTH(tanggal_kunjungan)', $bulan)
                                            ->where('YEAR(tanggal_kunjungan)', $tahun)
                                            ->countAllResults();
                                        
                                        // Status Anemia (simplified)
                                        $statusAnemia = 'Normal';
                                        $statusClass = 'success';
                                        if ($totalKunjungan < 4) {
                                            $statusAnemia = 'Perlu Pemeriksaan';
                                            $statusClass = 'warning';
                                        }
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($d['nama_lengkap'] ?? '-') ?></td>
                                        <td><?php
                                            if(isset($d['tanggal_lahir'])) {
                                                $tglLahir = new DateTime($d['tanggal_lahir']);
                                                $today = new DateTime();
                                                $diff = $today->diff($tglLahir);
                                                echo $diff->y . ' tahun';
                                            } else {
                                                echo '-';
                                            }
                                        ?></td>
                                        <td><?= isset($d['jenis_kelamin']) ? ($d['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan') : '-' ?></td>
                                        <td><?= $kunjunganBulanIni ?> kunjungan</td>
                                        <td><?= $totalKunjungan ?></td>
                                        <td><span class="badge badge-<?= $statusClass ?>"><?= $statusAnemia ?></span></td>
                                        <td>
                                            <a href="<?= base_url('admin/monitoring/remaja/riwayat/'.$d['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url('admin/monitoring/laporan/export-detail-excel/remaja/'.$d['id']) ?>" class="btn btn-sm btn-success" title="Export Excel">
                                                <i class="fas fa-file-excel"></i>
                                            </a>
                                            <a href="<?= base_url('admin/monitoring/laporan/export-detail-pdf/remaja/'.$d['id']) ?>" class="btn btn-sm btn-danger" title="Export PDF">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if(!empty($dataList)): ?>
    <div class="card-footer">
        <?= $pager->links() ?>
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
