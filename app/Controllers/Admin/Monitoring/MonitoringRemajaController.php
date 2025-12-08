<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MonitoringRemaja\MonitoringRemajaModel;
use App\Models\MonitoringRemaja\MonitoringRemajaIdentitasModel;
use App\Models\MonitoringRemaja\KunjunganRemajaModel;
use App\Models\MonitoringRemaja\KunjunganRemajaAntropometriModel;
use App\Models\MonitoringRemaja\KunjunganRemajaAnemiaModel;
use App\Models\MonitoringRemaja\KunjunganRemajaHaidModel;
use App\Models\MonitoringRemaja\KunjunganRemajaGayaHidupModel;
use App\Models\MonitoringRemaja\KunjunganRemajaSuplementasiModel;
use App\Models\MonitoringRemaja\KunjunganRemajaSwamedikasModel;

class MonitoringRemajaController extends BaseController
{
    protected $monitoringRemajaModel;
    protected $identitasModel;
    protected $userModel;
    protected $kunjunganModel;
    protected $antropometriModel;
    protected $anemiaModel;
    protected $haidModel;
    protected $gayaHidupModel;
    protected $suplementasiModel;
    protected $swamedikasModel;

    public function __construct()
    {
        $this->monitoringRemajaModel = new MonitoringRemajaModel();
        $this->identitasModel = new MonitoringRemajaIdentitasModel();
        $this->userModel = new UserModel();
        $this->kunjunganModel = new KunjunganRemajaModel();
        $this->antropometriModel = new KunjunganRemajaAntropometriModel();
        $this->anemiaModel = new KunjunganRemajaAnemiaModel();
        $this->haidModel = new KunjunganRemajaHaidModel();
        $this->gayaHidupModel = new KunjunganRemajaGayaHidupModel();
        $this->suplementasiModel = new KunjunganRemajaSuplementasiModel();
        $this->swamedikasModel = new KunjunganRemajaSwamedikasModel();
    }

    public function remaja()
    {
        $role = session()->get('role');
        $padukuhanId = null;
        
        if ($role === 'admin') {
            $padukuhanId = session()->get('padukuhan_id');
        }
        
        $perPage = 10;
        $search = $this->request->getGet('search');
        
        $query = $this->monitoringRemajaModel->getAllWithUserInfo($padukuhanId);
        
        if ($search) {
            $query->groupStart()
                  ->like('monitoring_remaja_identitas.nama_lengkap', $search)
                  ->orLike('users.username', $search)
                  ->groupEnd();
        }
        
        // Get health alerts
        $alertResult = $this->getRemajaAlerts($padukuhanId);
        
        $data = [
            'title' => 'Monitoring Remaja',
            'monitoringList' => $query->paginate($perPage),
            'pager' => $this->monitoringRemajaModel->pager,
            'search' => $search,
            'alertCount' => $alertResult['count'],
            'alertData' => $alertResult['data']
        ];
        return view('admin/monitoring/remaja', $data);
    }

    private function getRemajaAlerts($padukuhanId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kunjungan_remaja kr')
            ->select('mri.nama_lengkap, mri.no_hp_wali, kra.tekanan_darah, krs.dapat_ttd, krs.minum_ttd, krs.kebiasaan_sarapan, kran.gejala_anemia')
            ->join('monitoring_remaja mr', 'mr.id = kr.monitoring_id')
            ->join('monitoring_remaja_identitas mri', 'mri.monitoring_id = mr.id')
            ->join('kunjungan_remaja_antropometri kra', 'kra.kunjungan_id = kr.id')
            ->join('kunjungan_remaja_suplementasi krs', 'krs.kunjungan_id = kr.id')
            ->join('kunjungan_remaja_anemia kran', 'kran.kunjungan_id = kr.id')
            ->join('users u', 'u.id = mr.user_id')
            ->orderBy('kr.tanggal_kunjungan', 'DESC')
            ->limit(100);
        
        if ($padukuhanId) {
            $builder->where('u.padukuhan_id', $padukuhanId);
        }
        
        $results = $builder->get()->getResultArray();
        $alertData = ['td_tinggi' => [], 'ttd' => [], 'anemia' => [], 'sarapan' => []];
        $alertCount = 0;
        
        foreach ($results as $row) {
            // 1. Tekanan darah tinggi
            if (!empty($row['tekanan_darah'])) {
                $td = explode('/', $row['tekanan_darah']);
                if (count($td) == 2 && ((int)$td[0] >= 140 || (int)$td[1] >= 90)) {
                    $alertData['td_tinggi'][] = ['nama' => $row['nama_lengkap'], 'hp' => $row['no_hp_wali'], 'detail' => $row['tekanan_darah']];
                    $alertCount++;
                }
            }
            // 2. Tidak minum TTD
            if ($row['dapat_ttd'] == 1 && $row['minum_ttd'] == 0) {
                $alertData['ttd'][] = ['nama' => $row['nama_lengkap'], 'hp' => $row['no_hp_wali'], 'detail' => 'Tidak diminum'];
                $alertCount++;
            }
            // 3. Anemia
            if (!empty($row['gejala_anemia'])) {
                $gejala = json_decode($row['gejala_anemia'], true);
                if (is_array($gejala) && count($gejala) > 0) {
                    $alertData['anemia'][] = ['nama' => $row['nama_lengkap'], 'hp' => $row['no_hp_wali'], 'detail' => implode(', ', $gejala)];
                    $alertCount++;
                }
            }
            // 4. Tidak sarapan
            if ($row['kebiasaan_sarapan'] === 'Tidak Pernah') {
                $alertData['sarapan'][] = ['nama' => $row['nama_lengkap'], 'hp' => $row['no_hp_wali'], 'detail' => 'Tidak pernah'];
                $alertCount++;
            }
        }
        
        return ['count' => $alertCount, 'data' => $alertData];
    }

    public function input($userId = null)
    {
        $role = session()->get('role');
        $padukuhanId = session()->get('padukuhan_id');
        
        // Filter user yang belum punya data remaja
        $builder = $this->userModel->builder();
        $builder->select('users.*')
                ->where('users.role', 'pengguna')
                ->whereNotIn('users.id', function($builder) use ($padukuhanId) {
                    $builder->select('user_id')
                            ->from('monitoring_remaja');
                    if ($padukuhanId) {
                        $builder->join('users', 'users.id = monitoring_remaja.user_id')
                                ->where('users.padukuhan_id', $padukuhanId);
                    }
                });
        
        if ($role === 'admin' && $padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        $users = $builder->get()->getResultArray();
        
        $data = [
            'title' => 'Input Data Monitoring Remaja',
            'users' => $users,
            'selectedUserId' => $userId
        ];
        
        return view('admin/monitoring/input-remaja', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $adminId = session()->get('user_id') ?? auth()->id();
            $userId = $this->request->getPost('user_id');

            $existingMonitoring = $this->monitoringRemajaModel->getByUserIdAndCategory($userId, 'remaja');
            
            if ($existingMonitoring) {
                session()->setFlashdata('error', 'Pasien sudah memiliki monitoring remaja aktif');
                return redirect()->back()->withInput();
            }

            $monitoringId = $this->monitoringRemajaModel->insert([
                'user_id' => $userId,
                'admin_id' => $adminId,
                'category' => 'remaja',
                'status' => 'active'
            ]);

            $this->identitasModel->insert([
                'monitoring_id' => $monitoringId,
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nik' => $this->request->getPost('nik'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'nama_wali' => $this->request->getPost('nama_wali'),
                'no_hp_wali' => $this->request->getPost('no_hp_wali'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $kunjunganId = $this->kunjunganModel->insert([
                'monitoring_id' => $monitoringId,
                'kunjungan_ke' => 1,
                'tanggal_kunjungan' => date('Y-m-d'),
                'catatan' => 'Kunjungan pertama - Registrasi monitoring remaja'
            ]);

            $this->antropometriModel->insert([
                'kunjungan_id' => $kunjunganId,
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lingkar_perut' => $this->request->getPost('lingkar_perut'),
                'tekanan_darah' => $this->request->getPost('tekanan_darah'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $gejalaAnemia = $this->request->getPost('gejala_anemia') ?? [];
            $this->anemiaModel->insert([
                'kunjungan_id' => $kunjunganId,
                'gejala_anemia' => json_encode($gejalaAnemia),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $jenisKelamin = $this->request->getPost('jenis_kelamin');
            if ($jenisKelamin === 'P') {
                $this->haidModel->insert([
                    'kunjungan_id' => $kunjunganId,
                    'sudah_menstruasi' => $this->request->getPost('sudah_menstruasi') ?: 'Tidak',
                    'keteraturan_haid' => $this->request->getPost('keteraturan_haid') ?: 'Belum Menstruasi',
                    'nyeri_haid' => $this->request->getPost('nyeri_haid') ?: 'Tidak',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            $risikoPtm = $this->request->getPost('risiko_ptm') ?? [];
            $this->gayaHidupModel->insert([
                'kunjungan_id' => $kunjunganId,
                'risiko_ptm' => json_encode($risikoPtm),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->suplementasiModel->insert([
                'kunjungan_id' => $kunjunganId,
                'dapat_ttd' => $this->request->getPost('dapat_ttd') ? 1 : 0,
                'minum_ttd' => $this->request->getPost('minum_ttd') ? 1 : 0,
                'kebiasaan_sarapan' => $this->request->getPost('kebiasaan_sarapan') ?: 'Kadang-kadang',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $perilakuSwamedikasi = $this->request->getPost('perilaku_swamedikasi') ?? [];
            $this->swamedikasModel->insert([
                'kunjungan_id' => $kunjunganId,
                'perilaku_swamedikasi' => json_encode($perilakuSwamedikasi),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal menyimpan data monitoring remaja');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Data monitoring remaja berhasil disimpan');
            return redirect()->to(base_url('admin/monitoring/remaja'));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Monitoring remaja store error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function riwayat($monitoringId)
    {
        $monitoring = $this->monitoringRemajaModel->find($monitoringId);
        
        if (!$monitoring) {
            session()->setFlashdata('error', 'Data monitoring tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/remaja'));
        }

        $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
        
        $kunjunganList = $this->kunjunganModel->getByMonitoringId($monitoringId);
        foreach ($kunjunganList as &$kunjungan) {
            $kunjungan['antropometri'] = $this->antropometriModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['anemia'] = $this->anemiaModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['haid'] = $this->haidModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['gaya_hidup'] = $this->gayaHidupModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['suplementasi'] = $this->suplementasiModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['swamedikasi'] = $this->swamedikasModel->where('kunjungan_id', $kunjungan['id'])->first();
        }

        $data = [
            'title' => 'Detail Monitoring Remaja',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'kunjunganList' => $kunjunganList,
            'totalKunjungan' => count($kunjunganList)
        ];

        return view('admin/monitoring/riwayat-remaja', $data);
    }

    public function inputKunjungan($monitoringId)
    {
        $monitoring = $this->monitoringRemajaModel->find($monitoringId);
        
        if (!$monitoring) {
            session()->setFlashdata('error', 'Data monitoring tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/remaja'));
        }

        $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
        $kunjunganKe = $this->kunjunganModel->getNextKunjunganKe($monitoringId);

        $data = [
            'title' => 'Input Kunjungan Rutin Remaja',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'kunjunganKe' => $kunjunganKe
        ];

        return view('admin/monitoring/input-kunjungan-remaja', $data);
    }

    public function storeKunjungan($monitoringId)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $kunjunganKe = $this->kunjunganModel->getNextKunjunganKe($monitoringId);
            $tanggalKunjungan = $this->request->getPost('tanggal_kunjungan') ?: date('Y-m-d');

            $kunjunganId = $this->kunjunganModel->insert([
                'monitoring_id' => $monitoringId,
                'kunjungan_ke' => $kunjunganKe,
                'tanggal_kunjungan' => $tanggalKunjungan,
                'catatan' => $this->request->getPost('catatan')
            ]);

            $this->antropometriModel->insert([
                'kunjungan_id' => $kunjunganId,
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lingkar_perut' => $this->request->getPost('lingkar_perut'),
                'tekanan_darah' => $this->request->getPost('tekanan_darah'),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $gejalaAnemia = $this->request->getPost('gejala_anemia') ?? [];
            $this->anemiaModel->insert([
                'kunjungan_id' => $kunjunganId,
                'gejala_anemia' => json_encode($gejalaAnemia),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
            if ($identitas && $identitas['jenis_kelamin'] === 'P') {
                $this->haidModel->insert([
                    'kunjungan_id' => $kunjunganId,
                    'sudah_menstruasi' => $this->request->getPost('sudah_menstruasi') ?: 'Tidak',
                    'keteraturan_haid' => $this->request->getPost('keteraturan_haid') ?: 'Belum Menstruasi',
                    'nyeri_haid' => $this->request->getPost('nyeri_haid') ?: 'Tidak',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }

            $risikoPtm = $this->request->getPost('risiko_ptm') ?? [];
            $this->gayaHidupModel->insert([
                'kunjungan_id' => $kunjunganId,
                'risiko_ptm' => json_encode($risikoPtm),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $this->suplementasiModel->insert([
                'kunjungan_id' => $kunjunganId,
                'dapat_ttd' => $this->request->getPost('dapat_ttd') ? 1 : 0,
                'minum_ttd' => $this->request->getPost('minum_ttd') ? 1 : 0,
                'kebiasaan_sarapan' => $this->request->getPost('kebiasaan_sarapan') ?: 'Kadang-kadang',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $perilakuSwamedikasi = $this->request->getPost('perilaku_swamedikasi') ?? [];
            $this->swamedikasModel->insert([
                'kunjungan_id' => $kunjunganId,
                'perilaku_swamedikasi' => json_encode($perilakuSwamedikasi),
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal menyimpan data kunjungan');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Data kunjungan berhasil disimpan');
            return redirect()->to(base_url('admin/monitoring/remaja/riwayat/' . $monitoringId));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Kunjungan remaja store error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function editMaster($monitoringId)
    {
        $monitoring = $this->monitoringRemajaModel->find($monitoringId);
        
        if (!$monitoring) {
            session()->setFlashdata('error', 'Data monitoring tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/remaja'));
        }

        $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();

        $data = [
            'title' => 'Edit Data Identitas Remaja',
            'monitoring' => $monitoring,
            'identitas' => $identitas
        ];

        return view('admin/monitoring/edit-master-remaja', $data);
    }

    public function updateMaster($monitoringId)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $this->identitasModel->where('monitoring_id', $monitoringId)->set([
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'nik' => $this->request->getPost('nik'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'nama_wali' => $this->request->getPost('nama_wali'),
                'no_hp_wali' => $this->request->getPost('no_hp_wali')
            ])->update();

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal mengupdate data identitas');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Data identitas berhasil diupdate');
            return redirect()->to(base_url('admin/monitoring/remaja/riwayat/' . $monitoringId));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Update master remaja error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function deleteMonitoring($monitoringId)
    {
        if ($this->monitoringRemajaModel->delete($monitoringId)) {
            session()->setFlashdata('success', 'Data monitoring berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data monitoring');
        }

        return redirect()->to(base_url('admin/monitoring/remaja'));
    }

    public function editKunjungan($monitoringId, $kunjunganId)
    {
        $monitoring = $this->monitoringRemajaModel->find($monitoringId);
        
        if (!$monitoring) {
            session()->setFlashdata('error', 'Data monitoring tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/remaja'));
        }

        $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
        $kunjungan = $this->kunjunganModel->find($kunjunganId);
        
        if (!$kunjungan || $kunjungan['monitoring_id'] != $monitoringId) {
            session()->setFlashdata('error', 'Data kunjungan tidak ditemukan');
            return redirect()->to(base_url('admin/monitoring/remaja/riwayat/' . $monitoringId));
        }

        $kunjunganData = [
            'kunjungan' => $kunjungan,
            'antropometri' => $this->antropometriModel->where('kunjungan_id', $kunjunganId)->first(),
            'anemia' => $this->anemiaModel->where('kunjungan_id', $kunjunganId)->first(),
            'haid' => $this->haidModel->where('kunjungan_id', $kunjunganId)->first(),
            'gaya_hidup' => $this->gayaHidupModel->where('kunjungan_id', $kunjunganId)->first(),
            'suplementasi' => $this->suplementasiModel->where('kunjungan_id', $kunjunganId)->first(),
            'swamedikasi' => $this->swamedikasModel->where('kunjungan_id', $kunjunganId)->first()
        ];

        $data = [
            'title' => 'Edit Kunjungan Remaja',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'kunjunganData' => $kunjunganData,
            'isEdit' => true
        ];

        return view('admin/monitoring/edit-kunjungan-remaja', $data);
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

            $this->kunjunganModel->update($kunjunganId, [
                'tanggal_kunjungan' => $tanggalKunjungan,
                'catatan' => $this->request->getPost('catatan')
            ]);

            $this->antropometriModel->where('kunjungan_id', $kunjunganId)->set([
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lingkar_perut' => $this->request->getPost('lingkar_perut'),
                'tekanan_darah' => $this->request->getPost('tekanan_darah')
            ])->update();

            $gejalaAnemia = $this->request->getPost('gejala_anemia') ?? [];
            $this->anemiaModel->where('kunjungan_id', $kunjunganId)->set([
                'gejala_anemia' => json_encode($gejalaAnemia)
            ])->update();

            $identitas = $this->identitasModel->where('monitoring_id', $monitoringId)->first();
            if ($identitas && $identitas['jenis_kelamin'] === 'P') {
                $this->haidModel->where('kunjungan_id', $kunjunganId)->set([
                    'sudah_menstruasi' => $this->request->getPost('sudah_menstruasi') ?: 'Tidak',
                    'keteraturan_haid' => $this->request->getPost('keteraturan_haid') ?: 'Belum Menstruasi',
                    'nyeri_haid' => $this->request->getPost('nyeri_haid') ?: 'Tidak'
                ])->update();
            }

            $risikoPtm = $this->request->getPost('risiko_ptm') ?? [];
            $this->gayaHidupModel->where('kunjungan_id', $kunjunganId)->set([
                'risiko_ptm' => json_encode($risikoPtm)
            ])->update();

            $this->suplementasiModel->where('kunjungan_id', $kunjunganId)->set([
                'dapat_ttd' => $this->request->getPost('dapat_ttd') ? 1 : 0,
                'minum_ttd' => $this->request->getPost('minum_ttd') ? 1 : 0,
                'kebiasaan_sarapan' => $this->request->getPost('kebiasaan_sarapan') ?: 'Kadang-kadang'
            ])->update();

            $perilakuSwamedikasi = $this->request->getPost('perilaku_swamedikasi') ?? [];
            $this->swamedikasModel->where('kunjungan_id', $kunjunganId)->set([
                'perilaku_swamedikasi' => json_encode($perilakuSwamedikasi)
            ])->update();

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata('error', 'Gagal mengupdate data kunjungan');
                return redirect()->back()->withInput();
            }

            session()->setFlashdata('success', 'Data kunjungan berhasil diupdate');
            return redirect()->to(base_url('admin/monitoring/remaja/riwayat/' . $monitoringId));

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Kunjungan remaja update error: ' . $e->getMessage());
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

        return redirect()->to(base_url('admin/monitoring/remaja/riwayat/' . $monitoringId));
    }
}
