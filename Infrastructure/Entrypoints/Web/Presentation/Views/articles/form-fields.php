<?php
/**
 * Campos compartidos por los formularios de crear y editar artículos.
 * Los límites coinciden con validateArticleForm() en public/index.php.
 *
 * @var array<string, string> $values
 * @var array<string, string> $errors
 * @var string[] $categoryOptions
 */

$fields = array(
    'description' => array('Descripción', 'text', 'maxlength="255"'),
    'provider' => array('Proveedor', 'text', 'maxlength="100"'),
    'brand' => array('Marca', 'text', 'maxlength="100"'),
    'model' => array('Modelo', 'text', 'maxlength="100"'),
    'category' => array('Categoría', 'select', ''),
    'store' => array('Tienda', 'text', 'maxlength="100"'),
    'quantity' => array('Cantidad', 'number', 'min="0" step="1"'),
    'purchase_price' => array('Precio de compra', 'number', 'min="0.01" step="0.01"'),
    'sale_price' => array('Precio de venta', 'number', 'min="0.01" step="0.01"'),
    'iva' => array('IVA (%)', 'number', 'min="0" max="100" step="0.01"'),
);
?>

<?php foreach ($fields as $field => [$label, $type, $attributes]): ?>
    <div class="form-group">
        <label for="<?= $field ?>"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></label><br>

        <?php if ($type === 'select'): ?>
            <select id="<?= $field ?>" name="<?= $field ?>">
                <option value="">Selecciona una categoría</option>
                <?php foreach ($categoryOptions as $opt): ?>
                    <option value="<?= htmlspecialchars($opt, ENT_QUOTES, 'UTF-8') ?>" <?= (($values[$field] ?? '') === $opt) ? 'selected' : '' ?>>
                        <?= htmlspecialchars(ucfirst($opt), ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php else: ?>
            <input type="<?= $type ?>" id="<?= $field ?>" name="<?= $field ?>" <?= $attributes ?>
                value="<?= htmlspecialchars((string) ($values[$field] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
        <?php endif; ?>

        <?php if (!empty($errors[$field])): ?>
            <div class="field-error"><?= htmlspecialchars($errors[$field], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
