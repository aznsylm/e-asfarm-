<?php

namespace App\Models;

use CodeIgniter\Model;

class PosterModel extends Model
{
    protected $table = 'posters';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['title', 'category', 'link_drive', 'thumbnail'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getCategories($posterId)
    {
        return $this->db->table('poster_categories')
            ->select('categories.*')
            ->join('categories', 'categories.id = poster_categories.category_id')
            ->where('poster_categories.poster_id', $posterId)
            ->get()->getResultArray();
    }

    public function syncCategories($posterId, $categoryIds)
    {
        $this->db->table('poster_categories')->where('poster_id', $posterId)->delete();
        if (!empty($categoryIds)) {
            $data = array_map(fn($catId) => ['poster_id' => $posterId, 'category_id' => $catId], $categoryIds);
            $this->db->table('poster_categories')->insertBatch($data);
        }
    }
}
