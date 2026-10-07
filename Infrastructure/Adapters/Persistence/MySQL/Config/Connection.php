<?php

declare(strict_types=1);

final class Connection
{
    private string $host;
    private int $port;
    private string $database;
    private string $username;
    private string $password;
    private bool $trustServerCertificate;

    public function __construct(
        string $host,
        int $port,
        string $database,
        string $username,
        string $password,
        bool $trustServerCertificate = true
    ) {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->trustServerCertificate = $trustServerCertificate;
    }

    public function createPdo(): PDO
    {
        $dsn = sprintf(
            'sqlsrv:Server=%s,%d;Database=%s;TrustServerCertificate=%d',
            $this->host,
            $this->port,
            $this->database,
            $this->trustServerCertificate ? 1 : 0
        );

        $pdo = new PDO(
            $dsn,
            $this->username,
            $this->password,
            array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            )
        );

        return $pdo;
    }
}
