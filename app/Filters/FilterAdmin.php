<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        if (!auth()->loggedIn()) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        // Cek apakah user adalah admin atau superadmin
        $user = auth()->user();
        if (!$user->inGroup('admin') && !$user->inGroup('superadmin')) {
            return redirect()->to('/')->with('error', 'Akses ditolak. Anda tidak memiliki izin admin');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}