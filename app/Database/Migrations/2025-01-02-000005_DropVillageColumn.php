<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DropVillageColumn extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('users', 'village');
    }

    public function down()
    {
        $this->forge->addColumn('users', [
            'village' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'phone_number'
            ]
        ]);
    }
}
