<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class KunjunganRemajaGayaHidupModel extends Model
{
    protected $table = 'kunjungan_remaja_gaya_hidup';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'risiko_ptm'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
}
