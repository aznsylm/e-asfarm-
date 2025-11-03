<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class HashPassword extends BaseCommand
{
    protected $group       = 'Auth';
    protected $name        = 'auth:hash';
    protected $description = 'Generate password hash untuk Super Admin';
    protected $usage       = 'auth:hash [password]';
    protected $arguments   = [
        'password' => 'Password yang akan di-hash'
    ];

    public function run(array $params)
    {
        $password = $params[0] ?? CLI::prompt('Masukkan password');

        if (empty($password)) {
            CLI::error('Password tidak boleh kosong!');
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        CLI::newLine();
        CLI::write('Password Hash berhasil dibuat:', 'green');
        CLI::write($hash, 'yellow');
        CLI::newLine();
        CLI::write('Copy hash di atas dan paste ke file .env pada bagian:', 'cyan');
        CLI::write('SUPERADMIN_PASSWORD = ' . $hash, 'white');
        CLI::newLine();
    }
}
