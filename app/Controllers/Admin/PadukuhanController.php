<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PadukuhanModel;
use App\Models\UserModel;

class PadukuhanController extends BaseController
{
    protected $padukuhanModel;
    protected $userModel;

    public function __construct()
    {
        $this->padukuhanModel = new PadukuhanModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Padukuhan',
            'breadcrumb' => 'Kelola Padukuhan',
            'padukuhan' => $this->padukuhanModel->findAll()
        ];
        return view('admin/kelola-padukuhan', $data);
    }

    public function store()
    {
        $this->response->setContentType('application/json');

        if (!$this->validate(['nama_padukuhan' => 'required|min_length[3]'])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        if ($this->padukuhanModel->insert(['nama_padukuhan' => $this->request->getPost('nama_padukuhan')])) {
            return $this->response->setJSON(['success' => true, 'message' => 'Padukuhan berhasil ditambahkan']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan padukuhan']);
    }

    public function update($id)
    {
        $this->response->setContentType('application/json');

        if (!$this->validate(['nama_padukuhan' => 'required|min_length[3]'])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        if ($this->padukuhanModel->update($id, ['nama_padukuhan' => $this->request->getPost('nama_padukuhan')])) {
            return $this->response->setJSON(['success' => true, 'message' => 'Padukuhan berhasil diubah']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah padukuhan']);
    }

    public function delete($id)
    {
        $this->response->setContentType('application/json');

        $userCount = $this->userModel->where('padukuhan_id', $id)->countAllResults();
        if ($userCount > 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Tidak dapat menghapus padukuhan yang masih memiliki pengguna']);
        }

        if ($this->padukuhanModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Padukuhan berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus padukuhan']);
    }

    public function get($id)
    {
        $this->response->setContentType('application/json');
        $padukuhan = $this->padukuhanModel->find($id);
        
        if ($padukuhan) {
            return $this->response->setJSON(['success' => true, 'data' => $padukuhan]);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Padukuhan tidak ditemukan']);
    }
}
