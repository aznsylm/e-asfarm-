<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class KunjunganSuplementasiModel extends Model
{
    protected $table = 'kunjungan_suplementasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kunjungan_id', 'nama_suplemen', 'status_pemberian', 'jumlah_tablet', 'frekuensi', 'efek_samping', 'created_at'];
    protected $useTimestamps = false;
}
