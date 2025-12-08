<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMonitoringBalitaTables extends Migration
{
    public function up()
    {
        // 1. Tabel Master Monitoring Balita
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'kategori' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'balita'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('monitoring_balita');

        // 2. Tabel Identitas Anak & Wali (Tahap 1)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'nama_anak' => ['type' => 'VARCHAR', 'constraint' => 255],
            'tanggal_lahir' => ['type' => 'DATE'],
            'nama_wali' => ['type' => 'VARCHAR', 'constraint' => 255],
            'no_hp_wali' => ['type' => 'VARCHAR', 'constraint' => 20],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('monitoring_balita_id', 'monitoring_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('monitoring_balita_identitas');

        // 3. Tabel Master Kunjungan Balita
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'monitoring_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tanggal_kunjungan' => ['type' => 'DATE'],
            'kunjungan_ke' => ['type' => 'INT', 'constraint' => 11],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('monitoring_balita_id', 'monitoring_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_balita');

        // 4. Tabel Antropometri (Tahap 2)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'berat_badan' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'tinggi_badan' => ['type' => 'DECIMAL', 'constraint' => '5,2'],
            'lingkar_kepala' => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_balita_id', 'kunjungan_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_balita_antropometri');

        // 5. Tabel Keluhan (Tahap 3)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'batuk' => ['type' => 'BOOLEAN', 'default' => 0],
            'pilek' => ['type' => 'BOOLEAN', 'default' => 0],
            'demam' => ['type' => 'BOOLEAN', 'default' => 0],
            'diare' => ['type' => 'BOOLEAN', 'default' => 0],
            'sembelit' => ['type' => 'BOOLEAN', 'default' => 0],
            'gtm' => ['type' => 'BOOLEAN', 'default' => 0],
            'lainnya' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_balita_id', 'kunjungan_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_balita_keluhan');

        // 6. Tabel Imunisasi (Tahap 4)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'riwayat_alergi' => ['type' => 'TEXT', 'null' => true],
            'status_imunisasi' => ['type' => 'ENUM', 'constraint' => ['Lengkap', 'Terlewat', 'Belum'], 'default' => 'Belum'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_balita_id', 'kunjungan_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_balita_imunisasi');

        // 7. Tabel Detail Imunisasi (untuk 9 jenis vaksin dengan sub-checkbox)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_balita_imunisasi_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'jenis_vaksin' => ['type' => 'VARCHAR', 'constraint' => 100],
            'waktu_pemberian' => ['type' => 'TEXT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_balita_imunisasi_id', 'kunjungan_balita_imunisasi', 'id', 'CASCADE', 'CASCADE', 'fk_imunisasi_detail');
        $this->forge->createTable('kunjungan_balita_imunisasi_detail');

        // 8. Tabel KPSP (Tahap 5)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'hasil_skrining' => ['type' => 'ENUM', 'constraint' => ['Sesuai', 'Meragukan', 'Penyimpangan'], 'default' => 'Sesuai'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_balita_id', 'kunjungan_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_balita_kpsp');

        // 9. Tabel Gizi & Suplementasi (Tahap 6)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'vitamin_a' => ['type' => 'BOOLEAN', 'default' => 0],
            'obat_cacing' => ['type' => 'BOOLEAN', 'default' => 0],
            'pola_makan' => ['type' => 'ENUM', 'constraint' => ['ASI Eksklusif', 'ASI+MPASI', 'Sufor'], 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_balita_id', 'kunjungan_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_balita_gizi');

        // 10. Tabel Swamedikasi (Tahap 7)
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'kunjungan_balita_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'ke_nakes' => ['type' => 'BOOLEAN', 'default' => 0],
            'obat_modern' => ['type' => 'BOOLEAN', 'default' => 0],
            'antibiotik' => ['type' => 'BOOLEAN', 'default' => 0],
            'etnomedisin' => ['type' => 'BOOLEAN', 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('kunjungan_balita_id', 'kunjungan_balita', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kunjungan_balita_swamedikasi');
    }

    public function down()
    {
        $this->forge->dropTable('kunjungan_balita_swamedikasi', true);
        $this->forge->dropTable('kunjungan_balita_gizi', true);
        $this->forge->dropTable('kunjungan_balita_kpsp', true);
        $this->forge->dropTable('kunjungan_balita_imunisasi_detail', true);
        $this->forge->dropTable('kunjungan_balita_imunisasi', true);
        $this->forge->dropTable('kunjungan_balita_keluhan', true);
        $this->forge->dropTable('kunjungan_balita_antropometri', true);
        $this->forge->dropTable('kunjungan_balita', true);
        $this->forge->dropTable('monitoring_balita_identitas', true);
        $this->forge->dropTable('monitoring_balita', true);
    }
}
