<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class MonitoringSkriningModel extends Model
{
    protected $table = 'monitoring_skrining';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['monitoring_id', 'tempat_persalinan', 'penolong_persalinan', 'created_at'];
    protected $useTimestamps = false;
}
