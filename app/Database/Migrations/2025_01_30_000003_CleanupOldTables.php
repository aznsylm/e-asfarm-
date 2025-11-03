<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CleanupOldTables extends Migration
{
    public function up()
    {
        // Drop old tables
        $this->forge->dropTable('comments', true);
        $this->forge->dropTable('posts', true);
        $this->forge->dropTable('files', true);
        $this->forge->dropTable('faqcategories', true);
        $this->forge->dropTable('filescategories', true);
        $this->forge->dropTable('categories', true);
        
        // Backup faqs data
        $faqs = $this->db->table('faqs')->get()->getResultArray();
        
        // Drop and recreate faqs table with new structure
        $this->forge->dropTable('faqs', true);
        
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'pertanyaan' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'jawaban' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'category' => [
                'type' => 'ENUM',
                'constraint' => ['Farmasi', 'Gizi', 'Bidan'],
                'null' => false,
                'default' => 'Farmasi'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('faqs');
        
        // Restore data with default category
        if (!empty($faqs)) {
            foreach ($faqs as $faq) {
                $this->db->table('faqs')->insert([
                    'pertanyaan' => $faq['pertanyaan'],
                    'jawaban' => $faq['jawaban'],
                    'category' => 'Farmasi',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }

    public function down()
    {
        // Reverse: remove category column and add back category_id
        $this->forge->dropColumn('faqs', 'category');
        
        $fields = [
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ]
        ];
        
        $this->forge->addColumn('faqs', $fields);
    }
}
