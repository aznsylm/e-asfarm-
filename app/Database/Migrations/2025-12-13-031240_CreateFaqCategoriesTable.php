<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFaqCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'faq_id' => ['type' => 'INT', 'unsigned' => true],
            'category_id' => ['type' => 'INT', 'unsigned' => true],
        ]);
        $this->forge->addPrimaryKey(['faq_id', 'category_id']);
        $this->forge->addForeignKey('faq_id', 'faqs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('faq_categories');
    }

    public function down()
    {
        $this->forge->dropTable('faq_categories');
    }
}
