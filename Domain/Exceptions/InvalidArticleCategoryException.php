<?php

class InvalidArticleCategoryException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article category must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The article category must contain at least ' . $minLength . ' characters.');
    }
}
