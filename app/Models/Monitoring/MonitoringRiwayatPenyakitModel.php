<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class MonitoringRiwayatPenyakitModel extends Model
{
    protected $table = 'monitoring_riwayat_penyakit';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['monitoring_id', 'riwayat_penyakit', 'tidak_ada_riwayat', 'created_at'];
    protected $useTimestamps = false;
}
