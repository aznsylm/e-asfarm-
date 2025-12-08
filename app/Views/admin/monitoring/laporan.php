<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <a href="<?= base_url('admin/monitoring/dashboard') ?>" class="btn btn-outline-secondary btn-sm mb-2">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
            <h2>Data Statistik & Laporan</h2>
            <p class="text-muted">Rekapan data monitoring kesehatan</p>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">Total Ibu Hamil</h6>
                    <h2><?= $totalIbuHamil ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">Total Remaja</h6>
                    <h2><?= $totalRemaja ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">Total Balita & Anak</h6>
                    <h2><?= $totalBalita ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Export -->
    <div class="row mb-3">
        <div class="col-md-8">
            <form method="GET" action="<?= base_url('admin/monitoring/laporan') ?>" class="row g-2">
                <input type="hidden" name="tab" value="<?= esc($tab) ?>">
                <div class="col-auto">
                    <select name="bulan" class="form-select">
                        <?php for($i=1; $i<=12; $i++): ?>
                            <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>" <?= $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' ?>>
                                <?= date('F', mktime(0,0,0,$i,1)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="tahun" class="form-select">
                        <?php for($y=date('Y'); $y>=2020; $y--): ?>
                            <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-filter"></i> Filter</button>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-success" onclick="alert('Export Excel akan segera tersedia')">
                <i class="ti ti-file-spreadsheet"></i> Export Excel
            </button>
            <button class="btn btn-danger" onclick="alert('Export PDF akan segera tersedia')">
                <i class="ti ti-file-pdf"></i> Export PDF
            </button>
        </div>
    </div>

    <!-- Tabs -->
    <div class="card">
        <div class="card-body">
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

            <div class="tab-content mt-3">
                <!-- Search -->
                <div class="mb-3">
                    <form method="GET" action="<?= base_url('admin/monitoring/laporan') ?>">
                        <input type="hidden" name="tab" value="<?= esc($tab) ?>">
                        <input type="hidden" name="bulan" value="<?= esc($bulan) ?>">
                        <input type="hidden" name="tahun" value="<?= esc($tahun) ?>">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama..." value="<?= esc($search ?? '') ?>">
                            <button class="btn btn-primary" type="submit"><i class="ti ti-search"></i> Cari</button>
                            <?php if(!empty($search)): ?>
                                <a href="<?= base_url('admin/monitoring/laporan?tab='.$tab) ?>" class="btn btn-secondary"><i class="ti ti-x"></i></a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

                <?php if($tab === 'ibu-hamil'): ?>
                    <!-- Ibu Hamil Table -->
                    <?php if(empty($dataList)): ?>
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada data</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ibu</th>
                                        <th>Username</th>
                                        <th>Usia Kehamilan</th>
                                        <th>Total Kunjungan</th>
                                        <th>Kunjungan Terakhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                                    foreach($dataList as $d): 
                                        $kunjunganModel = new \App\Models\Monitoring\KunjunganModel();
                                        $totalKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->countAllResults();
                                        $lastKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($d['nama_ibu'] ?? '-') ?></td>
                                        <td><?= esc($d['username'] ?? '-') ?></td>
                                        <td><?= esc($d['usia_kehamilan'] ?? '-') ?> minggu</td>
                                        <td><?= $totalKunjungan ?></td>
                                        <td><?= $lastKunjungan ? date('d/m/Y', strtotime($lastKunjungan['tanggal_kunjungan'])) : '-' ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/monitoring/riwayat/'.$d['id']) ?>" class="btn btn-sm btn-info">
                                                <i class="ti ti-eye"></i> Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>

                <?php elseif($tab === 'balita'): ?>
                    <!-- Balita Table -->
                    <?php if(empty($dataList)): ?>
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada data</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anak</th>
                                        <th>Username</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Total Kunjungan</th>
                                        <th>Kunjungan Terakhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                                    foreach($dataList as $d): 
                                        $kunjunganModel = new \App\Models\MonitoringBalita\KunjunganBalitaModel();
                                        $totalKunjungan = $kunjunganModel->where('monitoring_balita_id', $d['id'])->countAllResults();
                                        $lastKunjungan = $kunjunganModel->where('monitoring_balita_id', $d['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($d['nama_anak'] ?? '-') ?></td>
                                        <td><?= esc($d['username'] ?? '-') ?></td>
                                        <td><?= isset($d['tanggal_lahir']) ? date('d/m/Y', strtotime($d['tanggal_lahir'])) : '-' ?></td>
                                        <td><?= $totalKunjungan ?></td>
                                        <td><?= $lastKunjungan ? date('d/m/Y', strtotime($lastKunjungan['tanggal_kunjungan'])) : '-' ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/monitoring/balita/riwayat/'.$d['id']) ?>" class="btn btn-sm btn-info">
                                                <i class="ti ti-eye"></i> Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>

                <?php elseif($tab === 'remaja'): ?>
                    <!-- Remaja Table -->
                    <?php if(empty($dataList)): ?>
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada data</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Usia</th>
                                        <th>Total Kunjungan</th>
                                        <th>Kunjungan Terakhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1 + (10 * ((isset($_GET['page']) ? $_GET['page'] : 1) - 1));
                                    foreach($dataList as $d): 
                                        $kunjunganModel = new \App\Models\MonitoringRemaja\KunjunganRemajaModel();
                                        $totalKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->countAllResults();
                                        $lastKunjungan = $kunjunganModel->where('monitoring_id', $d['id'])->orderBy('tanggal_kunjungan', 'DESC')->first();
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($d['nama'] ?? '-') ?></td>
                                        <td><?= esc($d['username'] ?? '-') ?></td>
                                        <td><?= esc($d['usia'] ?? '-') ?> tahun</td>
                                        <td><?= $totalKunjungan ?></td>
                                        <td><?= $lastKunjungan ? date('d/m/Y', strtotime($lastKunjungan['tanggal_kunjungan'])) : '-' ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/monitoring/remaja/riwayat/'.$d['id']) ?>" class="btn btn-sm btn-info">
                                                <i class="ti ti-eye"></i> Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <?= $pager->links() ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
