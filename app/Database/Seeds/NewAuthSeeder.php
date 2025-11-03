<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewAuthSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data safely
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');
        $this->db->table('users')->truncate();
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');

        // Create test admin
        $this->db->table('users')->insert([
            'username' => 'admin_test',
            'email' => 'admin@e-asfarm.com',
            'password' => password_hash('Admin123!', PASSWORD_DEFAULT),
            'role' => 'admin',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create test user
        $this->db->table('users')->insert([
            'username' => 'pengguna_test',
            'email' => 'pengguna@e-asfarm.com',
            'password' => password_hash('Pengguna123!', PASSWORD_DEFAULT),
            'role' => 'pengguna',
            'active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        echo "✅ Akun berhasil dibuat:\n";
        echo "Super Admin: Nurul@e-asfarm.com / Rq8!pV2#xL6m (dari .env)\n";
        echo "Admin: admin@e-asfarm.com / Admin123!\n";
        echo "Pengguna: pengguna@e-asfarm.com / Pengguna123!\n";
    }
}