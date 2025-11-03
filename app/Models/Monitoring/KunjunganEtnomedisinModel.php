<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class KunjunganEtnomedisinModel extends Model
{
    protected $table = 'kunjungan_etnomedisin';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'menggunakan_obat_tradisional', 'jenis_obat', 'tujuan_penggunaan', 'edukasi_diberikan', 'created_at'];
    protected $useTimestamps = false;
}
