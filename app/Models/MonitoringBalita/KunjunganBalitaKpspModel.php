<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaKpspModel extends Model
{
    protected $table = 'kunjungan_balita_kpsp';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_balita_id', 'hasil_skrining'];
    protected $useTimestamps = true;

    public function getByKunjunganId($kunjunganId)
    {
        return $this->where('kunjungan_balita_id', $kunjunganId)->first();
    }
}
