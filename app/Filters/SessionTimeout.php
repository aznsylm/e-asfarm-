<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionTimeout implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        if (!auth()->loggedIn()) {
            return;
        }

        $session = session();
        $lastActivity = $session->get('last_activity');
        $timeout = 1800; // 30 menit dalam detik

        // Jika last_activity ada dan sudah timeout
        if ($lastActivity && (time() - $lastActivity > $timeout)) {
            auth()->logout();
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Sesi Anda telah berakhir karena tidak ada aktivitas selama 30 menit. Silakan login kembali.');
        }

        // Update last activity time
        $session->set('last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
