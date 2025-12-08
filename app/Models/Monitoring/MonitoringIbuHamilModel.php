<?php

namespace App\Models\Monitoring;

use CodeIgniter\Model;

class MonitoringIbuHamilModel extends Model
{
    protected $table = 'monitoring_ibu_hamil';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['user_id', 'admin_id', 'category', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getByUserId($userId)
    {
        return $this->where('user_id', $userId)->where('status', 'active')->first();
    }

    public function getAllWithUserInfo($padukuhanId = null)
    {
        $this->select('monitoring_ibu_hamil.*, monitoring_identitas.nama_ibu as full_name, users.username, users.padukuhan_id, padukuhan.nama_padukuhan')
            ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
            ->join('monitoring_identitas', 'monitoring_identitas.monitoring_id = monitoring_ibu_hamil.id', 'left')
            ->join('padukuhan', 'padukuhan.id = users.padukuhan_id', 'left')
            ->where('monitoring_ibu_hamil.status', 'active');
        
        if ($padukuhanId) {
            $this->where('users.padukuhan_id', $padukuhanId);
        }
        
        return $this->orderBy('monitoring_ibu_hamil.created_at', 'DESC');
    }

    public function getStatsByPadukuhan($padukuhanId = null)
    {
        $builder = $this->select('COUNT(*) as total')
                        ->join('users', 'users.id = monitoring_ibu_hamil.user_id')
                        ->where('monitoring_ibu_hamil.status', 'active');
        
        if ($padukuhanId) {
            $builder->where('users.padukuhan_id', $padukuhanId);
        }
        
        return $builder->get()->getRowArray();
    }
}
