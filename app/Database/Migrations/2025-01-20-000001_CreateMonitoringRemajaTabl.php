<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMonitoringRemajaTables extends Migration
{
    public function up()
    {
        // Tabel 1: monitoring_remaja (Master)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'admin_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'category' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'remaja'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'active'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_remaja');

        // Tabel 2: monitoring_remaja_identitas
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_lengkap' => ['type' => 'VARCHAR', 'constraint' => 255],
            'nik' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'tanggal_lahir' => ['type' => 'DATE'],
            'jenis_kelamin' => ['type' => 'ENUM', 'constraint' => ['L', 'P']],
            'nama_wali' => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_hp_wali' => ['type' => 'VARCHAR', 'constraint' => 20],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('monitoring_remaja_identitas');

        // Tabel 3: kunjungan_remaja (Master Kunjungan)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'kunjungan_ke' => ['type' => 'INT', 'constraint' => 5],
            'tanggal_kunjungan' => ['type' => 'DATE'],
            'catatan' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan_remaja');

        // Tabel 4: kunjungan_remaja_antropometri
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'berat_badan' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'tinggi_badan' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'lingkar_perut' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'tekanan_darah' => ['type' => 'VARCHAR', 'constraint' => 20],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan_remaja_antropometri');

        // Tabel 5: kunjungan_remaja_anemia
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'gejala_anemia' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan_remaja_anemia');

        // Tabel 6: kunjungan_remaja_haid
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'sudah_menstruasi' => ['type' => 'ENUM', 'constraint' => ['ya', 'tidak']],
            'keteraturan_haid' => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => true],
            'nyeri_haid' => ['type' => 'ENUM', 'constraint' => ['ya', 'tidak'], 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan_remaja_haid');

        // Tabel 7: kunjungan_remaja_gaya_hidup
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'risiko_ptm' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan_remaja_gaya_hidup');

        // Tabel 8: kunjungan_remaja_suplementasi
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'dapat_ttd' => ['type' => 'BOOLEAN', 'default' => 0],
            'minum_ttd' => ['type' => 'BOOLEAN', 'default' => 0],
            'kebiasaan_sarapan' => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan_remaja_suplementasi');

        // Tabel 9: kunjungan_remaja_swamedikasi
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'perilaku_swamedikasi' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kunjungan_remaja_swamedikasi');
    }

    public function down()
    {
        $this->forge->dropTable('kunjungan_remaja_swamedikasi', true);
        $this->forge->dropTable('kunjungan_remaja_suplementasi', true);
        $this->forge->dropTable('kunjungan_remaja_gaya_hidup', true);
        $this->forge->dropTable('kunjungan_remaja_haid', true);
        $this->forge->dropTable('kunjungan_remaja_anemia', true);
        $this->forge->dropTable('kunjungan_remaja_antropometri', true);
        $this->forge->dropTable('kunjungan_remaja', true);
        $this->forge->dropTable('monitoring_remaja_identitas', true);
        $this->forge->dropTable('monitoring_remaja', true);
    }
}
