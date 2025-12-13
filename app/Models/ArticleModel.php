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
    protected $allowedFields = ['title', 'slug', 'seo_title', 'meta_description', 'content', 'category', 'image', 'author_id', 'author_name', 'padukuhan_id', 'status', 'views', 'approved_by', 'approved_at'];
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

    public function getArticleWithPadukuhan($articleId)
    {
        return $this->select('articles.*, users.padukuhan_id as author_padukuhan_id')
                    ->join('users', 'users.id = articles.author_id', 'left')
                    ->where('articles.id', $articleId)
                    ->first();
    }

    public function canAdminManage($articleId, $adminPadukuhanId, $adminRole)
    {
        if ($adminRole === 'superadmin') {
            return true;
        }

        $article = $this->getArticleWithPadukuhan($articleId);
        if (!$article) {
            return false;
        }

        // Jika artikel dibuat oleh admin/superadmin (padukuhan_id NULL), semua admin bisa manage
        if ($article['padukuhan_id'] === null) {
            return true;
        }

        // Jika artikel dari pengguna, cek padukuhan
        return $article['author_padukuhan_id'] == $adminPadukuhanId;
    }

    public function getAllWithPadukuhan()
    {
        return $this->select('articles.*, users.padukuhan_id as author_padukuhan_id, padukuhan.nama_padukuhan')
                    ->join('users', 'users.id = articles.author_id', 'left')
                    ->join('padukuhan', 'padukuhan.id = users.padukuhan_id', 'left')
                    ->orderBy('articles.created_at', 'DESC')
                    ->findAll();
    }

    public function getCategories($articleId)
    {
        return $this->db->table('article_categories')
            ->select('categories.*')
            ->join('categories', 'categories.id = article_categories.category_id')
            ->where('article_categories.article_id', $articleId)
            ->get()->getResultArray();
    }

    public function syncCategories($articleId, $categoryIds)
    {
        $this->db->table('article_categories')->where('article_id', $articleId)->delete();
        if (!empty($categoryIds)) {
            $data = array_map(fn($catId) => ['article_id' => $articleId, 'category_id' => $catId], $categoryIds);
            $this->db->table('article_categories')->insertBatch($data);
        }
    }
}
