<?php

class InvalidUserNameException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The user name must not be empty.');
    }

    public static function becauseLengthIsTooShort($minLength)
    {
        return new self('The user name must contain at least ' . $minLength . ' characters.');
    }
}

