<?php

namespace App\Models;

use CodeIgniter\Model;

class PadukuhanModel extends Model
{
    protected $table = 'padukuhan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_padukuhan', 'kode_padukuhan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getAllPadukuhan()
    {
        return $this->findAll();
    }
}
