<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Editar artículo</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php
// Tras un error se muestran los datos enviados; si no, los guardados.
$values = !empty($old) ? $old : array(
    'id' => $article->getId(),
    'description' => $article->getDescription(),
    'provider' => $article->getProvider(),
    'brand' => $article->getBrand(),
    'model' => $article->getModel(),
    'category' => $article->getCategory(),
    'store' => $article->getStore(),
    'quantity' => (string) $article->getQuantity(),
    'purchase_price' => number_format($article->getPurchasePrice(), 2, '.', ''),
    'sale_price' => number_format($article->getSalePrice(), 2, '.', ''),
    'iva' => number_format($article->getIva(), 2, '.', ''),
);
?>

<form method="POST" action="?route=articles.update">
    <input type="hidden" name="id" value="<?= htmlspecialchars($values['id'] ?? $article->getId(), ENT_QUOTES, 'UTF-8') ?>">

    <?php require __DIR__ . '/form-fields.php'; ?>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    &nbsp;
    <a class="btn" href="?route=articles.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
