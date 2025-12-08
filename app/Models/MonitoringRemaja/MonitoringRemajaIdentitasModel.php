<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class MonitoringRemajaIdentitasModel extends Model
{
    protected $table = 'monitoring_remaja_identitas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['monitoring_id', 'nama_lengkap', 'nik', 'tanggal_lahir', 'jenis_kelamin', 'nama_wali', 'no_hp_wali'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
}
