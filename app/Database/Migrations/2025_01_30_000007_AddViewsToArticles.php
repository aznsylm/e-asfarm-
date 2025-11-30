<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddViewsToArticles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('articles', [
            'views' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'default' => 0,
                'after' => 'status'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('articles', 'views');
    }
}
