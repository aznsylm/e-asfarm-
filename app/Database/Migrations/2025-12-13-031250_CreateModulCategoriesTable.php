<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateModulCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'modul_id' => ['type' => 'INT', 'unsigned' => true],
            'category_id' => ['type' => 'INT', 'unsigned' => true],
        ]);
        $this->forge->addPrimaryKey(['modul_id', 'category_id']);
        $this->forge->addForeignKey('modul_id', 'moduls', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('modul_categories');
    }

    public function down()
    {
        $this->forge->dropTable('modul_categories');
    }
}
