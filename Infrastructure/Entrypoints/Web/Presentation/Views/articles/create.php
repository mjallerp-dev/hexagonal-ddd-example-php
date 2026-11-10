<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Registrar artículo</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<form method="POST" action="?route=articles.store">
    <?php $values = $old; ?>
    <?php require __DIR__ . '/form-fields.php'; ?>

    <button type="submit" class="btn btn-primary">Registrar artículo</button>
    &nbsp;
    <a class="btn" href="?route=articles.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
