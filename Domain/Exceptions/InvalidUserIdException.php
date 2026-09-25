<?php

class InvalidUserIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty()
    {
        return new self('The user id must not be empty.');
    }
}