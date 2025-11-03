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
            'padukuhan' => $this->padukuhanModel->findAll()
        ];
        return view('admin/padukuhan/index', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kode_padukuhan' => 'required|is_unique[padukuhan.kode_padukuhan]',
            'nama_padukuhan' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->with('error', 'Kode padukuhan sudah digunakan atau data tidak valid');
        }

        $this->padukuhanModel->save([
            'kode_padukuhan' => $this->request->getPost('kode_padukuhan'),
            'nama_padukuhan' => $this->request->getPost('nama_padukuhan')
        ]);

        return redirect()->to('/admin/padukuhan')->with('success', 'Padukuhan berhasil ditambahkan');
    }

    public function update($id)
    {
        $this->padukuhanModel->update($id, [
            'kode_padukuhan' => $this->request->getPost('kode_padukuhan'),
            'nama_padukuhan' => $this->request->getPost('nama_padukuhan')
        ]);

        return redirect()->to('/admin/padukuhan')->with('success', 'Padukuhan berhasil diperbarui');
    }

    public function delete($id)
    {
        $userCount = $this->userModel->where('padukuhan_id', $id)->countAllResults();
        
        if ($userCount > 0) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus padukuhan yang masih memiliki pengguna');
        }

        $this->padukuhanModel->delete($id);
        return redirect()->to('/admin/padukuhan')->with('success', 'Padukuhan berhasil dihapus');
    }
}
