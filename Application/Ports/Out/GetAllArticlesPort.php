<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';

interface GetAllArticlesPort
{
    /**
     * @return ArticleModel[]
     */
    public function getAll(): array;
}
