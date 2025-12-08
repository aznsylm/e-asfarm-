<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class KunjunganRemajaSwamedikasModel extends Model
{
    protected $table = 'kunjungan_remaja_swamedikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'perilaku_swamedikasi'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
}
