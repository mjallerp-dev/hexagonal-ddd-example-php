<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';

interface UpdateArticlePort
{
    public function update(ArticleModel $article): ArticleModel;
}
