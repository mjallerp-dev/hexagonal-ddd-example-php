<?php

declare(strict_types=1);

final class JsonView
{
    /**
     * @param array<string, mixed>|null $body
     * @param array<string, string> $headers
     */
    public static function send(int $status, ?array $body = null, array $headers = array()): void
    {
        http_response_code($status);

        foreach ($headers as $name => $value) {
            header($name . ': ' . $value);
        }

        if ($status === 204 || $body === null) {
            return;
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(
            $body,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION | JSON_THROW_ON_ERROR
        );
    }

    /**
     * @param array<string, string> $details
     * @param array<string, string> $headers
     */
    public static function error(int $status, string $message, array $details = array(), array $headers = array()): void
    {
        $error = array('status' => $status, 'message' => $message);

        if ($details !== array()) {
            $error['details'] = $details;
        }

        self::send($status, array('error' => $error), $headers);
    }
}
