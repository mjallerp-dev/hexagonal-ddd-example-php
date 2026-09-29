<?php

class InvalidArticleQuantityException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article quantity must not be empty.');
    }
}
