<?php

declare(strict_types=1);

final class Connection
{
    private string $host;
    private int $port;
    private string $database;
    private string $username;
    private string $password;

    public function __construct(
        string $host,
        int $port,
        string $database,
        string $username,
        string $password
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function createPdo(): PDO
    {
        $dsn = sprintf(
            'pgsql:host=%s;port=%d;dbname=%s',
            $this->host,
            $this->port,
            $this->database
        );

        $pdo = new PDO(
            $dsn,
            $this->username,
            $this->password,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            )
        );

        return $pdo;
    }
}
