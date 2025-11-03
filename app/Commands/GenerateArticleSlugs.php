<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\ArticleModel;

class GenerateArticleSlugs extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'articles:generate-slugs';
    protected $description = 'Generate slugs for existing articles';

    public function run(array $params)
    {
        $articleModel = new ArticleModel();
        $articles = $articleModel->findAll();

        CLI::write('Generating slugs for ' . count($articles) . ' articles...', 'yellow');

        $updated = 0;
        foreach ($articles as $article) {
            if (empty($article['slug'])) {
                $slug = $articleModel->generateSlug($article['title'], $article['id']);
                $seoTitle = $article['title'];
                $metaDesc = substr(strip_tags($article['content']), 0, 160);

                $articleModel->update($article['id'], [
                    'slug' => $slug,
                    'seo_title' => $seoTitle,
                    'meta_description' => $metaDesc
                ]);

                CLI::write("✓ Article #{$article['id']}: {$article['title']} → {$slug}", 'green');
                $updated++;
            }
        }

        CLI::write("\nDone! Updated {$updated} articles.", 'green');
    }
}
