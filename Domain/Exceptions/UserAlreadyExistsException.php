<?php

class UserAlreadyExistsException extends DomainException
{
    public static function becauseEmailAlreadyExists($email)
    {
        return new self('A user with email ' . $email . ' already exists.');
    }
}

