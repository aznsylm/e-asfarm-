<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PadukuhanModel;
use App\Models\Monitoring\MonitoringIbuHamilModel;
use App\Models\Monitoring\MonitoringIdentitasModel;
use App\Models\Monitoring\MonitoringRiwayatPenyakitModel;
use App\Models\Monitoring\MonitoringSkriningModel;
use App\Models\Monitoring\KunjunganModel;
use App\Models\MonitoringBalita\MonitoringBalitaModel;
use App\Models\MonitoringBalita\MonitoringBalitaIdentitasModel;
use App\Models\MonitoringBalita\KunjunganBalitaModel;
use App\Models\MonitoringBalita\KunjunganBalitaKeluhanModel;
use App\Models\MonitoringBalita\KunjunganBalitaGiziModel;
use App\Models\MonitoringBalita\KunjunganBalitaKpspModel;
use App\Models\MonitoringBalita\KunjunganBalitaAntropometriModel;
use App\Models\MonitoringBalita\KunjunganBalitaImunisasiModel;
use App\Models\MonitoringBalita\KunjunganBalitaSwamedikasModel;
use App\Models\MonitoringRemaja\MonitoringRemajaModel;
use App\Models\MonitoringRemaja\MonitoringRemajaIdentitasModel;
use App\Models\MonitoringRemaja\KunjunganRemajaModel;
use App\Models\MonitoringRemaja\KunjunganRemajaAnemiaModel;
use App\Models\MonitoringRemaja\KunjunganRemajaHaidModel;
use App\Models\MonitoringRemaja\KunjunganRemajaSuplementasiModel;
use App\Models\MonitoringRemaja\KunjunganRemajaAntropometriModel;
use App\Models\MonitoringRemaja\KunjunganRemajaGayaHidupModel;
use App\Models\MonitoringRemaja\KunjunganRemajaSwamedikasModel;

class UserDetailController extends BaseController
{
    public function index($userId)
    {
        $userModel = new UserModel();
        $padukuhanModel = new PadukuhanModel();
        
        // Get user data
        $user = $userModel->find($userId);
        if (!$user) {
            return redirect()->to('/admin/dashboard')->with('error', 'User tidak ditemukan');
        }
        
        // Get padukuhan
        $padukuhan = null;
        if ($user['padukuhan_id']) {
            $padukuhan = $padukuhanModel->find($user['padukuhan_id']);
        }
        
        // === IBU HAMIL ===
        $monitoringIbuHamil = (new MonitoringIbuHamilModel())->getByUserId($userId);
        $identitasIbuHamil = null;
        $riwayatIbuHamil = null;
        $skriningIbuHamil = null;
        $kunjunganIbuHamil = [];
        
        if ($monitoringIbuHamil) {
            $identitasIbuHamil = (new MonitoringIdentitasModel())->where('monitoring_id', $monitoringIbuHamil['id'])->first();
            $riwayatIbuHamil = (new MonitoringRiwayatPenyakitModel())->where('monitoring_id', $monitoringIbuHamil['id'])->first();
            $skriningIbuHamil = (new MonitoringSkriningModel())->where('monitoring_id', $monitoringIbuHamil['id'])->first();
            $kunjunganIbuHamil = (new KunjunganModel())->getWithDetails($monitoringIbuHamil['id']);
        }
        
        // === BALITA & ANAK ===
        $monitoringBalita = (new MonitoringBalitaModel())->where('user_id', $userId)->first();
        $identitasBalita = null;
        $kunjunganBalita = [];
        
        if ($monitoringBalita) {
            $identitasBalita = (new MonitoringBalitaIdentitasModel())->where('monitoring_balita_id', $monitoringBalita['id'])->first();
            $kunjunganList = (new KunjunganBalitaModel())->where('monitoring_balita_id', $monitoringBalita['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            $keluhanModel = new KunjunganBalitaKeluhanModel();
            $giziModel = new KunjunganBalitaGiziModel();
            $kpspModel = new KunjunganBalitaKpspModel();
            $antropometriModel = new KunjunganBalitaAntropometriModel();
            $imunisasiModel = new KunjunganBalitaImunisasiModel();
            $swamedikasModel = new KunjunganBalitaSwamedikasModel();
            
            foreach ($kunjunganList as &$kunjungan) {
                $kunjungan['keluhan'] = $keluhanModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['gizi'] = $giziModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['kpsp'] = $kpspModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['antropometri'] = $antropometriModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['imunisasi'] = $imunisasiModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
                $kunjungan['swamedikasi'] = $swamedikasModel->where('kunjungan_balita_id', $kunjungan['id'])->first();
            }
            $kunjunganBalita = $kunjunganList;
        }
        
        // === REMAJA ===
        $monitoringRemaja = (new MonitoringRemajaModel())->where('user_id', $userId)->first();
        $identitasRemaja = null;
        $kunjunganRemaja = [];
        
        if ($monitoringRemaja) {
            $identitasRemaja = (new MonitoringRemajaIdentitasModel())->where('monitoring_id', $monitoringRemaja['id'])->first();
            $kunjunganList = (new KunjunganRemajaModel())->where('monitoring_id', $monitoringRemaja['id'])->orderBy('kunjungan_ke', 'ASC')->findAll();
            
            $anemiaModel = new KunjunganRemajaAnemiaModel();
            $haidModel = new KunjunganRemajaHaidModel();
            $suplementasiModel = new KunjunganRemajaSuplementasiModel();
            $antropometriModel = new KunjunganRemajaAntropometriModel();
            $gayaHidupModel = new KunjunganRemajaGayaHidupModel();
            $swamedikasModel = new KunjunganRemajaSwamedikasModel();
            
            foreach ($kunjunganList as &$kunjungan) {
                $kunjungan['anemia'] = $anemiaModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['haid'] = $haidModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['suplementasi'] = $suplementasiModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['antropometri'] = $antropometriModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['gaya_hidup'] = $gayaHidupModel->where('kunjungan_id', $kunjungan['id'])->first();
                $kunjungan['swamedikasi'] = $swamedikasModel->where('kunjungan_id', $kunjungan['id'])->first();
            }
            $kunjunganRemaja = $kunjunganList;
        }
        
        $data = [
            'title' => 'Detail Pengguna',
            'user' => $user,
            'padukuhan' => $padukuhan,
            // Ibu Hamil
            'monitoring' => $monitoringIbuHamil,
            'identitas' => $identitasIbuHamil,
            'riwayat' => $riwayatIbuHamil,
            'skrining' => $skriningIbuHamil,
            'kunjunganList' => $kunjunganIbuHamil,
            // Balita
            'monitoringBalita' => $monitoringBalita,
            'identitasBalita' => $identitasBalita,
            'kunjunganBalita' => $kunjunganBalita,
            // Remaja
            'monitoringRemaja' => $monitoringRemaja,
            'identitasRemaja' => $identitasRemaja,
            'kunjunganRemaja' => $kunjunganRemaja,
        ];
        
        return view('admin/user-detail', $data);
    }
}
