<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR);
require __DIR__ . '/vendor/autoload.php';

$pathsConfig = new \Config\Paths();
$bootstrap = rtrim($pathsConfig->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
require $bootstrap;

$app = \Config\Services::codeigniter();
$app->initialize();

$db = \Config\Database::connect();

// Copy posts to articles
$posts = $db->table('posts')->get()->getResultArray();
echo "Found " . count($posts) . " posts\n";

foreach ($posts as $p) {
    $db->table('articles')->insert([
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

// Move images
if (!file_exists('public/uploads/articles')) {
    mkdir('public/uploads/articles', 0777, true);
}

$files = glob('public/uploads/posts/*');
foreach ($files as $file) {
    $filename = basename($file);
    copy($file, 'public/uploads/articles/' . $filename);
}

echo "Copied " . count($files) . " images\n";
echo "Done!\n";
