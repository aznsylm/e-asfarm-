<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPadukuhanToArticles extends Migration
{
    public function up()
    {
        $this->forge->addColumn('articles', [
            'padukuhan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
                'after' => 'author_id'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('articles', 'padukuhan_id');
    }
}
