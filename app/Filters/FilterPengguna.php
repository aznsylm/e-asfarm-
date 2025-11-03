<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class FilterPengguna implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        if (!auth()->loggedIn()) {
            return redirect()->to('/login')->with('error', 'Silakan login untuk mengakses fitur ini');
        }

        // Cek apakah user adalah pengguna terdaftar (bukan guest)
        $user = auth()->user();
        if (!$user->inGroup('pengguna') && !$user->inGroup('admin') && !$user->inGroup('superadmin')) {
            return redirect()->to('/')->with('error', 'Akses ditolak. Silakan daftar sebagai pengguna');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}