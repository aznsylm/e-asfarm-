<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class MonitoringIdentitasModel extends Model
{
    protected $table = 'monitoring_identitas';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['monitoring_id', 'nama_ibu', 'nama_suami', 'usia_ibu', 'usia_suami', 'alamat', 'nomor_telepon', 'usia_kehamilan', 'rencana_tanggal_persalinan', 'created_at'];
    protected $useTimestamps = false;
}
