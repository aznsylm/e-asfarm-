<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class MonitoringBalitaIdentitasModel extends Model
{
    protected $table = 'monitoring_balita_identitas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['monitoring_balita_id', 'nama_anak', 'tanggal_lahir', 'nama_wali', 'no_hp_wali'];
    protected $useTimestamps = true;

    public function getByMonitoringId($monitoringId)
    {
        return $this->where('monitoring_balita_id', $monitoringId)->first();
    }
}
