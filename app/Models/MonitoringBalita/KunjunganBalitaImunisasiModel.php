<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaImunisasiModel extends Model
{
    protected $table = 'kunjungan_balita_imunisasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_balita_id', 'riwayat_alergi', 'status_imunisasi'];
    protected $useTimestamps = true;

    public function getByKunjunganId($kunjunganId)
    {
        return $this->where('kunjungan_balita_id', $kunjunganId)->first();
    }
}
