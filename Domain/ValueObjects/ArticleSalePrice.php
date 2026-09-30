<?php

class ArticleSalePrice
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidArticleSalePriceException::becauseValueIsEmpty();
        }

        if ((float) $normalizedValue <= 0) {
            throw InvalidArticleSalePriceException::becauseMustBeGreaterThanZero();
        }

        $this->value = (float) $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(ArticleSalePrice $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}