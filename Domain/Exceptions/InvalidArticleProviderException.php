<?php

class InvalidArticleProviderException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article provider must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The article provider must contain at least ' . $minLength . ' characters.');
    }
}