<?php

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../Models/ArticleModel.php';

class ArticleCreatedDomainEvent extends DomainEvent
{
    private $article;

    public function __construct(ArticleModel $article)
    {
        parent::__construct('article.created');
        $this->article = $article;
    }

    public function article()
    {
        return $this->article;
    }

    public function payload()
    {
        return array(
            'id' => $this->article->id()->value(),
            'description' => $this->article->description()->value(),
            'provider' => $this->article->provider()->value(),
            'brand' => $this->article->brand()->value(),
            'model' => $this->article->model()->value(),
            'category' => $this->article->category(),
            'store' => $this->article->store()->value(),
            'quantity' => $this->article->quantity()->value(),
            'purchasePrice' => $this->article->purchasePrice()->value(),
            'salePrice' => $this->article->salePrice()->value(),
            'iva' => $this->article->iva()->value()
        );
    }
}