<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixAuthGroups extends Migration
{
    public function up()
    {
        // Clear existing auth_groups_users data
        $this->db->query("DELETE FROM auth_groups_users");
        
        // Insert correct user-group assignments
        $data = [
            // Regular users (pengguna)
            ['user_id' => 5, 'group' => 'pengguna', 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 11, 'group' => 'pengguna', 'created_at' => date('Y-m-d H:i:s')],
            
            // Admin users
            ['user_id' => 1, 'group' => 'admin', 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 2, 'group' => 'admin', 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 3, 'group' => 'admin', 'created_at' => date('Y-m-d H:i:s')],
            ['user_id' => 4, 'group' => 'admin', 'created_at' => date('Y-m-d H:i:s')],
            
            // Super admin
            ['user_id' => 8, 'group' => 'superadmin', 'created_at' => date('Y-m-d H:i:s')],
        ];
        
        $this->db->table('auth_groups_users')->insertBatch($data);
        
        // Activate superadmin user
        $this->db->query("UPDATE users SET active = 1 WHERE id = 8");
    }

    public function down()
    {
        // Revert to original state if needed
        $this->db->query("DELETE FROM auth_groups_users");
    }
}
