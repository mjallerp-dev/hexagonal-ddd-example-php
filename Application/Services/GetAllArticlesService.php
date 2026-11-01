<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllArticlesUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllArticlesPort.php';

final class GetAllArticlesService implements GetAllArticlesUseCase
{
    private GetAllArticlesPort $getAllArticlesPort;

    public function __construct(GetAllArticlesPort $getAllArticlesPort)
    {
        $this->getAllArticlesPort = $getAllArticlesPort;
    }

    /**
     * @return ArticleModel[]
     */
    public function execute(GetAllArticlesQuery $query): array
    {
        return $this->getAllArticlesPort->getAll();
    }
}
