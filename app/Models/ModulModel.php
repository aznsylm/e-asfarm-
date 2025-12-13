<?php

namespace App\Models;

use CodeIgniter\Model;

class ModulModel extends Model
{
    protected $table = 'moduls';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['title', 'category', 'link_drive', 'thumbnail'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCategories($modulId)
    {
        return $this->db->table('modul_categories')
            ->select('categories.*')
            ->join('categories', 'categories.id = modul_categories.category_id')
            ->where('modul_categories.modul_id', $modulId)
            ->get()->getResultArray();
    }

    public function syncCategories($modulId, $categoryIds)
    {
        $this->db->table('modul_categories')->where('modul_id', $modulId)->delete();
        if (!empty($categoryIds)) {
            $data = array_map(fn($catId) => ['modul_id' => $modulId, 'category_id' => $catId], $categoryIds);
            $this->db->table('modul_categories')->insertBatch($data);
        }
    }
}
