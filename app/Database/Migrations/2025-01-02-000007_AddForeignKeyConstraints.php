<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyConstraints extends Migration
{
    public function up()
    {
        // Clean orphan data first
        $this->db->query('DELETE FROM monitoring_ibu_hamil WHERE user_id NOT IN (SELECT id FROM users)');
        $this->db->query('DELETE FROM monitoring_identitas WHERE monitoring_id NOT IN (SELECT id FROM monitoring_ibu_hamil)');
        $this->db->query('DELETE FROM monitoring_riwayat_penyakit WHERE monitoring_id NOT IN (SELECT id FROM monitoring_ibu_hamil)');
        $this->db->query('DELETE FROM monitoring_skrining WHERE monitoring_id NOT IN (SELECT id FROM monitoring_ibu_hamil)');
        $this->db->query('DELETE FROM kunjungan WHERE monitoring_id NOT IN (SELECT id FROM monitoring_ibu_hamil)');
        
        // Foreign key: monitoring_ibu_hamil -> users
        $this->db->query('ALTER TABLE monitoring_ibu_hamil ADD CONSTRAINT fk_monitoring_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE');

        // Foreign key: monitoring_identitas -> monitoring_ibu_hamil
        $this->db->query('ALTER TABLE monitoring_identitas ADD CONSTRAINT fk_identitas_monitoring FOREIGN KEY (monitoring_id) REFERENCES monitoring_ibu_hamil(id) ON DELETE CASCADE ON UPDATE CASCADE');

        // Foreign key: monitoring_riwayat_penyakit -> monitoring_ibu_hamil
        $this->db->query('ALTER TABLE monitoring_riwayat_penyakit ADD CONSTRAINT fk_riwayat_monitoring FOREIGN KEY (monitoring_id) REFERENCES monitoring_ibu_hamil(id) ON DELETE CASCADE ON UPDATE CASCADE');

        // Foreign key: monitoring_skrining -> monitoring_ibu_hamil
        $this->db->query('ALTER TABLE monitoring_skrining ADD CONSTRAINT fk_skrining_monitoring FOREIGN KEY (monitoring_id) REFERENCES monitoring_ibu_hamil(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE monitoring_ibu_hamil DROP FOREIGN KEY fk_monitoring_user');
        $this->db->query('ALTER TABLE monitoring_identitas DROP FOREIGN KEY fk_identitas_monitoring');
        $this->db->query('ALTER TABLE monitoring_riwayat_penyakit DROP FOREIGN KEY fk_riwayat_monitoring');
        $this->db->query('ALTER TABLE monitoring_skrining DROP FOREIGN KEY fk_skrining_monitoring');
    }
}
