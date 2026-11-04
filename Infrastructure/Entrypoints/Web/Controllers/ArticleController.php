<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/ArticleWebMapper.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreateArticleUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateArticleUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetArticleByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllArticlesUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteArticleUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllArticlesQuery.php';

final class ArticleController
{
    private CreateArticleUseCase $createArticleUseCase;
    private UpdateArticleUseCase $updateArticleUseCase;
    private GetArticleByIdUseCase $getArticleByIdUseCase;
    private GetAllArticlesUseCase $getAllArticlesUseCase;
    private DeleteArticleUseCase $deleteArticleUseCase;
    private ArticleWebMapper $mapper;

    public function __construct(
        CreateArticleUseCase $createArticleUseCase,
        UpdateArticleUseCase $updateArticleUseCase,
        GetArticleByIdUseCase $getArticleByIdUseCase,
        GetAllArticlesUseCase $getAllArticlesUseCase,
        DeleteArticleUseCase $deleteArticleUseCase,
        ArticleWebMapper $mapper
    ) {
        $this->createArticleUseCase = $createArticleUseCase;
        $this->updateArticleUseCase = $updateArticleUseCase;
        $this->getArticleByIdUseCase = $getArticleByIdUseCase;
        $this->getAllArticlesUseCase = $getAllArticlesUseCase;
        $this->deleteArticleUseCase = $deleteArticleUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return ArticleResponse[]
     */
    public function index(): array
    {
        $articles = $this->getAllArticlesUseCase->execute(new GetAllArticlesQuery());

        return $this->mapper->fromModelsToResponses($articles);
    }

    public function show(string $id): ArticleResponse
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $article = $this->getArticleByIdUseCase->execute($query);

        return $this->mapper->fromModelToResponse($article);
    }

    public function store(CreateArticleWebRequest $request): ArticleResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $article = $this->createArticleUseCase->execute($command);

        return $this->mapper->fromModelToResponse($article);
    }

    public function update(UpdateArticleWebRequest $request): ArticleResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $article = $this->updateArticleUseCase->execute($command);

        return $this->mapper->fromModelToResponse($article);
    }

    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteArticleUseCase->execute($command);
    }
}
