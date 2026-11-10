<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de artículo</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<table class="detail-table">
    <tr>
        <th>ID</th>
        <td class="col-id"><?= htmlspecialchars($article->getId(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Descripción</th>
        <td><?= htmlspecialchars($article->getDescription(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Proveedor</th>
        <td><?= htmlspecialchars($article->getProvider(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Marca</th>
        <td><?= htmlspecialchars($article->getBrand(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Modelo</th>
        <td><?= htmlspecialchars($article->getModel(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Categoría</th>
        <td><?= htmlspecialchars(ucfirst($article->getCategory()), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Tienda</th>
        <td><?= htmlspecialchars($article->getStore(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Cantidad</th>
        <td><?= $article->getQuantity() ?></td>
    </tr>
    <tr>
        <th>Precio de compra</th>
        <td>$&nbsp;<?= number_format($article->getPurchasePrice(), 2, ',', '.') ?></td>
    </tr>
    <tr>
        <th>Precio de venta</th>
        <td>$&nbsp;<?= number_format($article->getSalePrice(), 2, ',', '.') ?></td>
    </tr>
    <tr>
        <th>IVA</th>
        <td><?= number_format($article->getIva(), 2, ',', '.') ?>&nbsp;%</td>
    </tr>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning" href="?route=articles.edit&amp;id=<?= urlencode($article->getId()) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=articles.index">Volver al listado</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
