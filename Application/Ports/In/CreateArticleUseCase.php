<?php

declare(strict_types=1);
require_once __DIR__ . '/../../Services/Dto/Commands/CreateArticleCommand.php';
require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';

interface CreateArticleUseCase
{
    public function execute(CreateArticleCommand $command): ArticleModel;
}