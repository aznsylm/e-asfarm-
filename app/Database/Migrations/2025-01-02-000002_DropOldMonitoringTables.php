<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropOldMonitoringTables extends Migration
{
    public function up()
    {
        $this->forge->dropTable('monitoring_etnomedisin', true);
        $this->forge->dropTable('monitoring_suplementasi', true);
        $this->forge->dropTable('monitoring_keluhan', true);
        $this->forge->dropTable('monitoring_antropometri', true);
    }

    public function down()
    {
        // Tidak perlu rollback karena tabel sudah tidak dipakai
    }
}
