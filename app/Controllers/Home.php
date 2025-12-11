<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Models\DownloadModel;

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
        $downloadModel = new DownloadModel();
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
        
        // Get latest downloads for running text
        $latestDownloads = $downloadModel->orderBy('created_at', 'DESC')->limit(10)->findAll();

        return view('home', compact('title', 'data', 'data1', 'data3', 'farmasiPosts', 'farmasiPostsRecomendasi', 'dataFourPosts', 'giziPosts', 'giziPostsRecomendasi', 'bidanPosts', 'categories', 'totalArtikel', 'latestDownloads'));
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
        } elseif ($kategori === 'kebidanan') {
            $data = $articles->where(['category' => 'Bidan', 'status' => 'approved'])->orderBy('id', 'DESC')->limit(5)->findAll();
        } else {
            $data = $articles->where(['category' => ucfirst($kategori), 'status' => 'approved'])->orderBy('id', 'DESC')->limit(5)->findAll();
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

