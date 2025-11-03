-- Copy posts to articles
INSERT INTO articles (title, content, category, image, author_id, author_name, status, created_at, updated_at)
SELECT 
    title,
    body,
    CONCAT(UPPER(SUBSTRING(category, 1, 1)), SUBSTRING(category, 2)),
    image,
    user_id,
    user_name,
    'approved',
    created_at,
    updated_at
FROM posts
WHERE deleted_at IS NULL;

-- Show result
SELECT COUNT(*) as total_articles FROM articles;
