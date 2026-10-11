<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateArticleUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveArticlePort.php';
require_once __DIR__ . '/../Ports/Out/GetArticleByIdPort.php';
require_once __DIR__ . '/Mappers/ArticleApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/ArticleAlreadyExistsException.php';
require_once __DIR__ . '/../../Domain/Models/ArticleModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/ArticleId.php';

final class CreateArticleService implements CreateArticleUseCase
{
    private SaveArticlePort $saveArticlePort;
    private GetArticleByIdPort $getArticleByIdPort;

    public function __construct(
        SaveArticlePort $saveArticlePort,
        GetArticleByIdPort $getArticleByIdPort
    ) {
        $this->saveArticlePort = $saveArticlePort;
        $this->getArticleByIdPort = $getArticleByIdPort;
    }

    public function execute(CreateArticleCommand $command): ArticleModel
    {
        $articleId = new ArticleId($command->getId());
        $existingArticle = $this->getArticleByIdPort->getById($articleId);

        if ($existingArticle !== null) {
            throw ArticleAlreadyExistsException::becauseIdAlreadyExists($articleId->value());
        }

        $article = ArticleApplicationMapper::fromCreateCommandToModel($command);

        $savedArticle = $this->saveArticlePort->save($article);

        return $savedArticle;
    }
}