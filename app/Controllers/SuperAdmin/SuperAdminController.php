<?php

namespace App\Controllers\SuperAdmin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class SuperAdminController extends BaseController
{
    public function dashboard()
    {
        helper('auth');
        
        $data = [
            'title' => 'Dashboard Super Admin',
            'user' => current_user()
        ];
        
        return view('superadmin/dashboard', $data);
    }

    public function kelolaAdmin()
    {
        $userModel = new UserModel();
        $admins = $userModel->whereHas('groups', function($query) {
            $query->whereIn('name', ['admin', 'superadmin']);
        })->findAll();

        $data = [
            'title' => 'Kelola Admin',
            'admins' => $admins,
            'user' => auth()->user()
        ];

        return view('superadmin/kelola-admin', $data);
    }

    public function tambahAdmin()
    {
        $data = [
            'title' => 'Tambah Admin',
            'user' => auth()->user()
        ];

        return view('superadmin/tambah-admin', $data);
    }

    public function simpanAdmin()
    {
        $rules = [
            'username' => 'required|min_length[3]|max_length[30]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[8]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userProvider = auth()->getProvider();
        
        $user = new \CodeIgniter\Shield\Entities\User([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password')
        ]);

        $userProvider->save($user);
        $user = $userProvider->findByCredentials(['email' => $user->email]);

        // Add to admin group
        $user->addToGroup('admin');

        return redirect()->to('/superadmin/kelola-admin')->with('success', 'Admin berhasil ditambahkan!');
    }

    public function kelolaPengguna()
    {
        $userModel = new UserModel();
        $pengguna = $userModel->whereHas('groups', function($query) {
            $query->where('name', 'pengguna');
        })->findAll();

        $data = [
            'title' => 'Kelola Pengguna',
            'pengguna' => $pengguna,
            'user' => auth()->user()
        ];

        return view('superadmin/kelola-pengguna', $data);
    }

    public function pengaturanSistem()
    {
        $data = [
            'title' => 'Pengaturan Sistem',
            'user' => auth()->user()
        ];

        return view('superadmin/pengaturan-sistem', $data);
    }

    public function updateAdmin($id)
    {
        // Implementation for updating admin
        return redirect()->back()->with('success', 'Admin berhasil diupdate!');
    }

    public function hapusAdmin($id)
    {
        $userProvider = auth()->getProvider();
        $user = $userProvider->findById($id);
        
        if ($user && $user->inGroup('admin')) {
            $userProvider->delete($id, true);
            return redirect()->back()->with('success', 'Admin berhasil dihapus!');
        }
        
        return redirect()->back()->with('error', 'Admin tidak ditemukan!');
    }

    public function hapusPengguna($id)
    {
        $userProvider = auth()->getProvider();
        $user = $userProvider->findById($id);
        
        if ($user && $user->inGroup('pengguna')) {
            $userProvider->delete($id, true);
            return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
        }
        
        return redirect()->back()->with('error', 'Pengguna tidak ditemukan!');
    }

    public function simpanPengaturan()
    {
        // Implementation for system settings
        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan!');
    }
}