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
use App\Models\Monitoring\KunjunganAntropometriModel;
use App\Models\Monitoring\KunjunganKeluhanModel;
use App\Models\Monitoring\KunjunganSuplementasiModel;
use App\Models\Monitoring\KunjunganEtnomedisinModel;

class UserDetailController extends BaseController
{
    public function index($userId)
    {
        $userModel = new UserModel();
        $padukuhanModel = new PadukuhanModel();
        $monitoringModel = new MonitoringIbuHamilModel();
        $identitasModel = new MonitoringIdentitasModel();
        $riwayatModel = new MonitoringRiwayatPenyakitModel();
        $skriningModel = new MonitoringSkriningModel();
        $kunjunganModel = new KunjunganModel();
        
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
        
        // Get monitoring data
        $monitoring = $monitoringModel->getByUserId($userId);
        $identitas = null;
        $riwayat = null;
        $skrining = null;
        $kunjunganList = [];
        
        if ($monitoring) {
            $identitas = $identitasModel->where('monitoring_id', $monitoring['id'])->first();
            $riwayat = $riwayatModel->where('monitoring_id', $monitoring['id'])->first();
            $skrining = $skriningModel->where('monitoring_id', $monitoring['id'])->first();
            
            // Get all kunjungan with details
            $kunjunganList = $kunjunganModel->getWithDetails($monitoring['id']);
        }
        
        $data = [
            'title' => 'Detail Pengguna',
            'user' => $user,
            'padukuhan' => $padukuhan,
            'monitoring' => $monitoring,
            'identitas' => $identitas,
            'riwayat' => $riwayat,
            'skrining' => $skrining,
            'kunjunganList' => $kunjunganList
        ];
        
        return view('admin/user-detail', $data);
    }
}
