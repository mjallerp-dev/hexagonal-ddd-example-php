<?php

require_once __DIR__ . '/../Exceptions/InvalidArticlePurchasePriceException.php';

class ArticlePurchasePrice
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidArticlePurchasePriceException::becauseValueIsEmpty();
        }

        if ((float) $normalizedValue <= 0) {
            throw InvalidArticlePurchasePriceException::becauseMustBeGreaterThanZero();
        }

        $this->value = (float) $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(ArticlePurchasePrice $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
