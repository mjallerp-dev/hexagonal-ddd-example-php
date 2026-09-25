<?php

class InvalidUserRoleException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid($role)
    {
        return new self('The user role is invalid: ' . $role);
    }
}

