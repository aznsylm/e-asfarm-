<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaModel extends Model
{
    protected $table = 'kunjungan_balita';
    protected $primaryKey = 'id';
    protected $allowedFields = ['monitoring_balita_id', 'tanggal_kunjungan', 'kunjungan_ke'];
    protected $useTimestamps = true;

    public function getByMonitoringId($monitoringId)
    {
        return $this->where('monitoring_balita_id', $monitoringId)
            ->orderBy('kunjungan_ke', 'ASC')
            ->findAll();
    }

    public function getNextKunjunganKe($monitoringId)
    {
        $lastKunjungan = $this->where('monitoring_balita_id', $monitoringId)
            ->orderBy('kunjungan_ke', 'DESC')
            ->first();

        return $lastKunjungan ? $lastKunjungan['kunjungan_ke'] + 1 : 1;
    }
}
