<?php

class InvalidArticleStoreException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article store must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The article store must contain at least ' . $minLength . ' characters.');
    }
}
