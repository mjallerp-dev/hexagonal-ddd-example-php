<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleId.php';

interface GetArticleByIdPort
{
    public function getById(ArticleId $articleId): ?ArticleModel;
}
