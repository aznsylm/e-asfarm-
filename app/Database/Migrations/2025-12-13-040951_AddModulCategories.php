<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModulCategories extends Migration
{
    public function up()
    {
        $data = [
            ['name' => 'Modul Kesehatan Ibu', 'type' => 'modul', 'slug' => 'modul-kesehatan-ibu', 'is_active' => 1],
            ['name' => 'Modul Kesehatan Anak', 'type' => 'modul', 'slug' => 'modul-kesehatan-anak', 'is_active' => 1],
            ['name' => 'Modul Gizi', 'type' => 'modul', 'slug' => 'modul-gizi', 'is_active' => 1],
        ];
        
        $this->db->table('categories')->insertBatch($data);
    }

    public function down()
    {
        $this->db->table('categories')->where('type', 'modul')->delete();
    }
}
