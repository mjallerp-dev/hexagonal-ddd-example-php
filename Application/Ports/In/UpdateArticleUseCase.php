<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/UpdateArticleCommand.php';
require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';

interface UpdateArticleUseCase
{
    public function execute(UpdateArticleCommand $command): ArticleModel;
}