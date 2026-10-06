<?php

class InvalidArticleBrandException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The article brand must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The article brand must contain at least ' . $minLength . ' characters.');
    }
}