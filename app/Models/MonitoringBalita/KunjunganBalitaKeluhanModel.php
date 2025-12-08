<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaKeluhanModel extends Model
{
    protected $table = 'kunjungan_balita_keluhan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_balita_id', 'batuk', 'pilek', 'demam', 'diare', 'sembelit', 'gtm', 'lainnya'];
    protected $useTimestamps = true;

    public function getByKunjunganId($kunjunganId)
    {
        return $this->where('kunjungan_balita_id', $kunjunganId)->first();
    }
}
