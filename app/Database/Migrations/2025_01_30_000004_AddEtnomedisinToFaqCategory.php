<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEtnomedisinToFaqCategory extends Migration
{
    public function up()
    {
        $this->db->query("ALTER TABLE `faqs` MODIFY `category` ENUM('Farmasi', 'Gizi', 'Bidan', 'Etnomedisin') NOT NULL DEFAULT 'Farmasi'");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE `faqs` MODIFY `category` ENUM('Farmasi', 'Gizi', 'Bidan') NOT NULL DEFAULT 'Farmasi'");
    }
}
