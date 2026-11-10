<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de artículos</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (empty($articles)): ?>
    <p>No hay artículos registrados todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Categoría</th>
                <th>Tienda</th>
                <th>Cantidad</th>
                <th>Precio de venta</th>
                <th>IVA</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= htmlspecialchars($article->getDescription(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($article->getBrand(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($article->getModel(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars(ucfirst($article->getCategory()), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($article->getStore(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= $article->getQuantity() ?></td>
                    <td>$&nbsp;<?= number_format($article->getSalePrice(), 2, ',', '.') ?></td>
                    <td><?= number_format($article->getIva(), 2, ',', '.') ?>&nbsp;%</td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=articles.show&amp;id=<?= urlencode($article->getId()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=articles.edit&amp;id=<?= urlencode($article->getId()) ?>">Editar</a>
                        <form method="POST" action="?route=articles.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-type="artículo"
                            data-name="<?= htmlspecialchars($article->getDescription(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($article->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
