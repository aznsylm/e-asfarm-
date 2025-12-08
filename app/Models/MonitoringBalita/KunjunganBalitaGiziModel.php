<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaGiziModel extends Model
{
    protected $table = 'kunjungan_balita_gizi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_balita_id', 'vitamin_a', 'obat_cacing', 'pola_makan'];
    protected $useTimestamps = true;

    public function getByKunjunganId($kunjunganId)
    {
        return $this->where('kunjungan_balita_id', $kunjunganId)->first();
    }
}
