<?php

namespace App\Models;

use CodeIgniter\Model;

class DownloadModel extends Model
{
    protected $table = 'downloads';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['title', 'category', 'link_drive', 'thumbnail'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
