<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestPostSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Tips Kesehatan Ibu Hamil',
                'body' => 'Artikel tentang tips kesehatan untuk ibu hamil yang perlu diketahui.',
                'category' => 'bidan',
                'user_id' => 1,
                'user_name' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Obat Aman untuk Ibu Menyusui',
                'body' => 'Panduan obat-obatan yang aman dikonsumsi oleh ibu menyusui.',
                'category' => 'farmasi',
                'user_id' => 1,
                'user_name' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'title' => 'Nutrisi Seimbang untuk Anak',
                'body' => 'Pentingnya nutrisi seimbang dalam tumbuh kembang anak.',
                'category' => 'gizi',
                'user_id' => 1,
                'user_name' => 'Admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $this->db->table('posts')->insertBatch($data);
    }
}