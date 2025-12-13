<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Artikel
            ['name' => 'Farmasi', 'type' => 'artikel', 'slug' => 'farmasi', 'is_active' => 1],
            ['name' => 'Gizi', 'type' => 'artikel', 'slug' => 'gizi', 'is_active' => 1],
            ['name' => 'Bidan', 'type' => 'artikel', 'slug' => 'bidan', 'is_active' => 1],
            
            // Tanya Jawab
            ['name' => 'Kehamilan', 'type' => 'tanya_jawab', 'slug' => 'kehamilan', 'is_active' => 1],
            ['name' => 'Menyusui', 'type' => 'tanya_jawab', 'slug' => 'menyusui', 'is_active' => 1],
            ['name' => 'Persalinan', 'type' => 'tanya_jawab', 'slug' => 'persalinan', 'is_active' => 1],
            ['name' => 'Vaksin', 'type' => 'tanya_jawab', 'slug' => 'vaksin', 'is_active' => 1],
            ['name' => 'Nutrisi', 'type' => 'tanya_jawab', 'slug' => 'nutrisi', 'is_active' => 1],
            ['name' => 'Etnomedisin', 'type' => 'tanya_jawab', 'slug' => 'etnomedisin', 'is_active' => 1],
            
            // Poster
            ['name' => 'Ibu Hamil & Menyusui', 'type' => 'poster', 'slug' => 'ibu-hamil-menyusui', 'is_active' => 1],
            ['name' => 'Anak', 'type' => 'poster', 'slug' => 'anak', 'is_active' => 1],
            ['name' => 'Remaja', 'type' => 'poster', 'slug' => 'remaja', 'is_active' => 1],
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
