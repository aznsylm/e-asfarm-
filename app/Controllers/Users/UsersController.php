<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class UsersController extends BaseController
{
    public function dashboard()
    {
        helper('auth');
        
        $user = current_user();
        $articleModel = new ArticleModel();

        // Statistik artikel user
        $totalArtikel = $articleModel->where('author_id', $user->id)->countAllResults();
        $artikelPending = $articleModel->where('author_id', $user->id)->where('status', 'pending')->countAllResults();
        $artikelApproved = $articleModel->where('author_id', $user->id)->where('status', 'approved')->countAllResults();
        $artikelRejected = $articleModel->where('author_id', $user->id)->where('status', 'rejected')->countAllResults();

        // Artikel terbaru user
        $artikelTerbaru = $articleModel->where('author_id', $user->id)
                                   ->orderBy('created_at', 'DESC')
                                   ->limit(5)
                                   ->find();

        $data = [
            'user' => $user,
            'totalArtikel' => $totalArtikel,
            'artikelPending' => $artikelPending,
            'artikelApproved' => $artikelApproved,
            'artikelRejected' => $artikelRejected,
            'artikelTerbaru' => $artikelTerbaru
        ];

        return view('users/dashboard', $data);
    }

    public function artikelSaya()
    {
        helper('auth');
        
        $user = current_user();
        $articleModel = new ArticleModel();

        // Ambil semua artikel user dengan pagination
        $artikelSaya = $articleModel->where('author_id', $user->id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);

        $data = [
            'user' => $user,
            'artikelSaya' => $artikelSaya,
            'pager' => $articleModel->pager
        ];

        return view('users/artikel-saya', $data);
    }

    public function monitoring()
    {
        helper('auth');
        
        $user = current_user();

        $data = [
            'user' => $user,
            'title' => 'Monitoring Kesehatan'
        ];

        return view('users/monitoring', $data);
    }

    // CRUD ARTIKEL PENGGUNA
    public function tambahArtikel()
    {
        $this->response->setContentType('application/json');
        helper('auth');
        $user = current_user();

        if (!$user) {
            return $this->response->setJSON(['success' => false, 'message' => 'User tidak terautentikasi']);
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[20]',
            'category' => 'required',
            'image' => 'uploaded[image]|max_size[image,2048]|ext_in[image,jpg,jpeg,png,webp]'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $articleModel = new ArticleModel();
        $image = $this->request->getFile('image');
        
        if (!$image->isValid()) {
            return $this->response->setJSON(['success' => false, 'message' => 'File gambar tidak valid: ' . $image->getErrorString()]);
        }
        
        $imageName = $image->getRandomName();
        
        if (!$image->move(FCPATH . 'uploads/articles', $imageName)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengupload gambar']);
        }

        $title = $this->request->getPost('title');
        $slug = $articleModel->generateSlug($title);
        $content = $this->request->getPost('content');
        $seoTitle = $this->request->getPost('seo_title') ?: $title;
        $metaDesc = $this->request->getPost('meta_description') ?: substr(strip_tags($content), 0, 160);

        $data = [
            'title' => $title,
            'slug' => $slug,
            'seo_title' => $seoTitle,
            'meta_description' => $metaDesc,
            'content' => $content,
            'category' => $this->request->getPost('category'),
            'image' => $imageName,
            'author_id' => $user->id,
            'author_name' => $user->username,
            'status' => 'pending'
        ];

        if ($articleModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil dibuat dan menunggu persetujuan admin']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan artikel']);
    }

    public function ubahArtikel($id)
    {
        $this->response->setContentType('application/json');
        helper('auth');
        $user = current_user();
        
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        if (!$article || $article['author_id'] != $user->id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Artikel tidak ditemukan atau Anda tidak memiliki akses']);
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'content' => 'required|min_length[20]',
            'category' => 'required'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        
        $data = [
            'title' => $title,
            'slug' => $articleModel->generateSlug($title, $id),
            'seo_title' => $this->request->getPost('seo_title') ?: $title,
            'meta_description' => $this->request->getPost('meta_description') ?: substr(strip_tags($content), 0, 160),
            'content' => $content,
            'category' => $this->request->getPost('category'),
            'status' => 'pending'
        ];

        if ($this->request->getFile('image')->isValid()) {
            if (file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
                unlink(FCPATH . 'uploads/articles/' . $article['image']);
            }

            $image = $this->request->getFile('image');
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/articles', $imageName);
            $data['image'] = $imageName;
        }

        if ($articleModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil diubah dan menunggu persetujuan admin']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah artikel']);
    }

    public function hapusArtikel($id)
    {
        $this->response->setContentType('application/json');
        helper('auth');
        $user = current_user();
        
        $articleModel = new ArticleModel();
        $article = $articleModel->find($id);

        if (!$article || $article['author_id'] != $user->id) {
            return $this->response->setJSON(['success' => false, 'message' => 'Artikel tidak ditemukan atau Anda tidak memiliki akses']);
        }

        if (file_exists(FCPATH . 'uploads/articles/' . $article['image'])) {
            unlink(FCPATH . 'uploads/articles/' . $article['image']);
        }

        if ($articleModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Artikel berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus artikel']);
    }
}