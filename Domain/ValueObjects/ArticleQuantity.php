<?php

require_once __DIR__ . '/../Exceptions/InvalidArticleQuantityException.php';

class ArticleQuantity
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidArticleQuantityException::becauseValueIsEmpty();
        }

        if ((int) $normalizedValue < 0) {
            throw InvalidArticleQuantityException::becauseMustBeGreaterThanOrEqualToZero();
        }

        $this->value = (int) $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(ArticleQuantity $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
