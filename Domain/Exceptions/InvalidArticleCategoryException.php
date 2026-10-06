<?php

class InvalidArticleCategoryException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid($category)
    {
        return new self('The article category is invalid: ' . $category);
    }
}
