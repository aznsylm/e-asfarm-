<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\PosterModel;
use App\Models\CategoryModel;
use App\Models\RunningTextModel;

class Home extends BaseController
{
    /**
     * Menampilkan halaman utama dengan daftar posting terbaru dan sebagainya.
     *
     * @return string
     */
    public function beranda(): string
    {
        $articles = new ArticleModel();
        $posterModel = new PosterModel();
        $title = 'Home';

        $data = $articles->where('status', 'approved')->orderBy('id', 'DESC')->limit(6)->findAll();
        $data = array_map(fn($item) => (object)$item, $data ?: []);

        $data1 = $articles->where('status', 'approved')->orderBy('id', 'DESC')->limit(1)->findAll();
        $data1 = array_map(fn($item) => (object)$item, $data1);

        $data3 = $articles->where('status', 'approved')->orderBy('id', 'DESC')->limit(2)->findAll();
        $data3 = array_map(fn($item) => (object)$item, $data3);

        $farmasiPosts = $articles->where(['category' => 'Farmasi', 'status' => 'approved'])->orderBy('id', 'DESC')->limit(2)->findAll();
        $farmasiPosts = array_map(fn($item) => (object)$item, $farmasiPosts);

        $farmasiPostsRecomendasi = $articles->where(['category' => 'Farmasi', 'status' => 'approved'])->orderBy('title', 'DESC')->limit(3)->findAll();
        $farmasiPostsRecomendasi = array_map(fn($item) => (object)$item, $farmasiPostsRecomendasi);

        $dataFourPosts = $articles->where('status', 'approved')->orderBy('id', 'DESC')->limit(4)->findAll();
        $dataFourPosts = array_map(fn($item) => (object)$item, $dataFourPosts);

        $giziPosts = $articles->where(['category' => 'Gizi', 'status' => 'approved'])->orderBy('id', 'DESC')->limit(2)->findAll();
        $giziPosts = array_map(fn($item) => (object)$item, $giziPosts);

        $giziPostsRecomendasi = $articles->where(['category' => 'Gizi', 'status' => 'approved'])->orderBy('title', 'DESC')->limit(3)->findAll();
        $giziPostsRecomendasi = array_map(fn($item) => (object)$item, $giziPostsRecomendasi);

        $bidanPosts = $articles->where(['category' => 'Bidan', 'status' => 'approved'])->orderBy('id', 'DESC')->limit(9)->findAll();
        $bidanPosts = array_map(fn($item) => (object)$item, $bidanPosts);

        $categories = [['name' => 'Farmasi'], ['name' => 'Gizi'], ['name' => 'Bidan']];
        $totalArtikel = $articles->where('status', 'approved')->countAllResults();
        
        // Get running text items (poster/modul yang dipilih superadmin)
        $runningTextModel = new RunningTextModel();
        $latestDownloads = $runningTextModel->getRunningTextItems();
        
        // Fallback: jika belum ada setting, ambil 5 poster terbaru
        if (empty($latestDownloads)) {
            $latestDownloads = $posterModel->orderBy('created_at', 'DESC')->limit(5)->findAll();
            // Format agar konsisten dengan running text items
            $latestDownloads = array_map(function($item) {
                return [
                    'item_type' => 'poster',
                    'poster_title' => $item['title'],
                    'poster_link' => $item['link_drive']
                ];
            }, $latestDownloads);
        }
        
        // Get artikel categories for dynamic tabs
        $categoryModel = new CategoryModel();
        $artikelCategories = $categoryModel->where(['type' => 'artikel', 'is_active' => 1])->findAll();

        return view('home', compact('title', 'data', 'data1', 'data3', 'farmasiPosts', 'farmasiPostsRecomendasi', 'dataFourPosts', 'giziPosts', 'giziPostsRecomendasi', 'bidanPosts', 'categories', 'totalArtikel', 'latestDownloads', 'artikelCategories'));
    }

    public function tentangKami()
    {
        return view('pages/tentang-kami');
    }

    public function kontak()
    {
        return view('pages/kontak');
    }

    public function layanan()
    {
        return view('pages/layanan');
    }


    public function syaratKetentuan()
    {
        return view('pages/terms');
    }

    public function kebijakanPrivasi()
    {
        return view('pages/privacy');
    }

    public function petunjukPenggunaan()
    {
        return view('pages/petunjukPenggunaan');
    }

    public function getArtikelByKategori()
    {
        $articles = new ArticleModel();
        $kategori = $this->request->getPost('kategori');
        
        if ($kategori === 'semua') {
            $data = $articles->where('status', 'approved')->orderBy('id', 'DESC')->limit(5)->findAll();
        } else {
            // Find category by slug
            $categoryModel = new CategoryModel();
            $cat = $categoryModel->where(['slug' => $kategori, 'type' => 'artikel'])->first();
            
            if ($cat) {
                $data = $articles
                    ->distinct()
                    ->select('articles.*')
                    ->join('article_categories', 'article_categories.article_id = articles.id')
                    ->where('article_categories.category_id', $cat['id'])
                    ->where('articles.status', 'approved')
                    ->groupBy('articles.id')
                    ->orderBy('articles.created_at', 'DESC')
                    ->limit(5)
                    ->findAll();
            } else {
                $data = [];
            }
        }
        
        return $this->response->setJSON($data ?: []);
    }

    // Method untuk backward compatibility
    public function index()
    {
        return $this->beranda();
    }

    // Method lama untuk backward compatibility
    public function aboutUs()
    {
        return $this->tentangKami();
    }

    public function contact()
    {
        return $this->kontak();
    }

    public function service()
    {
        return $this->layanan();
    }

    public function terms()
    {
        return $this->syaratKetentuan();
    }

    public function privacy()
    {
        return $this->kebijakanPrivasi();
    }


}

