<?php

require_once __DIR__ . '/../Exceptions/InvalidArticleCategoryException.php';

class ArticleCategoryEnum
{
    const ELECTRONICA = 'electronica';
    const ROPA = 'ropa';
    const CALZADO = 'calzado';
    const ALIMENTOS = 'alimentos';
    const BEBIDAS = 'bebidas';
    const HOGAR = 'hogar';
    const BELLEZA = 'belleza';
    const DEPORTES = 'deportes';
    const PAPELERIA = 'papeleria';
    const FERRETERIA = 'ferreteria';
    const OTROS = 'otros';

    public static function values()
    {
        return array(
            self::ELECTRONICA,
            self::ROPA,
            self::CALZADO,
            self::ALIMENTOS,
            self::BEBIDAS,
            self::HOGAR,
            self::BELLEZA,
            self::DEPORTES,
            self::PAPELERIA,
            self::FERRETERIA,
            self::OTROS
        );
    }

    public static function isValid($value)
    {
        return in_array($value, self::values(), strict: true);
    }

    public static function ensureIsValid($value)
    {
        if (!self::isValid($value)) {
            throw InvalidArticleCategoryException::becauseValueIsInvalid($value);
        }
    }
}
