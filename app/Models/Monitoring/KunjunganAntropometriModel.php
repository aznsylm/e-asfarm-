<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class KunjunganAntropometriModel extends Model
{
    protected $table = 'kunjungan_antropometri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'tekanan_darah', 'berat_badan', 'tinggi_badan', 'lila', 'created_at'];
    protected $useTimestamps = false;
}
