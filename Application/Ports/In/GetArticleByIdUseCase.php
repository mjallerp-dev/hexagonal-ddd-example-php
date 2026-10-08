<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetArticleByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';

interface GetArticleByIdUseCase
{
    public function execute(GetArticleByIdQuery $query): ArticleModel;
}