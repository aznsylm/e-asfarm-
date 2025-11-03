<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            'name'=>'Admin',
            'email'=>'melondua1@gmail.com',
            'password'=>password_hash('janganmasuk123', PASSWORD_BCRYPT),
        );

        // Using Query Builder
        $this->db->table('admins')->insert($data);
    }
}
