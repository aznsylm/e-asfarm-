<?php

namespace App\Controllers\Modul;

use App\Controllers\BaseController;
use App\Models\ModulModel;

class ModulController extends BaseController
{
    protected $modulModel;

    public function __construct()
    {
        $this->modulModel = new ModulModel();
    }

    public function publicIndex()
    {
        $categoryModel = new \App\Models\CategoryModel();
        $categories = $categoryModel->where('type', 'modul')->where('is_active', 1)->findAll();
        
        $modulsByCategory = [];
        foreach($categories as $cat) {
            $moduls = $this->modulModel
                ->distinct()
                ->select('moduls.*')
                ->join('modul_categories', 'modul_categories.modul_id = moduls.id')
                ->where('modul_categories.category_id', $cat['id'])
                ->groupBy('moduls.id')
                ->orderBy('moduls.created_at', 'DESC')
                ->findAll();
            
            foreach($moduls as &$modul) {
                $modul['categories'] = $this->modulModel->getCategories($modul['id']);
            }
            
            $modulsByCategory[$cat['name']] = $moduls;
        }
        
        return view('pages/modul', ['modulsByCategory' => $modulsByCategory, 'categories' => $categories]);
    }

    public function index()
    {
        $moduls = $this->modulModel->orderBy('created_at', 'DESC')->paginate(10);
        
        // Load categories untuk setiap modul
        foreach($moduls as &$modul) {
            $categories = $this->modulModel->getCategories($modul['id']);
            $modul['categories'] = $categories;
            $modul['category_names'] = implode(', ', array_column($categories, 'name'));
        }
        
        $data = [
            'moduls' => $moduls,
            'pager' => $this->modulModel->pager,
            'users' => [],
            'articles' => [],
            'faqs' => [],
            'posters' => [],
            'title' => 'Kelola Modul',
            'breadcrumb' => 'Kelola Modul'
        ];

        return view('admin/kelola-modul', $data);
    }

    public function tambah()
    {
        $this->response->setContentType('application/json');

        $categories = $this->request->getPost('categories');
        if (empty($categories)) {
            return $this->response->setJSON(['success' => false, 'errors' => ['category' => 'Kategori wajib dipilih']]);
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'link_drive' => 'required|valid_url',
            'thumbnail' => 'uploaded[thumbnail]|max_size[thumbnail,2048]|is_image[thumbnail]'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $thumbnail = $this->request->getFile('thumbnail');
        $thumbnailName = $thumbnail->getRandomName();
        $thumbnail->move(FCPATH . 'uploads/moduls', $thumbnailName);

        $categoryModel = new \App\Models\CategoryModel();
        $firstCategory = $categoryModel->find($categories[0]);

        $data = [
            'title' => $this->request->getPost('title'),
            'category' => $firstCategory['name'],
            'link_drive' => $this->request->getPost('link_drive'),
            'thumbnail' => $thumbnailName
        ];

        if ($this->modulModel->insert($data)) {
            $modulId = $this->modulModel->getInsertID();
            $this->modulModel->syncCategories($modulId, $categories);
            return $this->response->setJSON(['success' => true, 'message' => 'Modul berhasil ditambahkan']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan modul']);
    }

    public function ubah($id)
    {
        $this->response->setContentType('application/json');

        $categories = $this->request->getPost('categories');
        if (empty($categories)) {
            return $this->response->setJSON(['success' => false, 'errors' => ['category' => 'Kategori wajib dipilih']]);
        }

        if (!$this->validate([
            'title' => 'required|min_length[5]',
            'link_drive' => 'required|valid_url'
        ])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $categoryModel = new \App\Models\CategoryModel();
        $firstCategory = $categoryModel->find($categories[0]);

        $data = [
            'title' => $this->request->getPost('title'),
            'category' => $firstCategory['name'],
            'link_drive' => $this->request->getPost('link_drive')
        ];

        if ($this->request->getFile('thumbnail')->isValid()) {
            $modul = $this->modulModel->find($id);
            if ($modul && file_exists(FCPATH . 'uploads/moduls/' . $modul['thumbnail'])) {
                unlink(FCPATH . 'uploads/moduls/' . $modul['thumbnail']);
            }

            $thumbnail = $this->request->getFile('thumbnail');
            $thumbnailName = $thumbnail->getRandomName();
            $thumbnail->move(FCPATH . 'uploads/moduls', $thumbnailName);
            $data['thumbnail'] = $thumbnailName;
        }

        if ($this->modulModel->update($id, $data)) {
            $this->modulModel->syncCategories($id, $categories);
            return $this->response->setJSON(['success' => true, 'message' => 'Modul berhasil diubah']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah modul']);
    }

    public function hapus($id)
    {
        $this->response->setContentType('application/json');

        $modul = $this->modulModel->find($id);
        if ($modul && file_exists(FCPATH . 'uploads/moduls/' . $modul['thumbnail'])) {
            unlink(FCPATH . 'uploads/moduls/' . $modul['thumbnail']);
        }

        if ($this->modulModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Modul berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus modul']);
    }
}
