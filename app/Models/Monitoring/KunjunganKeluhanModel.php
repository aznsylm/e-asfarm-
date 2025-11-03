<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class KunjunganKeluhanModel extends Model
{
    protected $table = 'kunjungan_keluhan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'keluhan', 'created_at'];
    protected $useTimestamps = false;
}
