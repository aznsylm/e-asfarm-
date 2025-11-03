<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDownloadsTable extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'category' => [
                'type' => 'ENUM',
                'constraint' => ['Edukasi', 'Panduan'],
            ],
            'link_drive' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('downloads');
    }

    public function down()
    {
        $this->forge->dropTable('downloads');
    }
}
