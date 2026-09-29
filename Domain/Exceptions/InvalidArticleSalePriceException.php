<?php

class InvalidArticleSalePriceException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article sale price must not be empty.');
    }

    public static function becauseMustBeGreaterThanZero()
    {
        return new self('The article sale price must be greater than zero.');
    }
}
