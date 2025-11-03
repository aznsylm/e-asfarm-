<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LoginAttemptModel;

class AuthController extends BaseController
{
    protected $userModel;
    protected $loginAttemptModel;
    protected $maxAttempts = 5;
    protected $lockoutTime = 15; // minutes

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->loginAttemptModel = new LoginAttemptModel();
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return $this->redirectToDashboard();
        }
        return view('auth/login');
    }

    private function redirectToDashboard()
    {
        $role = session()->get('role');
        switch ($role) {
            case 'superadmin':
            case 'admin':
                return redirect()->to('/admin/dashboard');
            default:
                return redirect()->to('/pengguna/dashboard');
        }
    }

    public function attemptLogin()
    {
        $emailOrPhone = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $ipAddress = $this->request->getIPAddress();

        // Cek apakah akun terkunci
        if ($this->loginAttemptModel->isLocked($emailOrPhone, $ipAddress)) {
            $remainingTime = $this->loginAttemptModel->getRemainingLockTime($emailOrPhone, $ipAddress);
            return redirect()->to('/login')->with('error', "Terlalu banyak percobaan login. Coba lagi dalam {$remainingTime} menit.");
        }

        // Cek SuperAdmin dari .env dulu (dengan hash verification)
        if ($emailOrPhone === env('SUPERADMIN_EMAIL') && password_verify($password, env('SUPERADMIN_PASSWORD'))) {
            $this->loginAttemptModel->resetAttempts($emailOrPhone, $ipAddress);
            session()->set([
                'user_id' => 0,
                'username' => env('SUPERADMIN_USERNAME'),
                'email' => env('SUPERADMIN_EMAIL'),
                'role' => 'superadmin',
                'logged_in' => true,
                'last_activity' => time()
            ]);
            return redirect()->to('/admin/dashboard');
        }

        // Cek admin & pengguna dari database
        // Deteksi apakah input adalah nomor HP (hanya angka)
        if (preg_match('/^[0-9]+$/', $emailOrPhone)) {
            $user = $this->userModel->where('phone_number', $emailOrPhone)->first();
        } else {
            $user = $this->userModel->where('email', $emailOrPhone)->first();
        }

        if ($user && password_verify($password, $user['password'])) {
            $this->loginAttemptModel->resetAttempts($emailOrPhone, $ipAddress);
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'role' => $user['role'],
                'padukuhan_id' => $user['padukuhan_id'],
                'logged_in' => true,
                'last_activity' => time()
            ]);

            // Redirect berdasarkan role
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('/admin/dashboard');
                default:
                    return redirect()->to('/pengguna/dashboard');
            }
        }

        // Login gagal - catat percobaan
        $attempts = $this->loginAttemptModel->recordAttempt($emailOrPhone, $ipAddress);
        
        if ($attempts >= $this->maxAttempts) {
            $this->loginAttemptModel->lockAccount($emailOrPhone, $ipAddress, $this->lockoutTime);
            return redirect()->to('/login')->with('error', "Terlalu banyak percobaan login gagal. Akun dikunci selama {$this->lockoutTime} menit.");
        }

        $remainingAttempts = $this->maxAttempts - $attempts;
        return redirect()->to('/login')->with('error', "Email/Nomor HP atau password salah! Sisa percobaan: {$remainingAttempts}");
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Berhasil logout!');
    }
}