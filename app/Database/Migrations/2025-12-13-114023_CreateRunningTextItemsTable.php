<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRunningTextItemsTable extends Migration
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
            'item_type' => [
                'type' => 'ENUM',
                'constraint' => ['poster', 'modul'],
                'null' => false,
            ],
            'item_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'display_order' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
            ],
            'is_active' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1,
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
        $this->forge->addUniqueKey(['item_type', 'item_id']);
        $this->forge->createTable('running_text_items');
    }

    public function down()
    {
        $this->forge->dropTable('running_text_items');
    }
}
