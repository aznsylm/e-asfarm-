<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class KunjunganBalitaImunisasiDetailModel extends Model
{
    protected $table = 'kunjungan_balita_imunisasi_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_balita_imunisasi_id', 'jenis_vaksin', 'waktu_pemberian'];
    protected $useTimestamps = true;

    public function getByImunisasiId($imunisasiId)
    {
        return $this->where('kunjungan_balita_imunisasi_id', $imunisasiId)->findAll();
    }

    public function deleteByImunisasiId($imunisasiId)
    {
        return $this->where('kunjungan_balita_imunisasi_id', $imunisasiId)->delete();
    }
}
