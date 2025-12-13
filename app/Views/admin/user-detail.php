<?= $this->extend('layouts/adminlte_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
<div class="mb-3">
    <a href="<?= base_url('admin/kelola-pengguna') ?>" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-circle"></i> Profil Pengguna</h3>
    </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="150">Username</th>
                            <td>: <?= esc($user['username']) ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>: <?= esc($user['email']) ?></td>
                        </tr>
                        <tr>
                            <th>No. WhatsApp</th>
                            <td>: <?= esc($user['phone_number'] ?? '-') ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="150">Padukuhan</th>
                            <td>: <?= $padukuhan ? esc($padukuhan['nama_padukuhan']) : '-' ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>: <span class="badge badge-<?= $user['role'] === 'admin' ? 'warning' : 'info' ?>"><?= ucfirst($user['role']) ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

<ul class="nav nav-tabs" role="tablist">
    <?php if ($monitoring): ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link active" data-toggle="tab" href="#ibu-hamil">Data Ibu Hamil</a>
    </li>
    <?php endif; ?>
    <?php if ($monitoringBalita): ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link<?= !$monitoring ? ' active' : '' ?>" data-toggle="tab" href="#balita">Data Balita & Anak</a>
    </li>
    <?php endif; ?>
    <?php if ($monitoringRemaja): ?>
    <li class="nav-item" role="presentation">
        <a class="nav-link<?= !$monitoring && !$monitoringBalita ? ' active' : '' ?>" data-toggle="tab" href="#remaja">Data Remaja</a>
    </li>
    <?php endif; ?>
</ul>

    <!-- Tab Content -->
    <div class="tab-content mt-3">
        <?php if ($monitoring): ?>
        <!-- Tab Ibu Hamil -->
        <div class="tab-pane fade show active" id="ibu-hamil" role="tabpanel">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Data Identitas Ibu Hamil</h3>
                </div>
                <div class="card-body">
                    <?php if ($identitas): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="200">Nama Ibu</th><td>: <?= esc($identitas['nama_ibu']) ?></td></tr>
                                <tr><th>Nama Suami</th><td>: <?= esc($identitas['nama_suami']) ?></td></tr>
                                <tr><th>Usia Ibu</th><td>: <?= esc($identitas['usia_ibu']) ?> tahun</td></tr>
                                <tr><th>Usia Suami</th><td>: <?= esc($identitas['usia_suami']) ?> tahun</td></tr>
                                <tr><th>Usia Kehamilan</th><td>: <?= esc($identitas['usia_kehamilan']) ?> minggu</td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="200">Alamat</th><td>: <?= esc($identitas['alamat']) ?></td></tr>
                                <tr><th>Nomor Telepon</th><td>: <?= esc($identitas['nomor_telepon']) ?></td></tr>
                                <tr><th>Rencana Persalinan</th><td>: <?= date('d-m-Y', strtotime($identitas['rencana_tanggal_persalinan'])) ?></td></tr>
                                <?php if ($skrining): ?>
                                <tr><th>Tempat Persalinan</th><td>: <?= esc($skrining['tempat_persalinan']) ?></td></tr>
                                <tr><th>Penolong Persalinan</th><td>: <?= esc($skrining['penolong_persalinan']) ?></td></tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                    <?php if ($riwayat): ?>
                    <div class="mt-3">
                        <strong>Riwayat Penyakit:</strong>
                        <?php if ($riwayat['tidak_ada_riwayat'] === '1'): ?>
                            <span class="text-success"> Tidak ada riwayat penyakit</span>
                        <?php else: ?>
                            <p class="mb-0 mt-1"><?= esc($riwayat['riwayat_penyakit']) ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                    <?php else: ?>
                    <p class="text-muted">Data identitas belum lengkap</p>
                    <?php endif; ?>
                </div>
            </div>
            

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Riwayat Kunjungan (<?= count($kunjunganList) ?> kunjungan)</h3>
        </div>
        <div class="card-body">
            <?php if (empty($kunjunganList)): ?>
                <p class="text-muted">Belum ada data kunjungan</p>
            <?php else: ?>
                <div class="accordion" id="accordionIbuHamil">
                <?php foreach ($kunjunganList as $idx => $k): ?>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <a data-toggle="collapse" href="#kunjungan-<?= $k['id'] ?>" class="<?= $k['kunjungan_ke'] > 1 ? 'collapsed' : '' ?>">
                                Kunjungan ke-<?= $k['kunjungan_ke'] ?> <small class="text-muted">(<?= date('d-m-Y', strtotime($k['tanggal_kunjungan'])) ?>)</small>
                            </a>
                        </h4>
                    </div>
                    <div id="kunjungan-<?= $k['id'] ?>" class="collapse<?= $k['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-parent="#accordionIbuHamil">
                        <div class="card-body">
                    
                    <?php if ($k['antropometri']): ?>
                    <div class="mt-2">
                        <strong>Antropometri:</strong>
                        <ul class="mb-1">
                            <li>Tekanan Darah: <?= esc($k['antropometri']['tekanan_darah']) ?></li>
                            <li>Berat Badan: <?= esc($k['antropometri']['berat_badan']) ?> kg</li>
                            <li>Tinggi Badan: <?= esc($k['antropometri']['tinggi_badan']) ?> cm</li>
                            <li>LILA: <?= esc($k['antropometri']['lila']) ?> cm</li>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if ($k['keluhan']): ?>
                    <div class="mt-2">
                        <strong>Keluhan:</strong>
                        <ul class="mb-1">
                            <?php 
                            $keluhan = str_replace(['[', ']', '"'], '', $k['keluhan']['keluhan']);
                            $keluhanArray = array_filter(array_map('trim', explode(',', $keluhan)));
                            foreach ($keluhanArray as $item): 
                            ?>
                            <li><?= esc($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if ($k['suplementasi']): ?>
                    <div class="mt-2">
                        <strong>Suplementasi:</strong>
                        <ul class="mb-1">
                            <li>Suplemen: <?= esc($k['suplementasi']['nama_suplemen']) ?></li>
                            <li>Status: <?= esc($k['suplementasi']['status_pemberian']) ?></li>
                            <li>Jumlah: <?= esc($k['suplementasi']['jumlah_tablet']) ?> tablet</li>
                            <li>Frekuensi: <?= esc($k['suplementasi']['frekuensi']) ?></li>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <?php if ($k['etnomedisin']): ?>
                    <div class="mt-2">
                        <strong>Etnomedisin:</strong>
                        <?php 
                        $etnoList = [];
                        if ($k['etnomedisin']['jenis_obat']) {
                            $jenis = str_replace(['[', ']', '"'], '', $k['etnomedisin']['jenis_obat']);
                            $etnoList[] = 'Jenis: ' . esc($jenis);
                        }
                        if ($k['etnomedisin']['tujuan_penggunaan']) {
                            $tujuan = str_replace(['[', ']', '"'], '', $k['etnomedisin']['tujuan_penggunaan']);
                            $etnoList[] = 'Tujuan: ' . esc($tujuan);
                        }
                        if ($k['etnomedisin']['edukasi_diberikan']) {
                            $edukasi = str_replace(['[', ']', '"'], '', $k['etnomedisin']['edukasi_diberikan']);
                            $etnoList[] = 'Edukasi: ' . esc($edukasi);
                        }
                        
                        if (!empty($etnoList)) {
                            echo implode(', ', $etnoList);
                        } else {
                            echo $k['etnomedisin']['menggunakan_obat_tradisional'] == '1' ? 'Menggunakan obat tradisional' : 'Tidak menggunakan obat tradisional';
                        }
                        ?>
                    </div>
                    <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

        </div>
        <?php endif; ?>

        <?php if ($monitoringBalita): ?>
        <!-- Tab Balita -->
        <div class="tab-pane fade<?= !$monitoring ? ' show active' : '' ?>" id="balita" role="tabpanel">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Data Identitas Balita</h3>
                </div>
                <div class="card-body">
                    <?php if ($identitasBalita): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="200">Nama Anak</th><td>: <?= esc($identitasBalita['nama_anak'] ?? '-') ?></td></tr>
                                <tr><th>Tanggal Lahir</th><td>: <?= $identitasBalita['tanggal_lahir'] ? date('d-m-Y', strtotime($identitasBalita['tanggal_lahir'])) : '-' ?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="200">Nama Wali</th><td>: <?= esc($identitasBalita['nama_wali'] ?? '-') ?></td></tr>
                                <tr><th>No. HP Wali</th><td>: <?= esc($identitasBalita['no_hp_wali'] ?? '-') ?></td></tr>
                            </table>
                        </div>
                    </div>
                    <?php else: ?>
                    <p class="text-muted">Data identitas belum lengkap</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Kunjungan (<?= count($kunjunganBalita) ?> kunjungan)</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($kunjunganBalita)): ?>
                        <p class="text-muted">Belum ada data kunjungan</p>
                    <?php else: ?>
                        <div class="accordion" id="accordionBalita">
                        <?php foreach ($kunjunganBalita as $idx => $kb): ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a data-toggle="collapse" href="#kunjungan-balita-<?= $kb['id'] ?>" class="<?= $kb['kunjungan_ke'] > 1 ? 'collapsed' : '' ?>">
                                        Kunjungan ke-<?= $kb['kunjungan_ke'] ?> <small class="text-muted">(<?= date('d-m-Y', strtotime($kb['tanggal_kunjungan'])) ?>)</small>
                                    </a>
                                </h4>
                            </div>
                            <div id="kunjungan-balita-<?= $kb['id'] ?>" class="collapse<?= $kb['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-parent="#accordionBalita">
                                <div class="card-body">
                                    <?php if ($kb['antropometri']): ?>
                                    <div class="mb-2">
                                        <strong>Antropometri:</strong>
                                        <?php 
                                        $antropometriList = [];
                                        if ($kb['antropometri']['berat_badan']) {
                                            $bb = floatval($kb['antropometri']['berat_badan']);
                                            $antropometriList[] = 'BB: ' . ($bb == intval($bb) ? intval($bb) : $bb) . ' kg';
                                        }
                                        if ($kb['antropometri']['tinggi_badan']) {
                                            $tb = floatval($kb['antropometri']['tinggi_badan']);
                                            $antropometriList[] = 'TB: ' . ($tb == intval($tb) ? intval($tb) : $tb) . ' cm';
                                        }
                                        if ($kb['antropometri']['lingkar_kepala']) {
                                            $lk = floatval($kb['antropometri']['lingkar_kepala']);
                                            $antropometriList[] = 'LK: ' . ($lk == intval($lk) ? intval($lk) : $lk) . ' cm';
                                        }
                                        echo !empty($antropometriList) ? implode(', ', $antropometriList) : 'Tidak ada data';
                                        ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mb-2"><strong>Antropometri:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kb['keluhan']): ?>
                                    <div class="mt-2">
                                        <strong>Keluhan:</strong>
                                        <?php 
                                        $keluhanList = [];
                                        if ($kb['keluhan']['batuk']) $keluhanList[] = 'Batuk';
                                        if ($kb['keluhan']['pilek']) $keluhanList[] = 'Pilek';
                                        if ($kb['keluhan']['demam']) $keluhanList[] = 'Demam';
                                        if ($kb['keluhan']['diare']) $keluhanList[] = 'Diare';
                                        if ($kb['keluhan']['sembelit']) $keluhanList[] = 'Sembelit';
                                        if ($kb['keluhan']['gtm']) $keluhanList[] = 'GTM';
                                        if ($kb['keluhan']['lainnya']) $keluhanList[] = esc($kb['keluhan']['lainnya']);
                                        echo !empty($keluhanList) ? implode(', ', $keluhanList) : 'Tidak ada keluhan';
                                        ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Keluhan:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kb['imunisasi']): ?>
                                    <div class="mt-2">
                                        <strong>Imunisasi & Alergi:</strong>
                                        <?php 
                                        $imunisasiList = [];
                                        if ($kb['imunisasi']['status_imunisasi']) $imunisasiList[] = 'Status: ' . esc($kb['imunisasi']['status_imunisasi']);
                                        if ($kb['imunisasi']['riwayat_alergi']) $imunisasiList[] = 'Alergi: ' . esc($kb['imunisasi']['riwayat_alergi']);
                                        echo !empty($imunisasiList) ? implode(', ', $imunisasiList) : 'Tidak ada data';
                                        ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Imunisasi & Alergi:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kb['swamedikasi']): ?>
                                    <div class="mt-2">
                                        <strong>Swamedikasi:</strong>
                                        <?php 
                                        $swamedList = [];
                                        if ($kb['swamedikasi']['ke_nakes']) $swamedList[] = 'Ke Nakes';
                                        if ($kb['swamedikasi']['obat_modern']) $swamedList[] = 'Obat Modern';
                                        if ($kb['swamedikasi']['antibiotik']) $swamedList[] = 'Antibiotik';
                                        if ($kb['swamedikasi']['etnomedisin']) $swamedList[] = 'Etnomedisin';
                                        echo !empty($swamedList) ? implode(', ', $swamedList) : 'Tidak ada';
                                        ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Swamedikasi:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kb['gizi']): ?>
                                    <div class="mt-2">
                                        <strong>Data Gizi:</strong>
                                        <ul class="mb-1">
                                            <li>Vitamin A: <?= $kb['gizi']['vitamin_a'] ? 'Ya' : 'Tidak' ?></li>
                                            <li>Obat Cacing: <?= $kb['gizi']['obat_cacing'] ? 'Ya' : 'Tidak' ?></li>
                                            <?php if ($kb['gizi']['pola_makan']): ?>
                                            <li>Pola Makan: <?= esc(str_replace(['[', ']', '"'], '', $kb['gizi']['pola_makan'])) ?></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Data Gizi:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kb['kpsp']): ?>
                                    <div class="mt-2">
                                        <strong>Hasil KPSP:</strong> <?= esc($kb['kpsp']['hasil_skrining']) ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Hasil KPSP:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?php if ($monitoringRemaja): ?>
        <!-- Tab Remaja -->
        <div class="tab-pane fade<?= !$monitoring && !$monitoringBalita ? ' show active' : '' ?>" id="remaja" role="tabpanel">
            <div class="card mb-3">
                <div class="card-header">
                    <h3 class="card-title">Data Identitas Remaja</h3>
                </div>
                <div class="card-body">
                    <?php if ($identitasRemaja): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="200">Nama Lengkap</th><td>: <?= esc($identitasRemaja['nama_lengkap'] ?? '-') ?></td></tr>
                                <tr><th>NIK</th><td>: <?= esc($identitasRemaja['nik'] ?? '-') ?></td></tr>
                                <tr><th>Tanggal Lahir</th><td>: <?= $identitasRemaja['tanggal_lahir'] ? date('d-m-Y', strtotime($identitasRemaja['tanggal_lahir'])) : '-' ?></td></tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr><th width="200">Jenis Kelamin</th><td>: <?= $identitasRemaja['jenis_kelamin'] ? ucfirst(strtolower($identitasRemaja['jenis_kelamin'])) : '-' ?></td></tr>
                                <tr><th>Nama Wali</th><td>: <?= esc($identitasRemaja['nama_wali'] ?? '-') ?></td></tr>
                                <tr><th>No. HP Wali</th><td>: <?= esc($identitasRemaja['no_hp_wali'] ?? '-') ?></td></tr>
                            </table>
                        </div>
                    </div>
                    <?php else: ?>
                    <p class="text-muted">Data identitas belum lengkap</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Kunjungan (<?= count($kunjunganRemaja) ?> kunjungan)</h3>
                </div>
                <div class="card-body">
                    <?php if (empty($kunjunganRemaja)): ?>
                        <p class="text-muted">Belum ada data kunjungan</p>
                    <?php else: ?>
                        <div class="accordion" id="accordionRemaja">
                        <?php foreach ($kunjunganRemaja as $idx => $kr): ?>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">
                                    <a data-toggle="collapse" href="#kunjungan-remaja-<?= $kr['id'] ?>" class="<?= $kr['kunjungan_ke'] > 1 ? 'collapsed' : '' ?>">
                                        Kunjungan ke-<?= $kr['kunjungan_ke'] ?> <small class="text-muted">(<?= date('d-m-Y', strtotime($kr['tanggal_kunjungan'])) ?>)</small>
                                    </a>
                                </h4>
                            </div>
                            <div id="kunjungan-remaja-<?= $kr['id'] ?>" class="collapse<?= $kr['kunjungan_ke'] === 1 ? ' show' : '' ?>" data-parent="#accordionRemaja">
                                <div class="card-body">
                                    <?php if ($kr['antropometri']): ?>
                                    <div class="mb-2">
                                        <strong>Antropometri:</strong>
                                        <?php 
                                        $antropometriList = [];
                                        if ($kr['antropometri']['berat_badan']) {
                                            $bb = floatval($kr['antropometri']['berat_badan']);
                                            $antropometriList[] = 'BB: ' . ($bb == intval($bb) ? intval($bb) : $bb) . ' kg';
                                        }
                                        if ($kr['antropometri']['tinggi_badan']) {
                                            $tb = floatval($kr['antropometri']['tinggi_badan']);
                                            $antropometriList[] = 'TB: ' . ($tb == intval($tb) ? intval($tb) : $tb) . ' cm';
                                        }
                                        if ($kr['antropometri']['lingkar_perut']) {
                                            $lp = floatval($kr['antropometri']['lingkar_perut']);
                                            $antropometriList[] = 'LP: ' . ($lp == intval($lp) ? intval($lp) : $lp) . ' cm';
                                        }
                                        if ($kr['antropometri']['tekanan_darah']) {
                                            $antropometriList[] = 'TD: ' . esc($kr['antropometri']['tekanan_darah']);
                                        }
                                        echo !empty($antropometriList) ? implode(', ', $antropometriList) : 'Tidak ada data';
                                        ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mb-2"><strong>Antropometri:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kr['anemia']): ?>
                                    <div class="mb-2">
                                        <strong>Gejala Anemia:</strong>
                                        <?php if ($kr['anemia']['gejala_anemia']): ?>
                                        <ul class="mb-1">
                                            <?php 
                                            $gejala = str_replace(['[', ']', '"'], '', $kr['anemia']['gejala_anemia']);
                                            $gejalaArray = array_filter(array_map('trim', explode(',', $gejala)));
                                            foreach ($gejalaArray as $item): 
                                            ?>
                                            <li><?= esc($item) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                        Tidak ada gejala
                                        <?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mb-2"><strong>Gejala Anemia:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kr['haid']): ?>
                                    <div class="mt-2">
                                        <strong>Data Menstruasi:</strong>
                                        <ul class="mb-1">
                                            <li>Sudah Menstruasi: <?= $kr['haid']['sudah_menstruasi'] ? 'Ya' : 'Tidak' ?></li>
                                            <?php if ($kr['haid']['sudah_menstruasi']): ?>
                                            <li>Keteraturan Haid: <?= $kr['haid']['keteraturan_haid'] ? esc($kr['haid']['keteraturan_haid']) : 'Tidak ada data' ?></li>
                                            <li>Nyeri Haid: <?= $kr['haid']['nyeri_haid'] ? esc($kr['haid']['nyeri_haid']) : 'Tidak ada data' ?></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Data Menstruasi:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kr['suplementasi']): ?>
                                    <div class="mt-2">
                                        <strong>Suplementasi:</strong>
                                        <?php 
                                        $suplementasiList = [];
                                        if ($kr['suplementasi']['dapat_ttd']) $suplementasiList[] = 'Dapat TTD';
                                        if ($kr['suplementasi']['minum_ttd']) $suplementasiList[] = 'Minum TTD';
                                        if ($kr['suplementasi']['kebiasaan_sarapan']) $suplementasiList[] = 'Sarapan: ' . esc($kr['suplementasi']['kebiasaan_sarapan']);
                                        echo !empty($suplementasiList) ? implode(', ', $suplementasiList) : 'Tidak ada data';
                                        ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Suplementasi:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kr['gaya_hidup']): ?>
                                    <div class="mt-2">
                                        <strong>Gaya Hidup & Risiko PTM:</strong>
                                        <?php if ($kr['gaya_hidup']['risiko_ptm']): ?>
                                        <ul class="mb-1">
                                            <?php 
                                            $risiko = str_replace(['[', ']', '"'], '', $kr['gaya_hidup']['risiko_ptm']);
                                            $risikoArray = array_filter(array_map('trim', explode(',', $risiko)));
                                            foreach ($risikoArray as $item): 
                                            ?>
                                            <li><?= esc($item) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                        Tidak ada data
                                        <?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Gaya Hidup & Risiko PTM:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if ($kr['swamedikasi']): ?>
                                    <div class="mt-2">
                                        <strong>Perilaku Swamedikasi:</strong>
                                        <?php if ($kr['swamedikasi']['perilaku_swamedikasi']): ?>
                                        <ul class="mb-1">
                                            <?php 
                                            $swamed = str_replace(['[', ']', '"'], '', $kr['swamedikasi']['perilaku_swamedikasi']);
                                            $swamedArray = array_filter(array_map('trim', explode(',', $swamed)));
                                            foreach ($swamedArray as $item): 
                                            ?>
                                            <li><?= esc($item) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php else: ?>
                                        Tidak ada data
                                        <?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                    <div class="mt-2"><strong>Perilaku Swamedikasi:</strong> Tidak ada data</div>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($kr['catatan'])): ?>
                                    <div class="mt-2">
                                        <strong>Catatan:</strong> <?= esc($kr['catatan']) ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <?php if (!$monitoring && !$monitoringBalita && !$monitoringRemaja): ?>
    <div class="alert alert-info mt-3">
        Pengguna ini belum memiliki data monitoring kesehatan.
    </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
