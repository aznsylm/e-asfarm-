<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class KunjunganRemajaModel extends Model
{
    protected $table = 'kunjungan_remaja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['monitoring_id', 'kunjungan_ke', 'tanggal_kunjungan', 'catatan'];
    protected $useTimestamps = true;

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
}
