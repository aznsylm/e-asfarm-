<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserProfileFields extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'username'
            ],
            'phone_number' => [
                'type' => 'VARCHAR',
                'constraint' => 15,
                'null' => true,
                'after' => 'full_name'
            ],
            'village' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
                'after' => 'phone_number'
            ],
            'gender' => [
                'type' => 'ENUM',
                'constraint' => ['Laki-laki', 'Perempuan'],
                'null' => true,
                'after' => 'village'
            ],
            'birth_date' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'gender'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['full_name', 'phone_number', 'village', 'gender', 'birth_date']);
    }
}
