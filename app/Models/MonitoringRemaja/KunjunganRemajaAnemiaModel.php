<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class KunjunganRemajaAnemiaModel extends Model
{
    protected $table = 'kunjungan_remaja_anemia';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'gejala_anemia'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
}
