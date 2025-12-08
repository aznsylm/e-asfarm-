<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaAntropometriModel extends Model
{
    protected $table = 'kunjungan_balita_antropometri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_balita_id', 'berat_badan', 'tinggi_badan', 'lingkar_kepala'];
    protected $useTimestamps = true;

    public function getByKunjunganId($kunjunganId)
    {
        return $this->where('kunjungan_balita_id', $kunjunganId)->first();
    }
}
