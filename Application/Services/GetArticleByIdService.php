<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetArticleByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetArticleByIdPort.php';
require_once __DIR__ . '/Mappers/ArticleApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/ArticleNotFoundException.php';

final class GetArticleByIdService implements GetArticleByIdUseCase
{
    private GetArticleByIdPort $getArticleByIdPort;

    public function __construct(GetArticleByIdPort $getArticleByIdPort)
    {
        $this->getArticleByIdPort = $getArticleByIdPort;
    }

    public function execute(GetArticleByIdQuery $query): ArticleModel
    {
        $articleId = ArticleApplicationMapper::fromGetArticleByIdQueryToArticleId($query);
        $article = $this->getArticleByIdPort->getById($articleId);

        if ($article === null) {
            throw ArticleNotFoundException::becauseIdWasNotFound($articleId->value());
        }

        return $article;
    }
}
