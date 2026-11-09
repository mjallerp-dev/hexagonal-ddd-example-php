<?php

class InvalidArticleIvaException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article IVA must not be empty.');
    }

    public static function becauseMustBeGreaterThanOrEqualToZero()
    {
        return new self('The article IVA must be greater than or equal to zero.');
    }

    public static function becauseMustBeLessThanOrEqualToOneHundred()
    {
        return new self('The article IVA must be less than or equal to one hundred.');
    }
}
