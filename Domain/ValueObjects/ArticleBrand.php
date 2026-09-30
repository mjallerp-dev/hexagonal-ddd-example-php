<?php

class ArticleBrand
{
    private $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '')
        {
            throw InvalidArticleBrandException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < 3)
        {
            throw InvalidArticleBrandException::becauseLengthIsTooShort(3);
        }
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