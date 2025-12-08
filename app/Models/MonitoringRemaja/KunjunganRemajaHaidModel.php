<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class KunjunganRemajaHaidModel extends Model
{
    protected $table = 'kunjungan_remaja_haid';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'sudah_menstruasi', 'keteraturan_haid', 'nyeri_haid'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
}
