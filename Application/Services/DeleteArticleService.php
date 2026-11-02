<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteArticleUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteArticlePort.php';
require_once __DIR__ . '/../Ports/Out/GetArticleByIdPort.php';
require_once __DIR__ . '/Mappers/ArticleApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/ArticleNotFoundException.php';

final class DeleteArticleService implements DeleteArticleUseCase
{
    private DeleteArticlePort $deleteArticlePort;
    private GetArticleByIdPort $getArticleByIdPort;

    public function __construct(
        DeleteArticlePort $deleteArticlePort,
        GetArticleByIdPort $getArticleByIdPort
    ) {
        $this->deleteArticlePort = $deleteArticlePort;
        $this->getArticleByIdPort = $getArticleByIdPort;
    }

    public function execute(DeleteArticleCommand $command): void
    {
        $articleId = ArticleApplicationMapper::fromDeleteCommandToArticleId($command);
        $existingArticle = $this->getArticleByIdPort->getById($articleId);

        if ($existingArticle === null) {
            throw ArticleNotFoundException::becauseIdWasNotFound($articleId->value());
        }

        $this->deleteArticlePort->delete($articleId);
    }
}
