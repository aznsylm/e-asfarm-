<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateFaqsTable extends Migration
{
    public function up()
    {
        // Check if created_at and updated_at columns exist, if not add them
        if (!$this->db->fieldExists('created_at', 'faqs')) {
            $this->forge->addColumn('faqs', [
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ]
            ]);
        }
    }

    public function down()
    {
        $this->forge->dropColumn('faqs', ['created_at', 'updated_at']);
    }
}
