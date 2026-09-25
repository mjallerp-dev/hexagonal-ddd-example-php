<?php

declare(strict_types=1);

final class EmailSenderException extends \RuntimeException
{
    public function __construct(
        string $message = 'La notificación por correo no pudo ser enviada.',
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
