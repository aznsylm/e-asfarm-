<?php

namespace App\Controllers\Admin\Monitoring;

use App\Controllers\BaseController;
use App\Models\MonitoringBalita\MonitoringBalitaModel;
use App\Models\MonitoringBalita\MonitoringBalitaIdentitasModel;
use App\Models\MonitoringBalita\KunjunganBalitaModel;
use App\Models\MonitoringBalita\KunjunganBalitaAntropometriModel;
use App\Models\MonitoringBalita\KunjunganBalitaKeluhanModel;
use App\Models\MonitoringBalita\KunjunganBalitaImunisasiModel;
use App\Models\MonitoringBalita\KunjunganBalitaImunisasiDetailModel;
use App\Models\MonitoringBalita\KunjunganBalitaKpspModel;
use App\Models\MonitoringBalita\KunjunganBalitaGiziModel;
use App\Models\MonitoringBalita\KunjunganBalitaSwamedikasModel;
use App\Models\UserModel;

class MonitoringBalitaController extends BaseController
{
    protected $monitoringModel;
    protected $identitasModel;
    protected $kunjunganModel;
    protected $antropometriModel;
    protected $keluhanModel;
    protected $imunisasiModel;
    protected $imunisasiDetailModel;
    protected $kpspModel;
    protected $giziModel;
    protected $swamedikasModel;
    protected $userModel;

    public function __construct()
    {
        $this->monitoringModel = new MonitoringBalitaModel();
        $this->identitasModel = new MonitoringBalitaIdentitasModel();
        $this->kunjunganModel = new KunjunganBalitaModel();
        $this->antropometriModel = new KunjunganBalitaAntropometriModel();
        $this->keluhanModel = new KunjunganBalitaKeluhanModel();
        $this->imunisasiModel = new KunjunganBalitaImunisasiModel();
        $this->imunisasiDetailModel = new KunjunganBalitaImunisasiDetailModel();
        $this->kpspModel = new KunjunganBalitaKpspModel();
        $this->giziModel = new KunjunganBalitaGiziModel();
        $this->swamedikasModel = new KunjunganBalitaSwamedikasModel();
        $this->userModel = new UserModel();
    }

    public function balita()
    {
        $role = session()->get('role');
        $padukuhanId = null;
        
        // Admin hanya lihat data padukuhan sendiri
        if ($role === 'admin') {
            $padukuhanId = session()->get('padukuhan_id');
        }
        
        $perPage = 10;
        $search = $this->request->getGet('search');
        
        $query = $this->monitoringModel->getAllWithIdentitas($padukuhanId);
        
        if ($search) {
            $query->groupStart()
                  ->like('monitoring_balita_identitas.nama_anak', $search)
                  ->orLike('users.username', $search)
                  ->groupEnd();
        }
        
        // Get health alerts
        $alertResult = $this->getBalitaAlerts($padukuhanId);
        
        $data = [
            'title' => 'Monitoring Balita & Anak',
            'dataBalita' => $query->paginate($perPage),
            'pager' => $this->monitoringModel->pager,
            'search' => $search,
            'alertCount' => $alertResult['count'],
            'alertData' => $alertResult['data']
        ];
        return view('admin/monitoring/balita', $data);
    }

    private function getBalitaAlerts($padukuhanId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kunjungan_balita kb')
            ->select('mbi.nama_anak, mbi.no_hp_wali, kbi.status_imunisasi, kba.berat_badan, kbg.vitamin_a, kbk.demam, kbk.diare')
            ->join('monitoring_balita mb', 'mb.id = kb.monitoring_balita_id')
            ->join('monitoring_balita_identitas mbi', 'mbi.monitoring_balita_id = mb.id')
            ->join('kunjungan_balita_imunisasi kbi', 'kbi.kunjungan_balita_id = kb.id')
            ->join('kunjungan_balita_antropometri kba', 'kba.kunjungan_balita_id = kb.id')
            ->join('kunjungan_balita_gizi kbg', 'kbg.kunjungan_balita_id = kb.id')
            ->join('kunjungan_balita_keluhan kbk', 'kbk.kunjungan_balita_id = kb.id')
            ->join('users u', 'u.id = mb.user_id')
            ->orderBy('kb.tanggal_kunjungan', 'DESC')
            ->limit(100);
        
        if ($padukuhanId) {
            $builder->where('u.padukuhan_id', $padukuhanId);
        }
        
        $results = $builder->get()->getResultArray();
        $alertData = ['imunisasi' => [], 'bb_kurang' => [], 'vitamin_a' => [], 'keluhan' => []];
        $alertCount = 0;
        
        foreach ($results as $row) {
            // 1. Imunisasi belum lengkap
            if ($row['status_imunisasi'] === 'Belum Lengkap') {
                $alertData['imunisasi'][] = ['nama' => $row['nama_anak'], 'hp' => $row['no_hp_wali'], 'detail' => 'Belum Lengkap'];
                $alertCount++;
            }
            // 2. BB Kurang
            if (!empty($row['berat_badan']) && (float)$row['berat_badan'] < 10) {
                $alertData['bb_kurang'][] = ['nama' => $row['nama_anak'], 'hp' => $row['no_hp_wali'], 'detail' => $row['berat_badan'] . ' kg'];
                $alertCount++;
            }
            // 3. Tidak dapat Vitamin A
            if ($row['vitamin_a'] == 0) {
                $alertData['vitamin_a'][] = ['nama' => $row['nama_anak'], 'hp' => $row['no_hp_wali'], 'detail' => 'Belum dapat'];
                $alertCount++;
            }
            // 4. Keluhan serius
            if ($row['demam'] == 1 || $row['diare'] == 1) {
                $keluhan = [];
                if ($row['demam'] == 1) $keluhan[] = 'Demam';
                if ($row['diare'] == 1) $keluhan[] = 'Diare';
                $alertData['keluhan'][] = ['nama' => $row['nama_anak'], 'hp' => $row['no_hp_wali'], 'detail' => implode(', ', $keluhan)];
                $alertCount++;
            }
        }
        
        return ['count' => $alertCount, 'data' => $alertData];
    }

    public function input()
    {
        $role = session()->get('role');
        $padukuhanId = session()->get('padukuhan_id');
        
        // Filter user yang belum punya data balita
        $builder = $this->userModel->builder();
        $builder->select('users.*')
                ->where('users.role', 'pengguna')
                ->whereNotIn('users.id', function($builder) use ($padukuhanId) {
                    $builder->select('user_id')
                            ->from('monitoring_balita');
                    if ($padukuhanId) {
                        $builder->join('users', 'users.id = monitoring_balita.user_id')
                                ->where('users.padukuhan_id', $padukuhanId);
                    }
                });
        
        if ($role === 'admin' && $padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        $users = $builder->get()->getResultArray();
        
        $data = [
            'title' => 'Input Monitoring Balita',
            'users' => $users
        ];
        return view('admin/monitoring/input-balita', $data);
    }

    public function store()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Cek apakah user sudah punya monitoring balita
            $existingMonitoring = $this->monitoringModel->getByUserIdAndCategory($this->request->getPost('user_id'), 'balita');

            if ($existingMonitoring) {
                return redirect()->back()->with('error', 'User ini sudah memiliki data monitoring balita');
            }

            // 1. Insert monitoring master
            $monitoringId = $this->monitoringModel->insert([
                'user_id' => $this->request->getPost('user_id'),
                'kategori' => 'balita'
            ]);

            // 2. Insert identitas (Tahap 1)
            $this->identitasModel->insert([
                'monitoring_balita_id' => $monitoringId,
                'nama_anak' => $this->request->getPost('nama_anak'),
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
                'nama_wali' => $this->request->getPost('nama_wali'),
                'no_hp_wali' => $this->request->getPost('no_hp_wali')
            ]);

            // 3. Insert kunjungan pertama
            $kunjunganId = $this->kunjunganModel->insert([
                'monitoring_balita_id' => $monitoringId,
                'tanggal_kunjungan' => $this->request->getPost('tanggal_kunjungan'),
                'kunjungan_ke' => 1
            ]);

            // 4. Insert antropometri (Tahap 2)
            $this->antropometriModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lingkar_kepala' => $this->request->getPost('lingkar_kepala')
            ]);

            // 5. Insert keluhan (Tahap 3)
            $this->keluhanModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'batuk' => $this->request->getPost('batuk') ? 1 : 0,
                'pilek' => $this->request->getPost('pilek') ? 1 : 0,
                'demam' => $this->request->getPost('demam') ? 1 : 0,
                'diare' => $this->request->getPost('diare') ? 1 : 0,
                'sembelit' => $this->request->getPost('sembelit') ? 1 : 0,
                'gtm' => $this->request->getPost('gtm') ? 1 : 0,
                'lainnya' => $this->request->getPost('lainnya')
            ]);

            // 6. Insert imunisasi (Tahap 4)
            $imunisasiId = $this->imunisasiModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'riwayat_alergi' => $this->request->getPost('riwayat_alergi'),
                'status_imunisasi' => $this->request->getPost('status_imunisasi')
            ]);

            // 6a. Insert detail imunisasi (9 jenis vaksin)
            $vaksinData = $this->request->getPost('vaksin');
            if ($vaksinData) {
                foreach ($vaksinData as $jenisVaksin => $waktuArray) {
                    if (!empty($waktuArray)) {
                        $this->imunisasiDetailModel->insert([
                            'kunjungan_balita_imunisasi_id' => $imunisasiId,
                            'jenis_vaksin' => $jenisVaksin,
                            'waktu_pemberian' => json_encode($waktuArray)
                        ]);
                    }
                }
            }

            // 7. Insert KPSP (Tahap 5)
            $this->kpspModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'hasil_skrining' => $this->request->getPost('hasil_skrining')
            ]);

            // 8. Insert gizi (Tahap 6)
            $this->giziModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'vitamin_a' => $this->request->getPost('vitamin_a') ? 1 : 0,
                'obat_cacing' => $this->request->getPost('obat_cacing') ? 1 : 0,
                'pola_makan' => $this->request->getPost('pola_makan')
            ]);

            // 9. Insert swamedikasi (Tahap 7)
            $this->swamedikasModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'ke_nakes' => $this->request->getPost('ke_nakes') ? 1 : 0,
                'obat_modern' => $this->request->getPost('obat_modern') ? 1 : 0,
                'antibiotik' => $this->request->getPost('antibiotik') ? 1 : 0,
                'etnomedisin' => $this->request->getPost('etnomedisin') ? 1 : 0
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal menyimpan data')->withInput();
            }

            return redirect()->to('/admin/monitoring/balita')->with('success', 'Data monitoring balita berhasil disimpan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function riwayat($monitoringId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        if (!$monitoring) {
            return redirect()->to('/admin/monitoring/balita')->with('error', 'Data tidak ditemukan');
        }

        $identitas = $this->identitasModel->getByMonitoringId($monitoringId);
        $kunjungan = $this->kunjunganModel->getByMonitoringId($monitoringId);

        // Get detail untuk setiap kunjungan
        foreach ($kunjungan as &$k) {
            $k['antropometri'] = $this->antropometriModel->getByKunjunganId($k['id']);
            $k['keluhan'] = $this->keluhanModel->getByKunjunganId($k['id']);
            $imunisasi = $this->imunisasiModel->getByKunjunganId($k['id']);
            if ($imunisasi) {
                $imunisasi['detail'] = $this->imunisasiDetailModel->getByImunisasiId($imunisasi['id']);
            }
            $k['imunisasi'] = $imunisasi;
            $k['kpsp'] = $this->kpspModel->getByKunjunganId($k['id']);
            $k['gizi'] = $this->giziModel->getByKunjunganId($k['id']);
            $k['swamedikasi'] = $this->swamedikasModel->getByKunjunganId($k['id']);
        }

        $data = [
            'title' => 'Riwayat Monitoring Balita',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'kunjungan' => $kunjungan
        ];

        return view('admin/monitoring/riwayat-balita', $data);
    }

    public function inputKunjungan($monitoringId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        if (!$monitoring) {
            return redirect()->to('/admin/monitoring/balita')->with('error', 'Data tidak ditemukan');
        }

        $identitas = $this->identitasModel->getByMonitoringId($monitoringId);
        $nextKunjungan = $this->kunjunganModel->getNextKunjunganKe($monitoringId);

        $data = [
            'title' => 'Input Kunjungan Balita',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'nextKunjungan' => $nextKunjungan
        ];

        return view('admin/monitoring/input-kunjungan-balita', $data);
    }

    public function storeKunjungan()
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $monitoringId = $this->request->getPost('monitoring_balita_id');

            // Insert kunjungan
            $kunjunganId = $this->kunjunganModel->insert([
                'monitoring_balita_id' => $monitoringId,
                'tanggal_kunjungan' => $this->request->getPost('tanggal_kunjungan'),
                'kunjungan_ke' => $this->request->getPost('kunjungan_ke')
            ]);

            // Insert antropometri
            $this->antropometriModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lingkar_kepala' => $this->request->getPost('lingkar_kepala')
            ]);

            // Insert keluhan
            $this->keluhanModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'batuk' => $this->request->getPost('batuk') ? 1 : 0,
                'pilek' => $this->request->getPost('pilek') ? 1 : 0,
                'demam' => $this->request->getPost('demam') ? 1 : 0,
                'diare' => $this->request->getPost('diare') ? 1 : 0,
                'sembelit' => $this->request->getPost('sembelit') ? 1 : 0,
                'gtm' => $this->request->getPost('gtm') ? 1 : 0,
                'lainnya' => $this->request->getPost('lainnya')
            ]);

            // Insert imunisasi
            $imunisasiId = $this->imunisasiModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'riwayat_alergi' => $this->request->getPost('riwayat_alergi'),
                'status_imunisasi' => $this->request->getPost('status_imunisasi')
            ]);

            // Insert detail imunisasi
            $vaksinData = $this->request->getPost('vaksin');
            if ($vaksinData) {
                foreach ($vaksinData as $jenisVaksin => $waktuArray) {
                    if (!empty($waktuArray)) {
                        $this->imunisasiDetailModel->insert([
                            'kunjungan_balita_imunisasi_id' => $imunisasiId,
                            'jenis_vaksin' => $jenisVaksin,
                            'waktu_pemberian' => json_encode($waktuArray)
                        ]);
                    }
                }
            }

            // Insert KPSP
            $this->kpspModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'hasil_skrining' => $this->request->getPost('hasil_skrining')
            ]);

            // Insert gizi
            $this->giziModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'vitamin_a' => $this->request->getPost('vitamin_a') ? 1 : 0,
                'obat_cacing' => $this->request->getPost('obat_cacing') ? 1 : 0,
                'pola_makan' => $this->request->getPost('pola_makan')
            ]);

            // Insert swamedikasi
            $this->swamedikasModel->insert([
                'kunjungan_balita_id' => $kunjunganId,
                'ke_nakes' => $this->request->getPost('ke_nakes') ? 1 : 0,
                'obat_modern' => $this->request->getPost('obat_modern') ? 1 : 0,
                'antibiotik' => $this->request->getPost('antibiotik') ? 1 : 0,
                'etnomedisin' => $this->request->getPost('etnomedisin') ? 1 : 0
            ]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal menyimpan data kunjungan')->withInput();
            }

            return redirect()->to('/admin/monitoring/balita/riwayat/' . $monitoringId)->with('success', 'Data kunjungan berhasil disimpan');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function editMaster($monitoringId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        if (!$monitoring) {
            return redirect()->to('/admin/monitoring/balita')->with('error', 'Data tidak ditemukan');
        }

        $identitas = $this->identitasModel->getByMonitoringId($monitoringId);
        $users = $this->userModel->where('role', 'pengguna')->findAll();

        $data = [
            'title' => 'Edit Data Balita',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'users' => $users
        ];

        return view('admin/monitoring/edit-balita', $data);
    }

    public function updateMaster($monitoringId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        if (!$monitoring) {
            return redirect()->to('/admin/monitoring/balita')->with('error', 'Data tidak ditemukan');
        }

        $identitas = $this->identitasModel->getByMonitoringId($monitoringId);

        $this->identitasModel->update($identitas['id'], [
            'nama_anak' => $this->request->getPost('nama_anak'),
            'tanggal_lahir' => $this->request->getPost('tanggal_lahir'),
            'nama_wali' => $this->request->getPost('nama_wali'),
            'no_hp_wali' => $this->request->getPost('no_hp_wali')
        ]);

        return redirect()->to('/admin/monitoring/balita/riwayat/' . $monitoringId)->with('success', 'Data identitas berhasil diupdate');
    }

    public function deleteMonitoring($monitoringId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        if (!$monitoring) {
            return redirect()->to('/admin/monitoring/balita')->with('error', 'Data tidak ditemukan');
        }

        $this->monitoringModel->delete($monitoringId);
        return redirect()->to('/admin/monitoring/balita')->with('success', 'Data monitoring berhasil dihapus');
    }

    public function editKunjungan($monitoringId, $kunjunganId)
    {
        $monitoring = $this->monitoringModel->find($monitoringId);
        if (!$monitoring) {
            return redirect()->to('/admin/monitoring/balita')->with('error', 'Data tidak ditemukan');
        }

        $identitas = $this->identitasModel->getByMonitoringId($monitoringId);
        $kunjungan = $this->kunjunganModel->find($kunjunganId);
        
        if (!$kunjungan || $kunjungan['monitoring_balita_id'] != $monitoringId) {
            return redirect()->to('/admin/monitoring/balita/riwayat/' . $monitoringId)->with('error', 'Data kunjungan tidak ditemukan');
        }

        $kunjunganData = [
            'kunjungan' => $kunjungan,
            'antropometri' => $this->antropometriModel->getByKunjunganId($kunjunganId),
            'keluhan' => $this->keluhanModel->getByKunjunganId($kunjunganId),
            'imunisasi' => $this->imunisasiModel->getByKunjunganId($kunjunganId),
            'kpsp' => $this->kpspModel->getByKunjunganId($kunjunganId),
            'gizi' => $this->giziModel->getByKunjunganId($kunjunganId),
            'swamedikasi' => $this->swamedikasModel->getByKunjunganId($kunjunganId)
        ];

        if ($kunjunganData['imunisasi']) {
            $kunjunganData['imunisasi']['detail'] = $this->imunisasiDetailModel->getByImunisasiId($kunjunganData['imunisasi']['id']);
        }

        $data = [
            'title' => 'Edit Kunjungan Balita',
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'kunjunganData' => $kunjunganData,
            'isEdit' => true
        ];

        return view('admin/monitoring/edit-kunjungan-balita', $data);
    }

    public function updateKunjungan($kunjunganId)
    {
        $kunjungan = $this->kunjunganModel->find($kunjunganId);
        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Data kunjungan tidak ditemukan');
        }

        $monitoringId = $kunjungan['monitoring_balita_id'];
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Update kunjungan
            $this->kunjunganModel->update($kunjunganId, [
                'tanggal_kunjungan' => $this->request->getPost('tanggal_kunjungan')
            ]);

            // Update antropometri
            $this->antropometriModel->where('kunjungan_balita_id', $kunjunganId)->set([
                'berat_badan' => $this->request->getPost('berat_badan'),
                'tinggi_badan' => $this->request->getPost('tinggi_badan'),
                'lingkar_kepala' => $this->request->getPost('lingkar_kepala')
            ])->update();

            // Update keluhan
            $this->keluhanModel->where('kunjungan_balita_id', $kunjunganId)->set([
                'batuk' => $this->request->getPost('batuk') ? 1 : 0,
                'pilek' => $this->request->getPost('pilek') ? 1 : 0,
                'demam' => $this->request->getPost('demam') ? 1 : 0,
                'diare' => $this->request->getPost('diare') ? 1 : 0,
                'sembelit' => $this->request->getPost('sembelit') ? 1 : 0,
                'gtm' => $this->request->getPost('gtm') ? 1 : 0,
                'lainnya' => $this->request->getPost('lainnya')
            ])->update();

            // Update imunisasi
            $imunisasi = $this->imunisasiModel->getByKunjunganId($kunjunganId);
            if ($imunisasi) {
                $this->imunisasiModel->update($imunisasi['id'], [
                    'riwayat_alergi' => $this->request->getPost('riwayat_alergi'),
                    'status_imunisasi' => $this->request->getPost('status_imunisasi')
                ]);

                // Delete old detail and insert new
                $this->imunisasiDetailModel->where('kunjungan_balita_imunisasi_id', $imunisasi['id'])->delete();
                $vaksinData = $this->request->getPost('vaksin');
                if ($vaksinData) {
                    foreach ($vaksinData as $jenisVaksin => $waktuArray) {
                        if (!empty($waktuArray)) {
                            $this->imunisasiDetailModel->insert([
                                'kunjungan_balita_imunisasi_id' => $imunisasi['id'],
                                'jenis_vaksin' => $jenisVaksin,
                                'waktu_pemberian' => json_encode($waktuArray)
                            ]);
                        }
                    }
                }
            }

            // Update KPSP
            $this->kpspModel->where('kunjungan_balita_id', $kunjunganId)->set([
                'hasil_skrining' => $this->request->getPost('hasil_skrining')
            ])->update();

            // Update gizi
            $this->giziModel->where('kunjungan_balita_id', $kunjunganId)->set([
                'vitamin_a' => $this->request->getPost('vitamin_a') ? 1 : 0,
                'obat_cacing' => $this->request->getPost('obat_cacing') ? 1 : 0,
                'pola_makan' => $this->request->getPost('pola_makan')
            ])->update();

            // Update swamedikasi
            $this->swamedikasModel->where('kunjungan_balita_id', $kunjunganId)->set([
                'ke_nakes' => $this->request->getPost('ke_nakes') ? 1 : 0,
                'obat_modern' => $this->request->getPost('obat_modern') ? 1 : 0,
                'antibiotik' => $this->request->getPost('antibiotik') ? 1 : 0,
                'etnomedisin' => $this->request->getPost('etnomedisin') ? 1 : 0
            ])->update();

            $db->transComplete();

            if ($db->transStatus() === false) {
                return redirect()->back()->with('error', 'Gagal mengupdate data kunjungan')->withInput();
            }

            return redirect()->to('/admin/monitoring/balita/riwayat/' . $monitoringId)->with('success', 'Data kunjungan berhasil diupdate');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function deleteKunjungan($kunjunganId)
    {
        $kunjungan = $this->kunjunganModel->find($kunjunganId);
        if (!$kunjungan) {
            return redirect()->back()->with('error', 'Data kunjungan tidak ditemukan');
        }

        $monitoringId = $kunjungan['monitoring_balita_id'];
        $this->kunjunganModel->delete($kunjunganId);

        return redirect()->to('/admin/monitoring/balita/riwayat/' . $monitoringId)->with('success', 'Data kunjungan berhasil dihapus');
    }
}
