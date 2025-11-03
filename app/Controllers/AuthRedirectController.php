<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthRedirectController extends Controller
{
    public function afterLogin()
    {
        // Debug log
        log_message('info', 'AuthRedirectController::afterLogin() called');
        
        // Cek apakah user sudah login
        if (!auth()->loggedIn()) {
            log_message('info', 'User not logged in, redirecting to login');
            return redirect()->to('/login');
        }

        $user = auth()->user();
        log_message('info', 'User logged in: ' . $user->email);
        
        // Debug groups
        $groups = $user->getGroups();
        log_message('info', 'User groups: ' . json_encode($groups));

        // Redirect berdasarkan role
        if ($user->inGroup('superadmin')) {
            log_message('info', 'Redirecting superadmin to dashboard');
            return redirect()->to('/superadmin/dashboard')->with('success', 'Selamat datang Super Admin!');
        } 
        elseif ($user->inGroup('admin')) {
            log_message('info', 'Redirecting admin to dashboard');
            return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang Admin!');
        } 
        elseif ($user->inGroup('pengguna')) {
            log_message('info', 'Redirecting pengguna to dashboard');
            return redirect()->to('/pengguna/dashboard')->with('success', 'Selamat datang!');
        } 
        else {
            log_message('info', 'User has no role, redirecting to home');
            // User belum punya role, redirect ke home
            return redirect()->to('/')->with('info', 'Akun Anda belum memiliki role. Silakan hubungi admin.');
        }
    }

    public function afterLogout()
    {
        return redirect()->to('/')->with('success', 'Anda telah berhasil keluar.');
    }
}