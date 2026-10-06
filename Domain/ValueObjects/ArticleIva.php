<?php

require_once __DIR__ . '/../Exceptions/InvalidArticleIvaException.php';

class ArticleIva
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidArticleIvaException::becauseValueIsEmpty();
        }

        if ((float) $normalizedValue < 0) {
            throw InvalidArticleIvaException::becauseMustBeGreaterThanOrEqualToZero();
        }

        $this->value = (float) $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(ArticleIva $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
