<?php

function quill_excerpt($text, $wordCount = 25) {
    $words = preg_split('/\s+/', strip_tags($text));
    return implode(' ', array_slice($words, 0, $wordCount)) . (count($words) > $wordCount ? '...' : '');
}
