<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKunjunganTables extends Migration
{
    public function up()
    {
        // Tabel kunjungan (master untuk setiap kunjungan)
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'monitoring_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'kunjungan_ke' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tanggal_kunjungan' => [
                'type' => 'DATE',
            ],
            'catatan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('monitoring_id', 'monitoring_ibu_hamil', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan');

        // Tabel kunjungan_antropometri
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'tekanan_darah' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'berat_badan' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'tinggi_badan' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'lila' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_id', 'kunjungan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_antropometri');

        // Tabel kunjungan_keluhan
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'keluhan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_id', 'kunjungan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_keluhan');

        // Tabel kunjungan_suplementasi
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama_suplemen' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'status_pemberian' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'jumlah_tablet' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'frekuensi' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'efek_samping' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_id', 'kunjungan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_suplementasi');

        // Tabel kunjungan_etnomedisin
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'kunjungan_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'menggunakan_obat_tradisional' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'jenis_obat' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tujuan_penggunaan' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'edukasi_diberikan' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_id', 'kunjungan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_etnomedisin');
    }

    public function down()
    {
        $this->forge->dropTable('kunjungan_etnomedisin', true);
        $this->forge->dropTable('kunjungan_suplementasi', true);
        $this->forge->dropTable('kunjungan_keluhan', true);
        $this->forge->dropTable('kunjungan_antropometri', true);
        $this->forge->dropTable('kunjungan', true);
    }
}
