<?php

namespace App\Controllers\Poster;

use App\Controllers\BaseController;
use App\Models\PosterModel;

class Poster extends BaseController
{
    protected $posterModel;

    public function __construct()
    {
        $this->posterModel = new PosterModel();
    }

    public function index()
    {
        $categoryModel = new \App\Models\CategoryModel();
        $categories = $categoryModel->where(['type' => 'poster', 'is_active' => 1])->findAll();
        
        $postersByCategory = [];
        foreach($categories as $cat) {
            $posters = $this->posterModel
                ->distinct()
                ->select('posters.*')
                ->join('poster_categories', 'poster_categories.poster_id = posters.id')
                ->where('poster_categories.category_id', $cat['id'])
                ->groupBy('posters.id')
                ->orderBy('posters.created_at', 'DESC')
                ->findAll();
            
            foreach($posters as &$poster) {
                $poster['categories'] = $this->posterModel->getCategories($poster['id']);
            }
            
            $postersByCategory[$cat['name']] = $posters;
        }
        
        return view('pages/poster', ['postersByCategory' => $postersByCategory, 'categories' => $categories]);
    }
}
