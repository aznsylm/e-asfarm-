<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateTabelArtikel extends Migration
{
    public function up()
    {
        // Tambah kolom untuk sistem approval artikel
        $fields = [
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['draft', 'pending', 'approved', 'rejected'],
                'default'    => 'draft',
                'after'      => 'category'
            ],
            'feedback_admin' => [
                'type'       => 'TEXT',
                'null'       => true,
                'after'      => 'status'
            ],
            'disetujui_oleh' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'after'      => 'feedback_admin'
            ],
            'tanggal_disetujui' => [
                'type'       => 'DATETIME',
                'null'       => true,
                'after'      => 'disetujui_oleh'
            ],
            'jenis_penulis' => [
                'type'       => 'ENUM',
                'constraint' => ['pengguna', 'admin'],
                'default'    => 'pengguna',
                'after'      => 'tanggal_disetujui'
            ]
        ];

        $this->forge->addColumn('posts', $fields);

        // Tambah foreign key untuk disetujui_oleh
        $this->forge->addForeignKey('disetujui_oleh', 'users', 'id', 'SET NULL', 'SET NULL');
    }

    public function down()
    {
        // Hapus foreign key dulu
        $this->forge->dropForeignKey('posts', 'posts_disetujui_oleh_foreign');
        
        // Hapus kolom
        $this->forge->dropColumn('posts', [
            'status', 
            'feedback_admin', 
            'disetujui_oleh', 
            'tanggal_disetujui', 
            'jenis_penulis'
        ]);
    }
}