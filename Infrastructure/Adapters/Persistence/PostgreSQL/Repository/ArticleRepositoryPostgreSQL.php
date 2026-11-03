<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveArticlePort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateArticlePort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetArticleByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllArticlesPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteArticlePort.php';

require_once __DIR__ . '/../Mapper/ArticlePersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/ArticleModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/ArticleId.php';

final class ArticleRepositoryPostgreSQL implements
    SaveArticlePort,
    UpdateArticlePort,
    GetArticleByIdPort,
    GetAllArticlesPort,
    DeleteArticlePort
{
    private PDO $pdo;
    private ArticlePersistenceMapper $mapper;

    public function __construct(PDO $pdo, ArticlePersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(ArticleModel $article): ArticleModel
    {
        $dto = $this->mapper->fromModelToDto($article);

        $sql = '
            INSERT INTO articles (
                id,
                description,
                provider,
                brand,
                model,
                category,
                store,
                quantity,
                purchase_price,
                sale_price,
                iva,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :description,
                :provider,
                :brand,
                :model,
                :category,
                :store,
                :quantity,
                :purchase_price,
                :sale_price,
                :iva,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':description' => $dto->description(),
            ':provider' => $dto->provider(),
            ':brand' => $dto->brand(),
            ':model' => $dto->model(),
            ':category' => $dto->category(),
            ':store' => $dto->store(),
            ':quantity' => $dto->quantity(),
            ':purchase_price' => $dto->purchasePrice(),
            ':sale_price' => $dto->salePrice(),
            ':iva' => $dto->iva(),
        ));

        $savedArticle = $this->getById(new ArticleId($dto->id()));

        if ($savedArticle === null) {
            throw new RuntimeException('The article could not be recovered after save.');
        }

        return $savedArticle;
    }

    public function update(ArticleModel $article): ArticleModel
    {
        $dto = $this->mapper->fromModelToDto($article);

        $sql = '
            UPDATE articles
               SET description = :description,
                   provider = :provider,
                   brand = :brand,
                   model = :model,
                   category = :category,
                   store = :store,
                   quantity = :quantity,
                   purchase_price = :purchase_price,
                   sale_price = :sale_price,
                   iva = :iva,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $dto->id(),
            ':description' => $dto->description(),
            ':provider' => $dto->provider(),
            ':brand' => $dto->brand(),
            ':model' => $dto->model(),
            ':category' => $dto->category(),
            ':store' => $dto->store(),
            ':quantity' => $dto->quantity(),
            ':purchase_price' => $dto->purchasePrice(),
            ':sale_price' => $dto->salePrice(),
            ':iva' => $dto->iva(),
        ));

        $updatedArticle = $this->getById(new ArticleId($dto->id()));

        if ($updatedArticle === null) {
            throw new RuntimeException('The article could not be recovered after update.');
        }

        return $updatedArticle;
    }

    public function getById(ArticleId $articleId): ?ArticleModel
    {
        $sql = '
            SELECT
                id,
                description,
                provider,
                brand,
                model,
                category,
                store,
                quantity,
                purchase_price,
                sale_price,
                iva,
                created_at,
                updated_at
            FROM articles
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $articleId->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return ArticleModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                description,
                provider,
                brand,
                model,
                category,
                store,
                quantity,
                purchase_price,
                sale_price,
                iva,
                created_at,
                updated_at
            FROM articles
            ORDER BY description ASC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(ArticleId $articleId): void
    {
        $sql = 'DELETE FROM articles WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $articleId->value(),
        ));
    }
}
