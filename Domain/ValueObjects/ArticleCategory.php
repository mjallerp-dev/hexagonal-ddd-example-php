<?php

require_once __DIR__ . '/../Exceptions/InvalidArticleCategoryException.php';

enum ArticleCategory: string
{
    case ELECTRONICA = 'electronica';
    case ROPA = 'ropa';
    case CALZADO = 'calzado';
    case ALIMENTOS = 'alimentos';
    case BEBIDAS = 'bebidas';
    case HOGAR = 'hogar';
    case BELLEZA = 'belleza';
    case DEPORTES = 'deportes';
    case PAPELERIA = 'papeleria';
    case FERRETERIA = 'ferreteria';
    case OTROS = 'otros';
}
