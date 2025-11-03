<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoginAttemptsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'ip_address' => [
                'type' => 'VARCHAR',
                'constraint' => 45,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'attempts' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1,
            ],
            'locked_until' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey(['ip_address', 'email']);
        $this->forge->createTable('login_attempts');
    }

    public function down()
    {
        $this->forge->dropTable('login_attempts', true);
    }
}
