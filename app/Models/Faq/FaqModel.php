<?php

namespace App\Models\Faq;

use CodeIgniter\Model;

class FaqModel extends Model
{
    protected $table            = 'faqs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'category',
        'pertanyaan',
        'jawaban'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getFaqsbyCategory($categoryId)
    {
        return $this->where('category_id', $categoryId)->findAll();
    }

    public function getCategories($faqId)
    {
        return $this->db->table('faq_categories')
            ->select('categories.*')
            ->join('categories', 'categories.id = faq_categories.category_id')
            ->where('faq_categories.faq_id', $faqId)
            ->get()->getResultArray();
    }

    public function syncCategories($faqId, $categoryIds)
    {
        $this->db->table('faq_categories')->where('faq_id', $faqId)->delete();
        if (!empty($categoryIds)) {
            $data = array_map(fn($catId) => ['faq_id' => $faqId, 'category_id' => $catId], $categoryIds);
            $this->db->table('faq_categories')->insertBatch($data);
        }
    }
}
