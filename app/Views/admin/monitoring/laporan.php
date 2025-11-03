<?= $this->extend('layouts/dashboard_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-12">
            <h2>Data Statistik & Laporan Monitoring</h2>
            <p class="text-muted">Laporan dan analisis data kesehatan ibu hamil</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="<?= base_url('admin/monitoring/laporan') ?>">
                        <div class="row">
                            <?php if($role === 'superadmin'): ?>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Padukuhan</label>
                                <select name="padukuhan" class="form-select">
                                    <option value="">Semua Padukuhan</option>
                                    <?php foreach($padukuhanList as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= $selectedPadukuhan == $p['id'] ? 'selected' : '' ?>>
                                        <?= esc($p['nama_padukuhan']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Periode</label>
                                <select name="periode" class="form-select">
                                    <option value="hari_ini" <?= $periode === 'hari_ini' ? 'selected' : '' ?>>Hari Ini</option>
                                    <option value="minggu_ini" <?= $periode === 'minggu_ini' ? 'selected' : '' ?>>Minggu Ini</option>
                                    <option value="bulan_ini" <?= $periode === 'bulan_ini' ? 'selected' : '' ?>>Bulan Ini</option>
                                    <option value="tahun_ini" <?= $periode === 'tahun_ini' ? 'selected' : '' ?>>Tahun Ini</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-primary d-block w-100">
                                    <i class="ti ti-filter"></i> Tampilkan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Pasien Aktif</h6>
                            <h2 class="mb-0"><?= $stats['total_pasien'] ?></h2>
                        </div>
                        <div>
                            <i class="ti ti-users" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Kunjungan</h6>
                            <h2 class="mb-0"><?= $stats['total_kunjungan'] ?></h2>
                        </div>
                        <div>
                            <i class="ti ti-calendar-check" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Pasien Risiko Tinggi</h6>
                            <h2 class="mb-0"><?= $stats['risiko_tinggi'] ?></h2>
                        </div>
                        <div>
                            <i class="ti ti-alert-triangle" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Tekanan Darah -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Grafik Perkembangan Tekanan Darah</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartTD" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Detail Pasien -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Daftar Pasien</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($patientList)): ?>
                        <div class="text-center py-5">
                            <i class="ti ti-clipboard-off" style="font-size: 4rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada data pasien</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Username</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Tanggal Input</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($patientList as $p): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($p['full_name']) ?></td>
                                        <td><?= esc($p['username']) ?></td>
                                        <td><span class="badge bg-primary">Ibu Hamil</span></td>
                                        <td>
                                            <span class="badge bg-<?= $p['status'] === 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($p['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/monitoring/riwayat/'.$p['id']) ?>" class="btn btn-sm btn-info">
                                                <i class="ti ti-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart Tekanan Darah
const ctx = document.getElementById('chartTD').getContext('2d');
const chartTD = new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($chartData['labels']) ?>,
        datasets: [
            {
                label: 'Sistolik',
                data: <?= json_encode($chartData['sistolik']) ?>,
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.1)',
                tension: 0.4
            },
            {
                label: 'Diastolik',
                data: <?= json_encode($chartData['diastolik']) ?>,
                borderColor: 'rgb(54, 162, 235)',
                backgroundColor: 'rgba(54, 162, 235, 0.1)',
                tension: 0.4
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Perkembangan Tekanan Darah (mmHg)'
            }
        },
        scales: {
            y: {
                beginAtZero: false,
                min: 60,
                max: 180
            }
        }
    }
});
</script>
<?= $this->endSection() ?>
