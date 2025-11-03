<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MigrateDataSeeder extends Seeder
{
    public function run()
    {
        // Migrate posts to articles
        $posts = $this->db->query("SELECT * FROM posts WHERE deleted_at IS NULL")->getResultArray();
        
        foreach ($posts as $p) {
            $this->db->table('articles')->insert([
                'title' => $p['title'],
                'content' => $p['body'],
                'category' => ucfirst($p['category']),
                'image' => $p['image'],
                'author_id' => $p['user_id'],
                'author_name' => $p['user_name'],
                'status' => 'approved',
                'created_at' => $p['created_at'],
                'updated_at' => $p['updated_at']
            ]);
        }
        
        echo "Migrated " . count($posts) . " articles\n";
        
        // Migrate files to downloads (only if you want to keep old files)
        // For now, we'll skip this since you want to use Google Drive links
        
        echo "Migration complete!\n";
    }
}
