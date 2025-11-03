<?php

namespace App\Controllers\Faq;

use App\Controllers\BaseController;
use App\Models\Faq\FaqModel;
use CodeIgniter\HTTP\ResponseInterface;

class FaqController extends BaseController
{
    public function index($name)
    {
        $faqModel = new FaqModel();
        
        $categoryMap = ['kehamilan' => 'Bidan', 'gizi' => 'Gizi', 'farmasi' => 'Farmasi', 'etnomedisin' => 'Etnomedisin'];
        $categoryName = $categoryMap[$name] ?? ucfirst($name);
        
        $kategori = ['name' => $name, 'display_name' => $categoryName];
        $tanyaJawab = $faqModel->where('category', $categoryName)->findAll();

        return view('pages/tanya-jawab', compact('kategori', 'tanyaJawab'));
    }
}
