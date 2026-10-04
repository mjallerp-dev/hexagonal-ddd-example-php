<?php

class InvalidArticleModeloException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article model must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The article model must contain at least ' . $minLength . ' characters.');
    }
}
