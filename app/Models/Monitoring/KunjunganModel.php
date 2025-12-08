<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class KunjunganModel extends Model
{
    protected $table = 'kunjungan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['monitoring_id', 'kunjungan_ke', 'tanggal_kunjungan', 'catatan', 'created_at'];
    protected $useTimestamps = false;

    public function getByMonitoringId($monitoringId)
    {
        return $this->where('monitoring_id', $monitoringId)
                    ->orderBy('kunjungan_ke', 'ASC')
                    ->findAll();
    }

    public function getNextKunjunganKe($monitoringId)
    {
        $lastKunjungan = $this->where('monitoring_id', $monitoringId)
                              ->orderBy('kunjungan_ke', 'DESC')
                              ->first();
        
        return $lastKunjungan ? $lastKunjungan['kunjungan_ke'] + 1 : 1;
    }

    public function getWithDetails($monitoringId)
    {
        $kunjunganList = $this->where('monitoring_id', $monitoringId)
                              ->orderBy('kunjungan_ke', 'ASC')
                              ->findAll();
        
        if (empty($kunjunganList)) {
            return [];
        }

        $antropometriModel = new KunjunganAntropometriModel();
        $keluhanModel = new KunjunganKeluhanModel();
        $suplementasiModel = new KunjunganSuplementasiModel();
        $etnomedisinModel = new KunjunganEtnomedisinModel();

        foreach ($kunjunganList as &$kunjungan) {
            $kunjungan['antropometri'] = $antropometriModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['keluhan'] = $keluhanModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['suplementasi'] = $suplementasiModel->where('kunjungan_id', $kunjungan['id'])->first();
            $kunjungan['etnomedisin'] = $etnomedisinModel->where('kunjungan_id', $kunjungan['id'])->first();
        }

        return $kunjunganList;
    }
}
