<?php

namespace App\Models\MonitoringBalita;

use CodeIgniter\Model;

class MonitoringBalitaModel extends Model
{
    protected $table = 'monitoring_balita';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'kategori'];
    protected $useTimestamps = true;

    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    public function getByUserIdAndCategory($userId, $kategori = 'balita')
    {
        return $this->where(['user_id' => $userId, 'kategori' => $kategori])->first();
    }

    public function getAllWithIdentitas($padukuhanId = null)
    {
        $this->select('monitoring_balita.*, monitoring_balita_identitas.nama_anak, monitoring_balita_identitas.tanggal_lahir, users.username, users.full_name, padukuhan.nama_padukuhan')
            ->join('monitoring_balita_identitas', 'monitoring_balita_identitas.monitoring_balita_id = monitoring_balita.id', 'left')
            ->join('users', 'users.id = monitoring_balita.user_id', 'left')
            ->join('padukuhan', 'padukuhan.id = users.padukuhan_id', 'left')
            ->where('monitoring_balita.kategori', 'balita');

        if ($padukuhanId) {
            $this->where('users.padukuhan_id', $padukuhanId);
        }

        return $this;
    }
}
