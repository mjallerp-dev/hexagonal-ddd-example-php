<?php

class ArticleNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound($id)
    {
        return new self('The article with id ' . $id . ' was not found.');
    }
}
