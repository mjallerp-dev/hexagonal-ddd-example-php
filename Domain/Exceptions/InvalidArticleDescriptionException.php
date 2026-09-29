<?php

class InvalidArticleDescriptionException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article description must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The article description must contain at least ' . $minLength . ' characters.');
    }
}
