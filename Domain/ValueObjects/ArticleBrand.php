<?php

require_once __DIR__ . '/../Exceptions/InvalidArticleBrandException.php';

class ArticleBrand
{
    private $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidArticleBrandException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < 3) {
            throw InvalidArticleBrandException::becauseLengthIsTooShort(3);
        }

        $this->value = $normalizedValue;
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(ArticleBrand $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}
