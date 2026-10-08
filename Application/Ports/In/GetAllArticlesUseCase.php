<?php

declare(strict_types=1);
require_once __DIR__ . '/../../Services/Dto/Queries/GetAllArticlesQuery.php';
require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';

interface GetAllArticlesUseCase
{
    /**
     * @return ArticleModel[]
     */
    public function execute(GetAllArticlesQuery $query): array;
}