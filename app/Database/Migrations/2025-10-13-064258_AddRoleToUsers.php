<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUsers extends Migration
{
    public function up()
    {
        // Add role and email columns to users table
        $this->forge->addColumn('users', [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true,
                'after' => 'username'
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'after' => 'email'
            ],
            'role' => [
                'type' => 'ENUM',
                'constraint' => ['pengguna', 'admin', 'superadmin'],
                'default' => 'pengguna',
                'after' => 'password'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['email', 'password', 'role']);
    }
}
