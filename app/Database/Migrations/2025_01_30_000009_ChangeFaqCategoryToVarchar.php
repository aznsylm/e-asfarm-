<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ChangeFaqCategoryToVarchar extends Migration
{
    public function up()
    {
        // Ubah kolom category dari ENUM ke VARCHAR
        $this->forge->modifyColumn('faqs', [
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => false,
                'default' => 'kehamilan'
            ]
        ]);
        
        // Update data lama ke kategori baru
        $db = \Config\Database::connect();
        $db->query("UPDATE faqs SET category = 'nutrisi' WHERE category = 'Farmasi'");
        $db->query("UPDATE faqs SET category = 'nutrisi' WHERE category = 'Gizi'");
        $db->query("UPDATE faqs SET category = 'kehamilan' WHERE category = 'Bidan'");
        $db->query("UPDATE faqs SET category = 'etnomedisin' WHERE category = 'Etnomedisin'");
    }

    public function down()
    {
        // Rollback ke ENUM
        $db = \Config\Database::connect();
        
        // Update data kembali ke kategori lama
        $db->query("UPDATE faqs SET category = 'Farmasi' WHERE category = 'nutrisi'");
        $db->query("UPDATE faqs SET category = 'Bidan' WHERE category = 'kehamilan' OR category = 'menyusui' OR category = 'persalinan' OR category = 'vaksin'");
        $db->query("UPDATE faqs SET category = 'Etnomedisin' WHERE category = 'etnomedisin'");
        
        $this->forge->modifyColumn('faqs', [
            'category' => [
                'type' => 'ENUM',
                'constraint' => ['Farmasi', 'Gizi', 'Bidan', 'Etnomedisin'],
                'null' => false,
                'default' => 'Farmasi'
            ]
        ]);
    }
}
