<?php

class InvalidArticlePurchasePriceException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article purchase price must not be empty.');
    }

    public static function becauseMustBeGreaterThanZero()
    {
        return new self('The article purchase price must be greater than zero.');
    }
}
