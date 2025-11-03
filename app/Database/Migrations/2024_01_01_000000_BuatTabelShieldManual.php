<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelShieldManual extends Migration
{
    public function up()
    {
        // Buat tabel auth_groups jika belum ada
        if (!$this->db->tableExists('auth_groups')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'title' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'description' => [
                    'type' => 'TEXT',
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
            $this->forge->createTable('auth_groups');
        }

        // Buat tabel auth_permissions jika belum ada
        if (!$this->db->tableExists('auth_permissions')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'name' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                ],
                'description' => [
                    'type' => 'TEXT',
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
            $this->forge->createTable('auth_permissions');
        }

        // Buat tabel auth_groups_permissions jika belum ada
        if (!$this->db->tableExists('auth_groups_permissions')) {
            $this->forge->addField([
                'group_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                ],
                'permission_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                ],
            ]);
            $this->forge->addKey(['group_id', 'permission_id'], true);
            $this->forge->createTable('auth_groups_permissions');
        }

        // Buat tabel auth_groups_users jika belum ada
        if (!$this->db->tableExists('auth_groups_users')) {
            $this->forge->addField([
                'group_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                ],
                'user_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                ],
            ]);
            $this->forge->addKey(['group_id', 'user_id'], true);
            $this->forge->createTable('auth_groups_users');
        }
    }

    public function down()
    {
        $this->forge->dropTable('auth_groups_users', true);
        $this->forge->dropTable('auth_groups_permissions', true);
        $this->forge->dropTable('auth_permissions', true);
        $this->forge->dropTable('auth_groups', true);
    }
}