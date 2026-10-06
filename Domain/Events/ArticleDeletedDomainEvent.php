<?php

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../ValueObjects/ArticleId.php';

class ArticleDeletedDomainEvent extends DomainEvent
{
    private $articleId;

    public function __construct(ArticleId $articleId)
    {
        parent::__construct('article.deleted');
        $this->articleId = $articleId;
    }

    public function articleId()
    {
        return $this->articleId;
    }

    public function payload()
    {
        return array(
            'id' => $this->articleId->value()
        );
    }
}