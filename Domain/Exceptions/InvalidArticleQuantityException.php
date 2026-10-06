<?php

class InvalidArticleQuantityException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article quantity must not be empty.');
    }

    public static function becauseMustBeGreaterThanOrEqualToZero()
    {
        return new self('The article quantity must be greater than or equal to zero.');
    }
}
