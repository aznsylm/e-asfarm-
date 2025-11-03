<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMonitoringTables extends Migration
{
    public function up()
    {
        // Tabel 1: monitoring_ibu_hamil (Master)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'admin_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'category' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'ibu_hamil'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_ibu_hamil');

        // Tabel 2: monitoring_identitas
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_ibu' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nama_suami' => ['type' => 'VARCHAR', 'constraint' => 255],
            'usia_ibu' => ['type' => 'INT', 'constraint' => 3],
            'usia_suami' => ['type' => 'INT', 'constraint' => 3],
            'alamat' => ['type' => 'TEXT'],
            'nomor_telepon' => ['type' => 'VARCHAR', 'constraint' => 20],
            'usia_kehamilan' => ['type' => 'INT', 'constraint' => 2],
            'rencana_tanggal_persalinan' => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_identitas');

        // Tabel 3: monitoring_antropometri
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_pemeriksaan' => ['type' => 'DATE'],
            'tekanan_darah' => ['type' => 'VARCHAR', 'constraint' => 20],
            'berat_badan' => ['type' => 'VARCHAR', 'constraint' => 10],
            'tinggi_badan' => ['type' => 'VARCHAR', 'constraint' => 10],
            'lila' => ['type' => 'VARCHAR', 'constraint' => 10],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_antropometri');

        // Tabel 4: monitoring_keluhan
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_pemeriksaan' => ['type' => 'DATE'],
            'keluhan' => ['type' => 'VARCHAR', 'constraint' => 500],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_keluhan');

        // Tabel 5: monitoring_riwayat_penyakit
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'riwayat_penyakit' => ['type' => 'VARCHAR', 'constraint' => 500],
            'tidak_ada_riwayat' => ['type' => 'VARCHAR', 'constraint' => 1, 'default' => '0'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_riwayat_penyakit');

        // Tabel 6: monitoring_skrining
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tempat_persalinan' => ['type' => 'VARCHAR', 'constraint' => 255],
            'penolong_persalinan' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_skrining');

        // Tabel 7: monitoring_suplementasi
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_pemberian' => ['type' => 'DATE'],
            'nama_suplemen' => ['type' => 'VARCHAR', 'constraint' => 255],
            'status_pemberian' => ['type' => 'VARCHAR', 'constraint' => 50],
            'jumlah_tablet' => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            'frekuensi' => ['type' => 'VARCHAR', 'constraint' => 50],
            'efek_samping' => ['type' => 'VARCHAR', 'constraint' => 500],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_suplementasi');

        // Tabel 8: monitoring_etnomedisin
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_penggunaan' => ['type' => 'DATE'],
            'menggunakan_obat_tradisional' => ['type' => 'VARCHAR', 'constraint' => 1, 'default' => '0'],
            'jenis_obat' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'tujuan_penggunaan' => ['type' => 'VARCHAR', 'constraint' => 500, 'null' => true],
            'dosis_frekuensi' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'edukasi_diberikan' => ['type' => 'VARCHAR', 'constraint' => 1, 'default' => '0'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_etnomedisin');
    }

    public function down()
    {
        $this->forge->dropTable('monitoring_etnomedisin', true);
        $this->forge->dropTable('monitoring_suplementasi', true);
        $this->forge->dropTable('monitoring_skrining', true);
        $this->forge->dropTable('monitoring_riwayat_penyakit', true);
        $this->forge->dropTable('monitoring_keluhan', true);
        $this->forge->dropTable('monitoring_antropometri', true);
        $this->forge->dropTable('monitoring_identitas', true);
        $this->forge->dropTable('monitoring_ibu_hamil', true);
    }
}
