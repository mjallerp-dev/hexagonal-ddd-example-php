<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateArticleUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateArticlePort.php';
require_once __DIR__ . '/../Ports/Out/GetArticleByIdPort.php';
require_once __DIR__ . '/Mappers/ArticleApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/ArticleNotFoundException.php';
require_once __DIR__ . '/../../Domain/Models/ArticleModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/ArticleId.php';

final class UpdateArticleService implements UpdateArticleUseCase
{
    private UpdateArticlePort $updateArticlePort;
    private GetArticleByIdPort $getArticleByIdPort;

    public function __construct(
        UpdateArticlePort $updateArticlePort,
        GetArticleByIdPort $getArticleByIdPort
    ) {
        $this->updateArticlePort = $updateArticlePort;
        $this->getArticleByIdPort = $getArticleByIdPort;
    }

    public function execute(UpdateArticleCommand $command): ArticleModel
    {
        $articleId = new ArticleId($command->getId());
        $currentArticle = $this->getArticleByIdPort->getById($articleId);

        if ($currentArticle === null) {
            throw ArticleNotFoundException::becauseIdWasNotFound($articleId->value());
        }

        $articleToUpdate = new ArticleModel(
            $articleId,
            new ArticleDescription($command->getDescription()),
            new ArticleProvider($command->getProvider()),
            new ArticleBrand($command->getBrand()),
            new ArticleModelo($command->getModel()),
            $command->getCategory(),
            new ArticleStore($command->getStore()),
            new ArticleQuantity($command->getQuantity()),
            new ArticlePurchasePrice($command->getPurchasePrice()),
            new ArticleSalePrice($command->getSalePrice()),
            new ArticleIva($command->getIva())
        );

        $updatedArticle = $this->updateArticlePort->update($articleToUpdate);

        return $updatedArticle;
    }
}