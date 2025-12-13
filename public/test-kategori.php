<?php
require_once '../vendor/autoload.php';

$db = \Config\Database::connect();

// Test insert
$data = [
    'name' => 'Test Modul ' . time(),
    'type' => 'modul',
    'slug' => 'test-modul-' . time(),
    'is_active' => 1
];

$builder = $db->table('categories');
$result = $builder->insert($data);

if ($result) {
    echo "SUCCESS: Kategori berhasil ditambahkan dengan ID: " . $db->insertID();
} else {
    echo "FAILED: " . $db->error()['message'];
}

echo "\n\nData yang diinsert:\n";
print_r($data);
