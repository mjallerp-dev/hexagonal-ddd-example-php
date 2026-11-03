<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/ArticlePersistenceDto.php';
require_once __DIR__ . '/../Entity/ArticleEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/ArticleModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleDescription.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleProvider.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleBrand.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleModelo.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleStore.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleQuantity.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticlePurchasePrice.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleSalePrice.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleIva.php';

final class ArticlePersistenceMapper
{
    public function fromModelToDto(ArticleModel $article): ArticlePersistenceDto
    {
        return new ArticlePersistenceDto(
            $article->id()->value(),
            $article->description()->value(),
            $article->provider()->value(),
            $article->brand()->value(),
            $article->model()->value(),
            $article->category(),
            $article->store()->value(),
            $article->quantity()->value(),
            $article->purchasePrice()->value(),
            $article->salePrice()->value(),
            $article->iva()->value()
        );
    }

    public function fromDtoToEntity(ArticlePersistenceDto $dto): ArticleEntity
    {
        return new ArticleEntity(
            $dto->id(),
            $dto->description(),
            $dto->provider(),
            $dto->brand(),
            $dto->model(),
            $dto->category(),
            $dto->store(),
            $dto->quantity(),
            $dto->purchasePrice(),
            $dto->salePrice(),
            $dto->iva()
        );
    }

    public function fromRowToEntity(array $row): ArticleEntity
    {
        return new ArticleEntity(
            (string) $row['id'],
            (string) $row['description'],
            (string) $row['provider'],
            (string) $row['brand'],
            (string) $row['model'],
            (string) $row['category'],
            (string) $row['store'],
            (int) $row['quantity'],
            (float) $row['purchase_price'],
            (float) $row['sale_price'],
            (float) $row['iva'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(ArticleEntity $entity): ArticleModel
    {
        return new ArticleModel(
            new ArticleId($entity->id()),
            new ArticleDescription($entity->description()),
            new ArticleProvider($entity->provider()),
            new ArticleBrand($entity->brand()),
            new ArticleModelo($entity->model()),
            $entity->category(),
            new ArticleStore($entity->store()),
            new ArticleQuantity($entity->quantity()),
            new ArticlePurchasePrice($entity->purchasePrice()),
            new ArticleSalePrice($entity->salePrice()),
            new ArticleIva($entity->iva())
        );
    }

    public function fromRowToModel(array $row): ArticleModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return ArticleModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}
