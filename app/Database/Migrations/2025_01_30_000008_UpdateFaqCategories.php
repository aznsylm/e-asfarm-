<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateFaqCategories extends Migration
{
    public function up()
    {
        // Update kategori FAQ lama ke kategori baru
        $db = \Config\Database::connect();
        
        // Set default kategori untuk FAQ yang kosong atau kategori lama
        $db->query("UPDATE faqs SET category = 'nutrisi' WHERE category = 'Farmasi' OR category = '' OR category IS NULL");
        $db->query("UPDATE faqs SET category = 'nutrisi' WHERE category = 'Gizi'");
        $db->query("UPDATE faqs SET category = 'kehamilan' WHERE category = 'Bidan'");
        $db->query("UPDATE faqs SET category = 'etnomedisin' WHERE category = 'Etnomedisin'");
    }

    public function down()
    {
        // Rollback ke kategori lama
        $db = \Config\Database::connect();
        
        $rollback = [
            'nutrisi' => 'Farmasi',
            'kehamilan' => 'Bidan',
            'etnomedisin' => 'Etnomedisin'
        ];
        
        foreach ($rollback as $new => $old) {
            $db->table('faqs')
               ->where('category', $new)
               ->update(['category' => $old]);
        }
    }
}
