<?php

declare(strict_types=1);
require_once __DIR__ . '/../../Services/Dto/Commands/DeleteArticleCommand.php';
require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';

interface DeleteArticleUseCase
{
    public function execute(DeleteArticleCommand $command): void;
}