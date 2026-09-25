<?php

class InvalidUserStatusException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid($status)
    {
        return new self('The user status is invalid: ' . $status);
    }
}

