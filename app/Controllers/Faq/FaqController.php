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
        
        $displayNames = [
            'kehamilan' => 'Kehamilan',
            'menyusui' => 'Menyusui',
            'persalinan' => 'Persalinan',
            'vaksin' => 'Vaksin',
            'nutrisi' => 'Nutrisi',
            'etnomedisin' => 'Etnomedisin'
        ];
        
        $kategori = ['name' => $name, 'display_name' => $displayNames[$name] ?? ucfirst($name)];
        $tanyaJawab = $faqModel->where('category', $name)->findAll();

        return view('pages/tanya-jawab', compact('kategori', 'tanyaJawab'));
    }
}
