<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';
require_once __DIR__ . '/../Dto/Commands/CreateArticleCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateArticleCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteArticleCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetArticleByIdQuery.php';

require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleDescription.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleProvider.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleBrand.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleModelo.php';
require_once __DIR__ . '/../../../Domain/Enums/ArticleCategoryEnum.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleStore.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleQuantity.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticlePurchasePrice.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleSalePrice.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/ArticleIva.php';

final class ArticleApplicationMapper
{
    public static function fromCreateCommandToModel(CreateArticleCommand $command): ArticleModel
    {
        return new ArticleModel(
            new ArticleId($command->getId()),
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
    }

    public static function fromUpdateCommandToModel(UpdateArticleCommand $command): ArticleModel
    {
        return new ArticleModel(
            new ArticleId($command->getId()),
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
    }

    public static function fromGetArticleByIdQueryToArticleId(GetArticleByIdQuery $query): ArticleId
    {
        return new ArticleId($query->getId());
    }

    public static function fromDeleteCommandToArticleId(DeleteArticleCommand $command): ArticleId
    {
        return new ArticleId($command->getId());
    }

    /**
     * @return array<string, string|int|float>
     */
    public static function fromModelToArray(ArticleModel $article): array
    {
        return array(
            'id' => $article->id()->value(),
            'description' => $article->description()->value(),
            'provider' => $article->provider()->value(),
            'brand' => $article->brand()->value(),
            'model' => $article->model()->value(),
            'category' => $article->category(),
            'store' => $article->store()->value(),
            'quantity' => $article->quantity()->value(),
            'purchasePrice' => $article->purchasePrice()->value(),
            'salePrice' => $article->salePrice()->value(),
            'iva' => $article->iva()->value()
        );
    }

    /**
     * @param ArticleModel[] $articles
     * @return array<int, array<string, string|int|float>>
     */
    public static function fromModelsToArray(array $articles): array
    {
        $result = array();

        foreach ($articles as $article) {
            $result[] = self::fromModelToArray($article);
        }

        return $result;
    }
}