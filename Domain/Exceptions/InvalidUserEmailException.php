<?php

class InvalidUserEmailException extends InvalidArgumentException
{
    public static function becauseFormatIsInvalid($email)
    {
        return new self('The user email format is invalid: ' . $email);
    }

    public static function becauseValueIsEmpty()
    {
        return new self('The user email must not be empty.');
    }
}