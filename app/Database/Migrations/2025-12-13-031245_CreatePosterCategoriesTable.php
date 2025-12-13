<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePosterCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'poster_id' => ['type' => 'INT', 'unsigned' => true],
            'category_id' => ['type' => 'INT', 'unsigned' => true],
        ]);
        $this->forge->addPrimaryKey(['poster_id', 'category_id']);
        $this->forge->addForeignKey('poster_id', 'posters', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('poster_categories');
    }

    public function down()
    {
        $this->forge->dropTable('poster_categories');
    }
}
