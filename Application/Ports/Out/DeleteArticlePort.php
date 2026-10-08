<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleId.php';

interface DeleteArticlePort
{
    public function delete(ArticleId $articleId): void;
}
