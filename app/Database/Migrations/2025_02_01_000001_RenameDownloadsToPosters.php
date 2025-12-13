<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RenameDownloadsToPosters extends Migration
{
    public function up()
    {
        // Rename table
        $this->forge->renameTable('downloads', 'posters');
        
        // Modify category column
        $this->db->query("ALTER TABLE posters MODIFY COLUMN category ENUM('Ibu Hamil & Menyusui', 'Anak', 'Remaja') NOT NULL");
    }

    public function down()
    {
        // Revert category column
        $this->db->query("ALTER TABLE posters MODIFY COLUMN category ENUM('Edukasi', 'Panduan') NOT NULL");
        
        // Rename table back
        $this->forge->renameTable('posters', 'downloads');
    }
}
