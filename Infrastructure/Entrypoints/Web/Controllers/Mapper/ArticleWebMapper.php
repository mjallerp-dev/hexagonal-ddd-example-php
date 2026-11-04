<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateArticleRequest.php';
require_once __DIR__ . '/../Dto/UpdateArticleRequest.php';
require_once __DIR__ . '/../Dto/ArticleResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateArticleCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateArticleCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteArticleCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetArticleByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/ArticleModel.php';

final class ArticleWebMapper
{
    public function fromCreateRequestToCommand(CreateArticleWebRequest $request): CreateArticleCommand
    {
        return new CreateArticleCommand(
            $request->getId(),
            $request->getDescription(),
            $request->getProvider(),
            $request->getBrand(),
            $request->getModel(),
            $request->getCategory(),
            $request->getStore(),
            $request->getQuantity(),
            $request->getPurchasePrice(),
            $request->getSalePrice(),
            $request->getIva()
        );
    }

    public function fromUpdateRequestToCommand(UpdateArticleWebRequest $request): UpdateArticleCommand
    {
        return new UpdateArticleCommand(
            $request->getId(),
            $request->getDescription(),
            $request->getProvider(),
            $request->getBrand(),
            $request->getModel(),
            $request->getCategory(),
            $request->getStore(),
            $request->getQuantity(),
            $request->getPurchasePrice(),
            $request->getSalePrice(),
            $request->getIva()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetArticleByIdQuery
    {
        return new GetArticleByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteArticleCommand
    {
        return new DeleteArticleCommand($id);
    }

    public function fromModelToResponse(ArticleModel $article): ArticleResponse
    {
        return new ArticleResponse(
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

    /**
     * @param ArticleModel[] $articles
     * @return ArticleResponse[]
     */
    public function fromModelsToResponses(array $articles): array
    {
        $responses = array();

        foreach ($articles as $article) {
            $responses[] = $this->fromModelToResponse($article);
        }

        return $responses;
    }
}
