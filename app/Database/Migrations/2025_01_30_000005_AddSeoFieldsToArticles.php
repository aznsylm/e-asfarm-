<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSeoFieldsToArticles extends Migration
{
    public function up()
    {
        $fields = [
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'title'
            ],
            'seo_title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'slug'
            ],
            'meta_description' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'seo_title'
            ]
        ];

        $this->forge->addColumn('articles', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('articles', ['slug', 'seo_title', 'meta_description']);
    }
}
