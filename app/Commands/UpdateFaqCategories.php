<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class UpdateFaqCategories extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'faq:update-categories';
    protected $description = 'Update FAQ categories yang kosong ke kategori default';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        
        // Update semua FAQ dengan kategori kosong ke 'nutrisi'
        $db->query("UPDATE faqs SET category = 'nutrisi' WHERE category = '' OR category IS NULL");
        
        $affected = $db->affectedRows();
        
        CLI::write("FAQ categories updated successfully!", 'green');
        CLI::write("Affected rows: {$affected}", 'yellow');
    }
}
