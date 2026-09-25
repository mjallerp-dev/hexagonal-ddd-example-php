<?php

class UserNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound($id)
    {
        return new self('The user with id ' . $id . ' was not found.');
    }
}

