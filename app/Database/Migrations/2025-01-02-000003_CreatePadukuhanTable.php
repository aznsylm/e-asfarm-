<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePadukuhanTable extends Migration
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
            'nama_padukuhan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'kode_padukuhan' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
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
        $this->forge->createTable('padukuhan');

        // Insert 5 padukuhan
        $data = [
            ['nama_padukuhan' => 'Padukuhan Sleman', 'kode_padukuhan' => 'PDK-01', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_padukuhan' => 'Padukuhan Bantul', 'kode_padukuhan' => 'PDK-02', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_padukuhan' => 'Padukuhan Kulon Progo', 'kode_padukuhan' => 'PDK-03', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_padukuhan' => 'Padukuhan Gunung Kidul', 'kode_padukuhan' => 'PDK-04', 'created_at' => date('Y-m-d H:i:s')],
            ['nama_padukuhan' => 'Padukuhan Yogyakarta', 'kode_padukuhan' => 'PDK-05', 'created_at' => date('Y-m-d H:i:s')],
        ];
        $this->db->table('padukuhan')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('padukuhan', true);
    }
}
