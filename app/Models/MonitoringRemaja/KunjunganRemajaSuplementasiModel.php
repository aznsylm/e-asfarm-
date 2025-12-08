<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class KunjunganRemajaSuplementasiModel extends Model
{
    protected $table = 'kunjungan_remaja_suplementasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'dapat_ttd', 'minum_ttd', 'kebiasaan_sarapan'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
}
