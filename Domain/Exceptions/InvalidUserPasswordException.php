<?php

class InvalidUserPasswordException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The user password must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The user password must contain at least ' . $minLength . ' characters.');
    }
}

