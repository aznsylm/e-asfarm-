<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SuperAdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('auth');
        
        if (!is_logged_in()) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        
        if (user_role() !== 'superadmin') {
            return redirect()->to('/')->with('error', 'Akses ditolak');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}