<?php

namespace App\Models\MonitoringRemaja;

use CodeIgniter\Model;

class MonitoringRemajaModel extends Model
{
    protected $table = 'monitoring_remaja';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'admin_id', 'category', 'status'];
    protected $useTimestamps = true;

    public function getByUserIdAndCategory($userId, $category = 'remaja')
    {
        return $this->where('user_id', $userId)
                    ->where('category', $category)
                    ->where('status', 'active')
                    ->first();
    }

    public function getAllWithUserInfo($padukuhanId = null)
    {
        $this->select('monitoring_remaja.*, monitoring_remaja_identitas.nama_lengkap, monitoring_remaja_identitas.tanggal_lahir, monitoring_remaja_identitas.jenis_kelamin, users.username, padukuhan.nama_padukuhan')
            ->join('users', 'users.id = monitoring_remaja.user_id')
            ->join('monitoring_remaja_identitas', 'monitoring_remaja_identitas.monitoring_id = monitoring_remaja.id', 'left')
            ->join('padukuhan', 'padukuhan.id = users.padukuhan_id', 'left')
            ->where('monitoring_remaja.status', 'active')
            ->where('monitoring_remaja.category', 'remaja');
        
        if ($padukuhanId) {
            $this->where('users.padukuhan_id', $padukuhanId);
        }
        
        return $this->orderBy('monitoring_remaja.created_at', 'DESC');
    }

    public function getAllWithIdentitas($padukuhanId = null)
    {
        $this->select('monitoring_remaja.*, monitoring_remaja_identitas.nama_lengkap as nama, TIMESTAMPDIFF(YEAR, monitoring_remaja_identitas.tanggal_lahir, CURDATE()) as usia, users.username')
            ->join('users', 'users.id = monitoring_remaja.user_id')
            ->join('monitoring_remaja_identitas', 'monitoring_remaja_identitas.monitoring_id = monitoring_remaja.id', 'left')
            ->where('monitoring_remaja.status', 'active')
            ->where('monitoring_remaja.category', 'remaja');
        
        if ($padukuhanId) {
            $this->where('users.padukuhan_id', $padukuhanId);
        }
        
        return $this;
    }
}
