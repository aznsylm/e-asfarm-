<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AssignGroupSeeder extends Seeder
{
    public function run()
    {
        $users = auth()->getProvider();

        // Cari user berdasarkan email dan assign group
        $superAdmin = $users->findByCredentials(['email' => env('SUPER_ADMIN_EMAIL', 'superadmin@e-asfarm.com')]);
        if ($superAdmin) {
            try {
                $this->db->table('auth_groups_users')->insert([
                    'user_id' => $superAdmin->id,
                    'group' => 'superadmin',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                echo "Super Admin group assigned!\n";
            } catch (\Exception $e) {
                echo "Super Admin group sudah ada.\n";
            }
        }

        // Admin
        $admin = $users->findByCredentials(['email' => 'admin@e-asfarm.com']);
        if ($admin) {
            try {
                $this->db->table('auth_groups_users')->insert([
                    'user_id' => $admin->id,
                    'group' => 'admin',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                echo "Admin group assigned!\n";
            } catch (\Exception $e) {
                echo "Admin group sudah ada.\n";
            }
        }

        // Pengguna
        $pengguna = $users->findByCredentials(['email' => 'pengguna@e-asfarm.com']);
        if ($pengguna) {
            try {
                $this->db->table('auth_groups_users')->insert([
                    'user_id' => $pengguna->id,
                    'group' => 'pengguna',
                    'created_at' => date('Y-m-d H:i:s')
                ]);
                echo "Pengguna group assigned!\n";
            } catch (\Exception $e) {
                echo "Pengguna group sudah ada.\n";
            }
        }

        echo "Group assignment selesai!\n";
    }
}