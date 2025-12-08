<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaSwamedikasModel extends Model
{
    protected $table = 'kunjungan_balita_swamedikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_balita_id', 'ke_nakes', 'obat_modern', 'antibiotik', 'etnomedisin'];
    protected $useTimestamps = true;

    public function getByKunjunganId($kunjunganId)
    {
        return $this->where('kunjungan_balita_id', $kunjunganId)->first();
    }
}
