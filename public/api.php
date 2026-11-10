<?php

declare(strict_types=1);

require_once __DIR__ . '/../Common/ClassLoader.php';
require_once __DIR__ . '/../Common/DependencyInjection.php';

DependencyInjection::boot();

$errorHandler = DependencyInjection::getApiExceptionHandler();

try {
    $method = strtoupper((string) ($_SERVER['REQUEST_METHOD'] ?? 'GET'));
    [$basePath, $path] = resolveApiPath((string) ($_SERVER['REQUEST_URI'] ?? '/'));

    if ($path === '/articles') {
        $id = null;
        $allowedMethods = array('GET', 'POST');
    } elseif (preg_match('#^/articles/([^/]+)$#', $path, $matches)) {
        $id = rawurldecode($matches[1]);
        $allowedMethods = array('GET', 'PUT', 'DELETE');
    } else {
        JsonView::error(404, 'Ruta no encontrada.');
        exit;
    }

    if (!in_array($method, $allowedMethods, true)) {
        JsonView::error(405, 'Método HTTP no permitido.', array(), array('Allow' => implode(', ', $allowedMethods)));
        exit;
    }

    requireApiKey();

    $controller = DependencyInjection::getArticleController();

    if ($id === null && $method === 'GET') {
        JsonView::send(200, array('data' => array_map('articleToJson', $controller->index())));
    } elseif ($id === null && $method === 'POST') {
        $form = readArticleBody();
        $article = $controller->store(new CreateArticleWebRequest(
            generateUuid4(),
            $form['description'],
            $form['provider'],
            $form['brand'],
            $form['model'],
            $form['category'],
            $form['store'],
            (int) $form['quantity'],
            (float) $form['purchase_price'],
            (float) $form['sale_price'],
            (float) $form['iva']
        ));
        JsonView::send(
            201,
            array('data' => articleToJson($article)),
            array('Location' => $basePath . '/articles/' . rawurlencode($article->getId()))
        );
    } elseif ($method === 'GET') {
        JsonView::send(200, array('data' => articleToJson($controller->show($id))));
    } elseif ($method === 'PUT') {
        $form = readArticleBody();
        $article = $controller->update(new UpdateArticleWebRequest(
            $id,
            $form['description'],
            $form['provider'],
            $form['brand'],
            $form['model'],
            $form['category'],
            $form['store'],
            (int) $form['quantity'],
            (float) $form['purchase_price'],
            (float) $form['sale_price'],
            (float) $form['iva']
        ));
        JsonView::send(200, array('data' => articleToJson($article)));
    } else {
        $controller->delete($id);
        JsonView::send(204);
    }
} catch (Throwable $exception) {
    $error = $errorHandler->handle($exception);
    JsonView::error($error['status'], $error['message']);
}

/**
 * @return array{0: string, 1: string}
 */
function resolveApiPath(string $requestUri): array
{
    $uriPath = (string) parse_url($requestUri, PHP_URL_PATH);

    if (!preg_match('#^(.*?/api(?:\.php)?)(/.*)?$#', $uriPath, $matches)) {
        return array('', '/');
    }

    $path = rtrim($matches[2] ?? '', '/');

    return array($matches[1], $path === '' ? '/' : $path);
}

function requireApiKey(): void
{
    $expected = EnvLoader::get('API_KEY');

    if ($expected === '') {
        JsonView::error(503, 'La API no está configurada: falta la variable API_KEY.');
        exit;
    }

    $given = (string) ($_SERVER['HTTP_X_API_KEY'] ?? '');

    if (!hash_equals($expected, $given)) {
        JsonView::error(401, 'API key inválida o ausente. Envíala en la cabecera X-API-Key.');
        exit;
    }
}

/**
 * @return array<string, string>
 */
function readArticleBody(): array
{
    $payload = json_decode((string) file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);

    if (!is_array($payload) || ($payload !== array() && array_is_list($payload))) {
        JsonView::error(400, 'El cuerpo de la petición debe ser un objeto JSON.');
        exit;
    }

    [$form, $typeErrors] = ArticleRequestValidator::fromJson($payload);
    $errors = array_merge(ArticleRequestValidator::validate($form), $typeErrors);

    if ($errors !== array()) {
        JsonView::error(422, 'Los datos del artículo no son válidos.', $errors);
        exit;
    }

    return $form;
}

/**
 * @return array<string, string|int|float>
 */
function articleToJson(ArticleResponse $article): array
{
    return array(
        'id' => $article->getId(),
        'description' => $article->getDescription(),
        'provider' => $article->getProvider(),
        'brand' => $article->getBrand(),
        'model' => $article->getModel(),
        'category' => $article->getCategory(),
        'store' => $article->getStore(),
        'quantity' => $article->getQuantity(),
        'purchase_price' => $article->getPurchasePrice(),
        'sale_price' => $article->getSalePrice(),
        'iva' => $article->getIva(),
    );
}

function generateUuid4(): string
{
    $data = random_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
