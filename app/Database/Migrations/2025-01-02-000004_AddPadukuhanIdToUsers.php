<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPadukuhanIdToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'padukuhan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'role',
            ],
        ]);

        // Add foreign key
        $this->forge->addForeignKey('padukuhan_id', 'users', 'padukuhan', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('users', 'users_padukuhan_id_foreign');
        $this->forge->dropColumn('users', 'padukuhan_id');
    }
}
