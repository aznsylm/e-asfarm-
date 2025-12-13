<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'type', 'slug', 'is_active'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'type' => 'required|in_list[artikel,tanya_jawab,poster,padukuhan]',
        'slug' => 'required|is_unique[categories.slug,id,{id}]',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function generateSlug($name, $id = null)
    {
        $slug = url_title($name, '-', true);
        $count = 0;
        $originalSlug = $slug;

        while (true) {
            $builder = $this->builder();
            $builder->where('slug', $slug);
            if ($id) {
                $builder->where('id !=', $id);
            }
            $exists = $builder->countAllResults() > 0;

            if (!$exists) {
                break;
            }

            $count++;
            $slug = $originalSlug . '-' . $count;
        }

        return $slug;
    }

    public function getByType($type)
    {
        return $this->where('type', $type)->where('is_active', 1)->findAll();
    }
}
