<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Entities\User;

class SuperAdminSeeder extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();

        // Cek apakah Super Admin sudah ada
        $existingUser = $users->findByCredentials(['email' => env('SUPER_ADMIN_EMAIL', 'superadmin@e-asfarm.com')]);
        
        if (!$existingUser) {
            // Buat Super Admin
            $user = new User([
                'username' => 'superadmin',
                'email'    => env('SUPER_ADMIN_EMAIL', 'superadmin@e-asfarm.com'),
                'password' => env('SUPER_ADMIN_PASSWORD', 'SuperAdmin123!')
            ]);

            $users->save($user);
            $user = $users->findByCredentials(['email' => $user->email]);
        } else {
            $user = $existingUser;
            echo "Super Admin sudah ada, skip pembuatan.\n";
        }

        // Tambahkan ke group superadmin
        try {
            $this->db->table('auth_groups_users')->insert([
                'user_id' => $user->id,
                'group' => 'superadmin',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } catch (\Exception $e) {
            echo "Group assignment untuk superadmin sudah ada atau error: " . $e->getMessage() . "\n";
        }

        // Buat Admin biasa untuk testing
        $existingAdmin = $users->findByCredentials(['email' => 'admin@e-asfarm.com']);
        
        if (!$existingAdmin) {
            $admin = new User([
                'username' => 'admin',
                'email'    => 'admin@e-asfarm.com',
                'password' => 'Admin123!'
            ]);

            $users->save($admin);
            $admin = $users->findByCredentials(['email' => $admin->email]);
            try {
                $this->db->table('auth_groups_users')->insert([
                    'user_id' => $admin->id,
                    'group' => 'admin',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            } catch (\Exception $e) {
                echo "Group assignment untuk admin error: " . $e->getMessage() . "\n";
            }
        } else {
            echo "Admin sudah ada, skip pembuatan.\n";
        }

        // Buat User biasa untuk testing
        $existingPengguna = $users->findByCredentials(['email' => 'pengguna@e-asfarm.com']);
        
        if (!$existingPengguna) {
            $pengguna = new User([
                'username' => 'pengguna_test',
                'email'    => 'pengguna@e-asfarm.com', 
                'password' => 'Pengguna123!'
            ]);

            $users->save($pengguna);
            $pengguna = $users->findByCredentials(['email' => $pengguna->email]);
            try {
                $this->db->table('auth_groups_users')->insert([
                    'user_id' => $pengguna->id,
                    'group' => 'pengguna',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            } catch (\Exception $e) {
                echo "Group assignment untuk pengguna error: " . $e->getMessage() . "\n";
            }
        } else {
            echo "Pengguna test sudah ada, skip pembuatan.\n";
        }

        echo "Super Admin, Admin, dan Pengguna test berhasil dibuat!\n";
        echo "Super Admin: " . env('SUPER_ADMIN_EMAIL', 'superadmin@e-asfarm.com') . "\n";
        echo "Admin: admin@e-asfarm.com\n";
        echo "Pengguna: pengguna@e-asfarm.com\n";
    }
}