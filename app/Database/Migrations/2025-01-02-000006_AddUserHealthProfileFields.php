<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserHealthProfileFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'nik' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
                'null' => true,
                'after' => 'full_name'
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'phone_number'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['nik', 'address']);
    }
}
