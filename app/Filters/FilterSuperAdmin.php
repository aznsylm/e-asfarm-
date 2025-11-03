<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterSuperAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        if (!auth()->loggedIn()) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah user adalah superadmin
        $user = auth()->user();
        if (!$user->inGroup('superadmin')) {
            return redirect()->to('/admin/index')->with('error', 'Akses ditolak. Hanya Super Admin yang diizinkan');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}