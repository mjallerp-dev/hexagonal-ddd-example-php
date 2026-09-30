<?php

class ArticleProvider
{
    private $value;

    public function __construct(string $value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '')
        {
            throw InvalidArticleProviderException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < 3)
        {
            throw InvalidArticleProviderException::becauseLengthIsTooShort(3);
        }
    }

    public function value()
    {
        return $this->value;
    }

    public function equals(ArticleProvider $other)
    {
        return $this->value === $other->value();
    }

    public function __toString()
    {
        return $this->value;
    }
}