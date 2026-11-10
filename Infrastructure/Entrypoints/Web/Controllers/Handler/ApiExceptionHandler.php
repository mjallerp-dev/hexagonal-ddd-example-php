<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Domain/Exceptions/ArticleNotFoundException.php';
require_once __DIR__ . '/../../../../../Domain/Exceptions/ArticleAlreadyExistsException.php';

final class ApiExceptionHandler
{
    /**
     * @return array{status: int, message: string}
     */
    public function handle(Throwable $exception): array
    {
        if ($exception instanceof JsonException) {
            return array('status' => 400, 'message' => 'El cuerpo de la petición debe ser un JSON válido.');
        }

        if ($exception instanceof ArticleNotFoundException) {
            return array('status' => 404, 'message' => $exception->getMessage());
        }

        if ($exception instanceof ArticleAlreadyExistsException) {
            return array('status' => 409, 'message' => $exception->getMessage());
        }

        if ($exception instanceof InvalidArgumentException) {
            return array('status' => 422, 'message' => $exception->getMessage());
        }

        error_log(sprintf(
            '[API] %s: %s en %s:%d',
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        ));

        return array('status' => 500, 'message' => 'Error interno del servidor.');
    }
}
