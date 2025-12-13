<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard_Padukuhan extends BaseController
{
    public function tambahPadukuhan()
    {
        $this->response->setContentType('application/json');
        
        if (session()->get('role') !== 'superadmin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak']);
        }

        if (!$this->validate(['nama_padukuhan' => 'required|min_length[3]|max_length[100]'])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $padukuhanModel = new \App\Models\PadukuhanModel();
        $data = ['nama_padukuhan' => $this->request->getPost('nama_padukuhan')];

        if ($padukuhanModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Padukuhan berhasil ditambahkan']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan padukuhan']);
    }

    public function ubahPadukuhan($id)
    {
        $this->response->setContentType('application/json');
        
        if (session()->get('role') !== 'superadmin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak']);
        }

        if (!$this->validate(['nama_padukuhan' => 'required|min_length[3]|max_length[100]'])) {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }

        $padukuhanModel = new \App\Models\PadukuhanModel();
        $data = ['nama_padukuhan' => $this->request->getPost('nama_padukuhan')];

        if ($padukuhanModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Padukuhan berhasil diubah']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengubah padukuhan']);
    }

    public function hapusPadukuhan($id)
    {
        $this->response->setContentType('application/json');
        
        if (session()->get('role') !== 'superadmin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Akses ditolak']);
        }

        $padukuhanModel = new \App\Models\PadukuhanModel();
        if ($padukuhanModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Padukuhan berhasil dihapus']);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus padukuhan']);
    }

    public function getPadukuhan($id)
    {
        $this->response->setContentType('application/json');
        $padukuhanModel = new \App\Models\PadukuhanModel();
        $padukuhan = $padukuhanModel->find($id);
        
        if ($padukuhan) {
            return $this->response->setJSON(['success' => true, 'data' => $padukuhan]);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Padukuhan tidak ditemukan']);
    }
}
