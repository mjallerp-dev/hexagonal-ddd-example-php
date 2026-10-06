<?php

class ArticleAlreadyExistsException extends DomainException
{
    public static function becauseIdAlreadyExists($id)
    {
        return new self('An article with id ' . $id . ' already exists.');
    }
}
