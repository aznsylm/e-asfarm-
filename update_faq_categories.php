<?php
// Script untuk update kategori FAQ yang kosong
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
require __DIR__ . '/vendor/autoload.php';

$pathsConfig = APPPATH . 'Config/Paths.php';
require realpath($pathsConfig) ?: $pathsConfig;

$paths = new Config\Paths();
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = require realpath($bootstrap) ?: $bootstrap;

$db = \Config\Database::connect();

// Update semua FAQ dengan kategori kosong ke 'nutrisi'
$result = $db->query("UPDATE faqs SET category = 'nutrisi' WHERE category = '' OR category IS NULL");

echo "FAQ categories updated successfully!\n";
echo "Affected rows: " . $db->affectedRows() . "\n";
