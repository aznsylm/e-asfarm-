<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['title', 'slug', 'seo_title', 'meta_description', 'content', 'category', 'image', 'author_id', 'author_name', 'status', 'approved_by', 'approved_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getByStatus($status)
    {
        return $this->where('status', $status)->orderBy('created_at', 'DESC')->findAll();
    }

    public function approveArticle($id, $adminId)
    {
        return $this->update($id, [
            'status' => 'approved',
            'approved_by' => $adminId,
            'approved_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function rejectArticle($id)
    {
        return $this->update($id, ['status' => 'rejected']);
    }

    public function generateSlug($title, $id = null)
    {
        $slug = url_title($title, '-', true);
        $originalSlug = $slug;
        $counter = 1;

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
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }
}
