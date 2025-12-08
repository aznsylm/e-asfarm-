<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class KunjunganRemajaAntropometriModel extends Model
{
    protected $table = 'kunjungan_remaja_antropometri';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'berat_badan', 'tinggi_badan', 'lingkar_perut', 'tekanan_darah'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
}
