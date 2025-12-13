<?php

namespace App\Controllers\Search;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\Faq\FaqModel;
use App\Models\PosterModel;
use App\Models\ModulModel;

class SearchController extends BaseController
{
    public function index()
    {
        $keyword = $this->request->getGet('q');
        $results = [];
        
        if ($keyword) {
            $results = $this->search($keyword);
        }
        
        return view('search/results', [
            'keyword' => $keyword,
            'results' => $results
        ]);
    }
    
    private function search($keyword)
    {
        $results = [];
        $keyword = strtolower($keyword);
        
        // Cari halaman/menu berdasarkan keyword
        $pages = [
            'tanya jawab' => [
                'type' => 'Halaman',
                'title' => 'Tanya Jawab - FAQ Kesehatan Ibu dan Anak',
                'excerpt' => 'Temukan jawaban untuk pertanyaan seputar kehamilan, persalinan, menyusui, vaksin, dan nutrisi.',
                'url' => base_url('tanya-jawab/kehamilan'),
                'category' => 'Menu'
            ],
            'unduhan' => [
                'type' => 'Halaman',
                'title' => 'Unduhan - Modul dan Flayer Kesehatan',
                'excerpt' => 'Download modul kesehatan dan flayer edukasi gratis untuk ibu dan anak.',
                'url' => base_url('unduhan/modul'),
                'category' => 'Menu'
            ],
            'artikel' => [
                'type' => 'Halaman',
                'title' => 'Artikel Kesehatan - Farmasi, Kebidanan, Gizi',
                'excerpt' => 'Baca artikel kesehatan terpercaya dari para ahli farmasi, kebidanan, dan gizi.',
                'url' => base_url('artikel/farmasi'),
                'category' => 'Menu'
            ]
        ];
        
        // Cek apakah keyword cocok dengan nama halaman
        foreach ($pages as $pageKey => $pageData) {
            if (strpos($pageKey, $keyword) !== false || strpos($keyword, $pageKey) !== false) {
                $results[] = $pageData;
            }
        }
        
        // Cari artikel
        $articleModel = new ArticleModel();
        $articles = $articleModel->where('status', 'approved')
                             ->groupStart()
                             ->like('title', $keyword)
                             ->orLike('content', $keyword)
                             ->groupEnd()
                             ->findAll();
        
        foreach ($articles as $article) {
            $slug = $article['slug'] ?: $article['id'];
            $results[] = [
                'type' => 'Artikel',
                'title' => $article['title'],
                'excerpt' => substr(strip_tags($article['content']), 0, 150) . '...',
                'url' => base_url('artikel/baca/' . $slug),
                'category' => ucfirst($article['category'])
            ];
        }
        
        // Cari FAQ/Tanya Jawab
        $faqModel = new FaqModel();
        $faqs = $faqModel->groupStart()
                         ->like('pertanyaan', $keyword)
                         ->orLike('jawaban', $keyword)
                         ->groupEnd()
                         ->findAll();
        
        foreach ($faqs as $faq) {
            $results[] = [
                'type' => 'Tanya Jawab',
                'title' => $faq['pertanyaan'],
                'excerpt' => substr(strip_tags($faq['jawaban']), 0, 150) . '...',
                'url' => base_url('tanya-jawab/kehamilan'),
                'category' => 'FAQ'
            ];
        }
        
        // Cari Poster
        $posterModel = new PosterModel();
        $posters = $posterModel->like('title', $keyword)
                           ->findAll();
        
        foreach ($posters as $poster) {
            $results[] = [
                'type' => 'Poster',
                'title' => $poster['title'],
                'excerpt' => 'Poster kesehatan: ' . $poster['title'],
                'url' => base_url('poster'),
                'category' => ucfirst($poster['category'])
            ];
        }
        
        // Cari Modul
        $modulModel = new ModulModel();
        $moduls = $modulModel->like('title', $keyword)
                           ->findAll();
        
        foreach ($moduls as $modul) {
            $results[] = [
                'type' => 'Modul',
                'title' => $modul['title'],
                'excerpt' => 'Modul edukasi: ' . $modul['title'],
                'url' => base_url('modul'),
                'category' => ucfirst($modul['category'])
            ];
        }
        
        return $results;
    }
}