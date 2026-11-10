<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Domain/Enums/ArticleCategoryEnum.php';

final class ArticleRequestValidator
{
    /** @var array<string, array{0: string, 1: int}> */
    private const TEXT_FIELDS = array(
        'description' => array('descripción', 255),
        'provider' => array('proveedor', 100),
        'brand' => array('marca', 100),
        'model' => array('modelo', 100),
        'store' => array('tienda', 100),
    );

    private const NUMERIC_FIELDS = array('quantity', 'purchase_price', 'sale_price', 'iva');

    /**
     * @param array<string, string> $form
     * @return array<string, string>
     */
    public static function validate(array $form): array
    {
        $errors = array();

        foreach (self::TEXT_FIELDS as $field => [$label, $maxLength]) {
            $value = $form[$field] ?? '';
            if ($value === '') {
                $errors[$field] = 'El campo ' . $label . ' es obligatorio.';
            } elseif (mb_strlen($value) > $maxLength) {
                $errors[$field] = 'El campo ' . $label . ' no puede superar ' . $maxLength . ' caracteres.';
            }
        }

        if (!ArticleCategoryEnum::isValid($form['category'] ?? '')) {
            $errors['category'] = 'Selecciona una categoría válida.';
        }

        $quantity = $form['quantity'] ?? '';
        if (!preg_match('/^\d{1,10}$/D', $quantity) || (int) $quantity > 2147483647) {
            $errors['quantity'] = 'La cantidad debe ser un número entero entre 0 y 2147483647.';
        }

        $priceFields = array(
            'purchase_price' => 'El precio de compra',
            'sale_price' => 'El precio de venta',
        );

        foreach ($priceFields as $field => $label) {
            $price = $form[$field] ?? '';
            if (!preg_match('/^\d{1,10}(\.\d{1,2})?$/D', $price) || (float) $price <= 0) {
                $errors[$field] = $label . ' debe ser mayor que 0, con punto decimal y máximo 2 decimales.';
            }
        }

        $iva = $form['iva'] ?? '';
        if (!preg_match('/^\d{1,3}(\.\d{1,2})?$/D', $iva) || (float) $iva > 100) {
            $errors['iva'] = 'El IVA debe estar entre 0 y 100, con punto decimal y máximo 2 decimales.';
        }

        return $errors;
    }

    /**
     * @param array<string, mixed> $payload
     * @return array{0: array<string, string>, 1: array<string, string>}
     */
    public static function fromJson(array $payload): array
    {
        $form = array();
        $errors = array();
        $fields = array_merge(array_keys(self::TEXT_FIELDS), array('category'), self::NUMERIC_FIELDS);

        foreach ($fields as $field) {
            $value = $payload[$field] ?? null;
            $isNumeric = in_array($field, self::NUMERIC_FIELDS, true);

            if ($value === null) {
                $form[$field] = '';
            } elseif (is_string($value)) {
                $form[$field] = trim($value);
            } elseif ($isNumeric && (is_int($value) || is_float($value))) {
                $form[$field] = (string) $value;
            } else {
                $form[$field] = '';
                $errors[$field] = $isNumeric ? 'Debe ser un número.' : 'Debe ser un texto.';
            }
        }

        return array($form, $errors);
    }
}
