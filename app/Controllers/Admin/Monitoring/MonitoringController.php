<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\Monitoring\MonitoringIbuHamilModel;
use App\Models\Monitoring\MonitoringIdentitasModel;
use App\Models\Monitoring\MonitoringRiwayatPenyakitModel;
use App\Models\Monitoring\MonitoringSkriningModel;
use App\Models\Monitoring\KunjunganModel;
use App\Models\Monitoring\KunjunganAntropometriModel;
use App\Models\Monitoring\KunjunganKeluhanModel;
use App\Models\Monitoring\KunjunganSuplementasiModel;
use App\Models\Monitoring\KunjunganEtnomedisinModel;

class MonitoringController extends BaseController
{
    const MAX_KUNJUNGAN = 15;
    
    protected $monitoringModel;
    protected $identitasModel;
    protected $riwayatPenyakitModel;
    protected $skriningModel;
    protected $userModel;
    protected $kunjunganModel;
    protected $kunjunganAntropometriModel;
    protected $kunjunganKeluhanModel;
    protected $kunjunganSuplementasiModel;
    protected $kunjunganEtnomedisinModel;

    public function __construct()
    {
        $this->monitoringModel = new MonitoringIbuHamilModel();
        $this->identitasModel = new MonitoringIdentitasModel();
        $this->riwayatPenyakitModel = new MonitoringRiwayatPenyakitModel();
        $this->skriningModel = new MonitoringSkriningModel();
        $this->userModel = new UserModel();
        $this->kunjunganModel = new KunjunganModel();
        $this->kunjunganAntropometriModel = new KunjunganAntropometriModel();
        $this->kunjunganKeluhanModel = new KunjunganKeluhanModel();
        $this->kunjunganSuplementasiModel = new KunjunganSuplementasiModel();
        $this->kunjunganEtnomedisinModel = new KunjunganEtnomedisinModel();
    }

    public function dashboard()
    {
        $data = [
            'title' => 'Dashboard Monitoring'
        ];
        return view('admin/monitoring/dashboard', $data);
    }

    public function ibuHamil()
    {
        $role = session()->get('role');
        $padukuhanId = null;
        
        // Admin hanya lihat data padukuhan sendiri
        if ($role === 'admin') {
            $padukuhanId = session()->get('padukuhan_id');
        }
        
        $perPage = 10;
        $search = $this->request->getGet('search');
        
        $query = $this->monitoringModel->getAllWithUserInfo($padukuhanId);
        
        if ($search) {
            $query->groupStart()
                  ->like('monitoring_identitas.nama_ibu', $search)
                  ->orLike('users.username', $search)
                  ->groupEnd();
        }
        
        // Get health alerts
        $alerts = $this->getIbuHamilAlerts($padukuhanId);
        
        $data = [
            'title' => 'Monitoring Ibu Hamil',
            'monitoringList' => $query->paginate($perPage),
            'pager' => $this->monitoringModel->pager,
            'search' => $search,
            'alerts' => $alerts
        ];
        return view('admin/monitoring/ibu-hamil', $data);
    }

    private function getIbuHamilAlerts($padukuhanId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kunjungan_antropometri ka')
            ->select('mi.nama_ibu, mi.nomor_telepon, ka.tekanan_darah, ka.lila, mi.rencana_tanggal_persalinan, kk.keluhan')
            ->join('kunjungan k', 'k.id = ka.kunjungan_id')
            ->join('monitoring_ibu_hamil mih', 'mih.id = k.monitoring_id')
            ->join('monitoring_identitas mi', 'mi.monitoring_id = mih.id')
            ->join('kunjungan_keluhan kk', 'kk.kunjungan_id = k.id')
            ->join('users u', 'u.id = mih.user_id')
            ->orderBy('k.tanggal_kunjungan', 'DESC')
            ->limit(100);
        
        if ($padukuhanId) {
            $builder->where('u.padukuhan_id', $padukuhanId);
        }
        
        $results = $builder->get()->getResultArray();
        $alertData = ['td_tinggi' => [], 'lila_rendah' => [], 'anemia' => [], 'hpl_dekat' => []];
        $alertCount = 0;
        
        foreach ($results as $row) {
            // 1. Tekanan darah tinggi
            if (!empty($row['tekanan_darah'])) {
                $td = explode('/', $row['tekanan_darah']);
                if (count($td) == 2 && ((int)$td[0] >= 140 || (int)$td[1] >= 90)) {
                    $alertData['td_tinggi'][] = ['nama' => $row['nama_ibu'], 'hp' => $row['nomor_telepon'], 'detail' => $row['tekanan_darah']];
                    $alertCount++;
                }
            }
            // 2. LILA rendah
            if (!empty($row['lila']) && (float)$row['lila'] < 23.5) {
                $alertData['lila_rendah'][] = ['nama' => $row['nama_ibu'], 'hp' => $row['nomor_telepon'], 'detail' => $row['lila'] . ' cm'];
                $alertCount++;
            }
            // 3. Anemia
            if (!empty($row['keluhan'])) {
                $keluhan = json_decode($row['keluhan'], true);
                if (is_array($keluhan) && (in_array('Pucat', $keluhan) || in_array('Pusing', $keluhan) || in_array('Lemas', $keluhan))) {
                    $alertData['anemia'][] = ['nama' => $row['nama_ibu'], 'hp' => $row['nomor_telepon'], 'detail' => implode(', ', $keluhan)];
                    $alertCount++;
                }
            }
            // 4. HPL Dekat
            if (!empty($row['rencana_tanggal_persalinan'])) {
                $hpl = strtotime($row['rencana_tanggal_persalinan']);
                $now = time();
                $diff = ($hpl - $now) / 86400;
                if ($diff > 0 && $diff <= 14) {
                    $alertData['hpl_dekat'][] = ['nama' => $row['nama_ibu'], 'hp' => $row['nomor_telepon'], 'detail' => round($diff) . ' hari lagi'];
                    $alertCount++;
                }
            }
        }
        
        return ['count' => $alertCount, 'data' => $alertData];
    }

    public function balita()
    {
        $data = ['title' => 'Monitoring Balita & Anak'];
        return view('admin/monitoring/balita', $data);
    }

    public function remaja()
    {
        $data = ['title' => 'Monitoring Remaja'];
        return view('admin/monitoring/remaja', $data);
    }

    public function riwayat($monitoringId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        
        if (!$monitoring) {
            session()->setFlashdata('error', 'Data monitoring tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/ibu-hamil'));
        }

        $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
        $riwayatPenyakit = $this->riwayatPenyakitModel->where('monitoring_id', $monitoringId)->first();
        $skrining = $this->skriningModel->where('monitoring_id', $monitoringId)->first();
        
        // Get all kunjungan with details
        $kunjunganList = $this->kunjunganModel->getByMonitoringId($monitoringId);
        foreach ($kunjunganList as &$kunjungan) {
            $kunjungan['antropometri'] = $this->kunjunganAntropometriModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['keluhan'] = $this->kunjunganKeluhanModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['suplementasi'] = $this->kunjunganSuplementasiModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['etnomedisin'] = $this->kunjunganEtnomedisinModel->where('kunjungan_id', $kunjungan['id'])->first();
        }

        $totalKunjungan = count($kunjunganList);
        $maxKunjungan = self::MAX_KUNJUNGAN;
        $canAddKunjungan = $totalKunjungan < $maxKunjungan;
        
        $data = [
            'title' => 'Detail Monitoring',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'riwayatPenyakit' => $riwayatPenyakit,
            'skrining' => $skrining,
            'kunjunganList' => $kunjunganList,
            'totalKunjungan' => $totalKunjungan,
            'maxKunjungan' => $maxKunjungan,
            'canAddKunjungan' => $canAddKunjungan
        ];

        return view('admin/monitoring/riwayat', $data);
    }

    public function input($userId = null)
    {
        $role = session()->get('role');
        $padukuhanId = session()->get('padukuhan_id');
        
        // Filter user yang belum punya data ibu hamil
        $builder = $this->userModel->builder();
        $builder->select('users.*')
                ->where('users.role', 'pengguna')
                ->whereNotIn('users.id', function($builder) use ($padukuhanId) {
                    $builder->select('user_id')
                            ->from('monitoring_ibu_hamil');
                    if ($padukuhanId) {
                        $builder->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                                ->where('users.padukuhan_id', $padukuhanId);
                    }
                });
        
        if ($role === 'admin' && $padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        $users = $builder->get()->getResultArray();
        
        $data = [
            'title' => 'Input Data Monitoring',
            'users' => $users,
            'selectedUserId' => $userId
        ];
        
        return view('admin/monitoring/input', $data);
    }

    public function store()
    {
        log_message('info', 'Store method called');
        log_message('info', 'POST data: ' . json_encode($this->request->getPost()));
        
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $adminId = session()->get('user_id') ?? auth()->id();
            $userId = $this->request->getPost('user_id');

            // Cek apakah sudah ada monitoring aktif
            $existingMonitoring = $this->monitoringModel->getByUserId($userId);
            
            if ($existingMonitoring) {
                if ($this->request->isAJAX()) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Pasien sudah memiliki monitoring aktif'
                    ]);
                }
                session()->setFlashdata('error', 'Pasien sudah memiliki monitoring aktif');
                return redirect()->route('admin.monitoring.input')->withInput();
            }

            // Insert monitoring master
            $monitoringId = $this->monitoringModel->insert([
                'user_id' => $userId,
                'admin_id' => $adminId,
                'category' => 'ibu_hamil',
                'status' => 'active'
            ]);

            // Data Master: Identitas
            $this->identitasModel->insert([
                'monitoring_id' => $monitoringId,
                'nama_ibu' => $this->request->getPost('nama_ibu'),
                'nama_suami' => $this->request->getPost('nama_suami'),
                'usia_ibu' => $this->request->getPost('usia_ibu'),
                'usia_suami' => $this->request->getPost('usia_suami'),
                'alamat' => $this->request->getPost('alamat'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'usia_kehamilan' => $this->request->getPost('usia_kehamilan'),
                'rencana_tanggal_persalinan' => $this->request->getPost('rencana_tanggal_persalinan'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Data Master: Riwayat Penyakit
            $riwayatPenyakit = $this->request->getPost('riwayat_penyakit') ?? [];
            $tidakAdaRiwayat = $this->request->getPost('tidak_ada_riwayat') ? 1 : 0;
            $this->riwayatPenyakitModel->insert([
                'monitoring_id' => $monitoringId,
                'riwayat_penyakit' => json_encode($riwayatPenyakit),
                'tidak_ada_riwayat' => $tidakAdaRiwayat,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Data Master: Skrining
            $this->skriningModel->insert([
                'monitoring_id' => $monitoringId,
                'tempat_persalinan' => $this->request->getPost('tempat_persalinan'),
                'penolong_persalinan' => $this->request->getPost('penolong_persalinan'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Kunjungan Pertama
            $kunjunganId = $this->kunjunganModel->insert([
                'monitoring_id' => $monitoringId,
                'kunjungan_ke' => 1,
                'tanggal_kunjungan' => date('Y-m-d'),
                'catatan' => 'Kunjungan pertama - Registrasi monitoring',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Kunjungan: Antropometri
            $this->kunjunganAntropometriModel->insert([
                'kunjungan_id' => $kunjunganId,
                'tekanan_darah' => $this->request->getPost('tekanan_darah'),
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lila' => $this->request->getPost('lila'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Kunjungan: Keluhan
            $keluhan = $this->request->getPost('keluhan') ?? [];
            $this->kunjunganKeluhanModel->insert([
                'kunjungan_id' => $kunjunganId,
                'keluhan' => json_encode($keluhan),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Kunjungan: Suplementasi
            $efekSamping = $this->request->getPost('efek_samping') ?? [];
            $this->kunjunganSuplementasiModel->insert([
                'kunjungan_id' => $kunjunganId,
                'nama_suplemen' => $this->request->getPost('nama_suplemen'),
                'status_pemberian' => $this->request->getPost('status_pemberian'),
                'jumlah_tablet' => $this->request->getPost('jumlah_tablet'),
                'frekuensi' => $this->request->getPost('frekuensi'),
                'efek_samping' => json_encode($efekSamping),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            // Kunjungan: Etnomedisin
            $menggunakanObatTradisional = $this->request->getPost('menggunakan_obat_tradisional') ?? 'tidak';
            $jenisObat = $this->request->getPost('jenis_obat') ?? [];
            $tujuanPenggunaan = $this->request->getPost('tujuan_penggunaan') ?? [];
            $edukasiDiberikan = $this->request->getPost('edukasi_diberikan') ?? 'belum';

            $this->kunjunganEtnomedisinModel->insert([
                'kunjungan_id' => $kunjunganId,
                'menggunakan_obat_tradisional' => $menggunakanObatTradisional,
                'jenis_obat' => json_encode($jenisObat),
                'tujuan_penggunaan' => json_encode($tujuanPenggunaan),
                'edukasi_diberikan' => $edukasiDiberikan,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                if ($this->request->isAJAX()) {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Gagal menyimpan data monitoring'
                    ]);
                }
                session()->setFlashdata('error', 'Gagal menyimpan data monitoring');
                return redirect()->route('admin.monitoring.input')->withInput();
            }

            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Data monitoring berhasil disimpan'
                ]);
            }
            
            session()->setFlashdata('success', 'Data monitoring berhasil disimpan');
            return redirect()->to(base_url('admin/monitoring/ibu-hamil'));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Monitoring store error: ' . $e->getMessage());
            log_message('error', 'Stack trace: ' . $e->getTraceAsString());
            log_message('error', 'Last query: ' . $db->getLastQuery());
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error: ' . $e->getMessage()
                ]);
            }
            
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->route('admin.monitoring.input')->withInput();
        }
    }

    public function inputKunjungan($monitoringId, $kunjunganId = null)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        
        if (!$monitoring) {
            session()->setFlashdata('error', 'Data monitoring tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/ibu-hamil'));
        }

        $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
        $isEdit = false;
        $kunjunganData = null;
        $kunjunganKe = $this->kunjunganModel->getNextKunjunganKe($monitoringId);
        
        // Mode Edit
        if ($kunjunganId) {
            $isEdit = true;
            $kunjungan = $this->kunjunganModel->find($kunjunganId);
            
            if (!$kunjungan || $kunjungan['monitoring_id'] != $monitoringId) {
                session()->setFlashdata('error', 'Data kunjungan tidak ditemukan');
                return redirect()->to(base_url('admin/monitoring/riwayat/' . $monitoringId));
            }
            
            $kunjunganKe = $kunjungan['kunjungan_ke'];
            $kunjunganData = [
                'kunjungan' => $kunjungan,
                'antropometri' => $this->kunjunganAntropometriModel->where('kunjungan_id', $kunjunganId)->first(),
                'keluhan' => $this->kunjunganKeluhanModel->where('kunjungan_id', $kunjunganId)->first(),
                'suplementasi' => $this->kunjunganSuplementasiModel->where('kunjungan_id', $kunjunganId)->first(),
                'etnomedisin' => $this->kunjunganEtnomedisinModel->where('kunjungan_id', $kunjunganId)->first()
            ];
        } else {
            // Mode Tambah - Validasi maksimal kunjungan
            if ($kunjunganKe > self::MAX_KUNJUNGAN) {
                session()->setFlashdata('error', 'Maksimal ' . self::MAX_KUNJUNGAN . ' kunjungan telah tercapai');
                return redirect()->to(base_url('admin/monitoring/riwayat/' . $monitoringId));
            }
        }

        $data = [
            'title' => $isEdit ? 'Edit Kunjungan' : 'Input Kunjungan Rutin',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'kunjunganKe' => $kunjunganKe,
            'maxKunjungan' => self::MAX_KUNJUNGAN,
            'isEdit' => $isEdit,
            'kunjunganData' => $kunjunganData
        ];

        return view('admin/monitoring/input-kunjungan', $data);
    }

    public function storeKunjungan($monitoringId)
    {
        // Validasi maksimal kunjungan
        $kunjunganKe = $this->kunjunganModel->getNextKunjunganKe($monitoringId);
        if ($kunjunganKe > self::MAX_KUNJUNGAN) {
            session()->setFlashdata('error', 'Maksimal ' . self::MAX_KUNJUNGAN . ' kunjungan telah tercapai');
            return redirect()->back();
        }
        
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $tanggalKunjungan = $this->request->getPost('tanggal_kunjungan') ?: date('Y-m-d');

            $kunjunganId = $this->kunjunganModel->insert([
                'monitoring_id' => $monitoringId,
                'kunjungan_ke' => $kunjunganKe,
                'tanggal_kunjungan' => $tanggalKunjungan,
                'catatan' => null,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->kunjunganAntropometriModel->insert([
                'kunjungan_id' => $kunjunganId,
                'tekanan_darah' => $this->request->getPost('tekanan_darah'),
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lila' => $this->request->getPost('lila'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $keluhan = $this->request->getPost('keluhan') ?? [];
            $this->kunjunganKeluhanModel->insert([
                'kunjungan_id' => $kunjunganId,
                'keluhan' => json_encode($keluhan),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $efekSamping = $this->request->getPost('efek_samping') ?? [];
            $this->kunjunganSuplementasiModel->insert([
                'kunjungan_id' => $kunjunganId,
                'nama_suplemen' => $this->request->getPost('nama_suplemen'),
                'status_pemberian' => $this->request->getPost('status_pemberian'),
                'jumlah_tablet' => $this->request->getPost('jumlah_tablet'),
                'frekuensi' => $this->request->getPost('frekuensi'),
                'efek_samping' => json_encode($efekSamping),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $menggunakanObatTradisional = $this->request->getPost('menggunakan_obat_tradisional') ?? 'tidak';
            $jenisObat = $this->request->getPost('jenis_obat') ?? [];
            $tujuanPenggunaan = $this->request->getPost('tujuan_penggunaan') ?? [];
            $edukasiDiberikan = $this->request->getPost('edukasi_diberikan') ?? 'belum';

            $this->kunjunganEtnomedisinModel->insert([
                'kunjungan_id' => $kunjunganId,
                'menggunakan_obat_tradisional' => $menggunakanObatTradisional,
                'jenis_obat' => json_encode($jenisObat),
                'tujuan_penggunaan' => json_encode($tujuanPenggunaan),
                'edukasi_diberikan' => $edukasiDiberikan,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal menyimpan data kunjungan');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Data kunjungan berhasil disimpan');
            return redirect()->to(base_url('admin/monitoring/riwayat/' . $monitoringId));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Kunjungan store error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editMaster($monitoringId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        
        if (!$monitoring) {
            session()->setFlashdata('error', 'Data monitoring tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/ibu-hamil'));
        }

        $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
        $riwayatPenyakit = $this->riwayatPenyakitModel->where('monitoring_id', $monitoringId)->first();
        $skrining = $this->skriningModel->where('monitoring_id', $monitoringId)->first();

        $data = [
            'title' => 'Edit Data Master',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'riwayatPenyakit' => $riwayatPenyakit,
            'skrining' => $skrining
        ];

        return view('admin/monitoring/edit-master', $data);
    }

    public function updateMaster($monitoringId)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $this->identitasModel->where('monitoring_id', $monitoringId)->set([
                'nama_ibu' => $this->request->getPost('nama_ibu'),
                'nama_suami' => $this->request->getPost('nama_suami'),
                'usia_ibu' => $this->request->getPost('usia_ibu'),
                'usia_suami' => $this->request->getPost('usia_suami'),
                'alamat' => $this->request->getPost('alamat'),
                'nomor_telepon' => $this->request->getPost('nomor_telepon'),
                'usia_kehamilan' => $this->request->getPost('usia_kehamilan'),
                'rencana_tanggal_persalinan' => $this->request->getPost('rencana_tanggal_persalinan')
            ])->update();

            $riwayatPenyakit = $this->request->getPost('riwayat_penyakit') ?? [];
            $tidakAdaRiwayat = $this->request->getPost('tidak_ada_riwayat') ? 1 : 0;
            $this->riwayatPenyakitModel->where('monitoring_id', $monitoringId)->set([
                'riwayat_penyakit' => json_encode($riwayatPenyakit),
                'tidak_ada_riwayat' => $tidakAdaRiwayat
            ])->update();

            $this->skriningModel->where('monitoring_id', $monitoringId)->set([
                'tempat_persalinan' => $this->request->getPost('tempat_persalinan'),
                'penolong_persalinan' => $this->request->getPost('penolong_persalinan')
            ])->update();

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal mengupdate data master');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Data master berhasil diupdate');
            return redirect()->to(base_url('admin/monitoring/riwayat/' . $monitoringId));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Update master error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function updateKunjungan($kunjunganId)
    {
        $kunjungan = $this->kunjunganModel->find($kunjunganId);
        
        if (!$kunjungan) {
            session()->setFlashdata('error', 'Data kunjungan tidak ditemukan');
            return redirect()->back();
        }

        $monitoringId = $kunjungan['monitoring_id'];
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $tanggalKunjungan = $this->request->getPost('tanggal_kunjungan') ?: date('Y-m-d');

            // Update kunjungan
            $this->kunjunganModel->update($kunjunganId, [
                'tanggal_kunjungan' => $tanggalKunjungan,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Update Antropometri
            $this->kunjunganAntropometriModel->where('kunjungan_id', $kunjunganId)->set([
                'tekanan_darah' => $this->request->getPost('tekanan_darah'),
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lila' => $this->request->getPost('lila')
            ])->update();

            // Update Keluhan
            $keluhan = $this->request->getPost('keluhan') ?? [];
            $this->kunjunganKeluhanModel->where('kunjungan_id', $kunjunganId)->set([
                'keluhan' => json_encode($keluhan)
            ])->update();

            // Update Suplementasi
            $efekSamping = $this->request->getPost('efek_samping') ?? [];
            $this->kunjunganSuplementasiModel->where('kunjungan_id', $kunjunganId)->set([
                'nama_suplemen' => $this->request->getPost('nama_suplemen'),
                'status_pemberian' => $this->request->getPost('status_pemberian'),
                'jumlah_tablet' => $this->request->getPost('jumlah_tablet'),
                'frekuensi' => $this->request->getPost('frekuensi'),
                'efek_samping' => json_encode($efekSamping)
            ])->update();

            // Update Etnomedisin
            $menggunakanObatTradisional = $this->request->getPost('menggunakan_obat_tradisional') ?? 'tidak';
            $jenisObat = $this->request->getPost('jenis_obat') ?? [];
            $tujuanPenggunaan = $this->request->getPost('tujuan_penggunaan') ?? [];
            $edukasiDiberikan = $this->request->getPost('edukasi_diberikan') ?? 'belum';

            $this->kunjunganEtnomedisinModel->where('kunjungan_id', $kunjunganId)->set([
                'menggunakan_obat_tradisional' => $menggunakanObatTradisional,
                'jenis_obat' => json_encode($jenisObat),
                'tujuan_penggunaan' => json_encode($tujuanPenggunaan),
                'edukasi_diberikan' => $edukasiDiberikan
            ])->update();

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal mengupdate data kunjungan');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Data kunjungan berhasil diupdate');
            return redirect()->to(base_url('admin/monitoring/riwayat/' . $monitoringId));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Kunjungan update error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function deleteKunjungan($kunjunganId)
    {
        $kunjungan = $this->kunjunganModel->find($kunjunganId);
        
        if (!$kunjungan) {
            session()->setFlashdata('error', 'Data kunjungan tidak ditemukan');
            return redirect()->back();
        }

        $monitoringId = $kunjungan['monitoring_id'];

        if ($this->kunjunganModel->delete($kunjunganId)) {
            session()->setFlashdata('success', 'Data kunjungan berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data kunjungan');
        }

        return redirect()->to(base_url('admin/monitoring/riwayat/' . $monitoringId));
    }

    public function deleteMonitoring($monitoringId)
    {
        if ($this->monitoringModel->delete($monitoringId)) {
            session()->setFlashdata('success', 'Data monitoring berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data monitoring');
        }

        return redirect()->to(base_url('admin/monitoring/ibu-hamil'));
    }

    public function laporan()
    {
        $role = session()->get('role');
        $padukuhanId = null;
        
        // Admin hanya lihat data padukuhan sendiri, superadmin lihat semua
        if ($role === 'admin') {
            $padukuhanId = session()->get('padukuhan_id');
        }
        
        $tab = $this->request->getGet('tab') ?? 'ibu-hamil';
        $bulan = $this->request->getGet('bulan') ?? date('m');
        $tahun = $this->request->getGet('tahun') ?? date('Y');
        $search = $this->request->getGet('search');
        $perPage = 10;
        
        // Statistik Ibu Hamil
        $totalIbuHamil = $this->monitoringModel->select('monitoring_ibu_hamil.id');
        if ($padukuhanId) {
            $totalIbuHamil->join('users', 'users.id = monitoring_ibu_hamil.user_id')->where('users.padukuhan_id', $padukuhanId);
        }
        $totalIbuHamil = $totalIbuHamil->countAllResults();
        
        // Statistik Remaja
        $remajaModel = new \App\Models\MonitoringRemaja\MonitoringRemajaModel();
        $totalRemaja = $remajaModel->select('monitoring_remaja.id');
        if ($padukuhanId) {
            $totalRemaja->join('users', 'users.id = monitoring_remaja.user_id')->where('users.padukuhan_id', $padukuhanId);
        }
        $totalRemaja = $totalRemaja->countAllResults();
        
        // Statistik Balita
        $balitaModel = new \App\Models\MonitoringBalita\MonitoringBalitaModel();
        $totalBalita = $balitaModel->select('monitoring_balita.id');
        if ($padukuhanId) {
            $totalBalita->join('users', 'users.id = monitoring_balita.user_id')->where('users.padukuhan_id', $padukuhanId);
        }
        $totalBalita = $totalBalita->countAllResults();
        
        // Data per tab
        $dataList = [];
        $pager = null;
        
        if ($tab === 'ibu-hamil') {
            $query = $this->monitoringModel->getAllWithUserInfo($padukuhanId);
            if ($search) $query->groupStart()->like('monitoring_identitas.nama_ibu', $search)->orLike('users.username', $search)->groupEnd();
            $dataList = $query->paginate($perPage);
            $pager = $this->monitoringModel->pager;
        } elseif ($tab === 'remaja') {
            $query = $remajaModel->getAllWithIdentitas($padukuhanId);
            if ($search) $query->groupStart()->like('monitoring_remaja_identitas.nama_lengkap', $search)->orLike('users.username', $search)->groupEnd();
            $dataList = $query->paginate($perPage);
            $pager = $remajaModel->pager;
        } elseif ($tab === 'balita') {
            $query = $balitaModel->getAllWithIdentitas($padukuhanId);
            if ($search) $query->groupStart()->like('monitoring_balita_identitas.nama_anak', $search)->orLike('users.username', $search)->groupEnd();
            $dataList = $query->paginate($perPage);
            $pager = $balitaModel->pager;
        }
        
        $data = [
            'title' => 'Data Statistik & Laporan',
            'tab' => $tab,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'search' => $search,
            'totalIbuHamil' => $totalIbuHamil,
            'totalRemaja' => $totalRemaja,
            'totalBalita' => $totalBalita,
            'dataList' => $dataList,
            'pager' => $pager
        ];
        
        return view('admin/monitoring/laporan', $data);
    }
}
