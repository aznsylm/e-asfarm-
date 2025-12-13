<?php

namespace App\Controllers\Faq;

use App\Controllers\BaseController;
use App\Models\Faq\FaqModel;
use CodeIgniter\HTTP\ResponseInterface;

class FaqController extends BaseController
{
    public function index($slug)
    {
        $categoryModel = new \App\Models\CategoryModel();
        $category = $categoryModel->where('slug', $slug)->first();
        
        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $faqModel = new FaqModel();
        $tanyaJawab = $faqModel
            ->distinct()
            ->select('faqs.*')
            ->join('faq_categories', 'faq_categories.faq_id = faqs.id')
            ->where('faq_categories.category_id', $category['id'])
            ->groupBy('faqs.id')
            ->orderBy('faqs.created_at', 'DESC')
            ->findAll();
        
        // Load categories untuk setiap FAQ
        foreach($tanyaJawab as &$faq) {
            $faq['categories'] = $faqModel->getCategories($faq['id']);
        }
        
        // Get all tanya_jawab categories for tabs
        $tanyaJawabCategories = $categoryModel->where(['type' => 'tanya_jawab', 'is_active' => 1])->findAll();
        
        $kategori = ['name' => $slug, 'display_name' => $category['name']];

        return view('pages/tanya-jawab', compact('kategori', 'tanyaJawab', 'tanyaJawabCategories'));
    }
}
