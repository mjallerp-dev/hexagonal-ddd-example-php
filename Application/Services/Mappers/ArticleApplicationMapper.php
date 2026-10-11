<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/ArticleModel.php';
require_once __DIR__ . '/../../../Application/Services/Dto/Commasnds/CreateArticleCommand.php';
require_once __DIR__ . '/../../../Application/Services/Dto/Commasnds/UpdateArticleCommand.php';

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
     * @return array<string, string>
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
            'purchase_price' => $article->purchasePrice()->value(),
            'sale_price' => $article->salePrice()->value(),
            'iva' => $article->iva()->value()
        );
    }

    /**
     * @param ArticleModel[] $articles
     * @return array<int, array<string, string>>
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