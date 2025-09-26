<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Connections\PostgreSQLConnection;
use MichaelRushton\DB\Driver;
use MichaelRushton\DB\Interfaces\Connections\PostgreSQLConnectionInterface;
use MichaelRushton\DB\Interfaces\Drivers\PostgreSQLDriverInterface;
use SensitiveParameter;

class PostgreSQLDriver extends Driver implements PostgreSQLDriverInterface
{
    public ?string $username = 'postgres';

    public ?string $dbname = 'postgres';
    public ?string $host = '127.0.0.1';
    public ?int $port = 5432;
    public ?string $sslmode = 'prefer';

    public function username(?string $username): static
    {

        $this->username = $username;

        return $this;

    }

    public function password(#[SensitiveParameter] ?string $password): static
    {

        $this->password = $password;

        return $this;

    }

    public function database(?string $database): static
    {

        $this->dbname = $database;

        return $this;

    }

    public function host(?string $host): static
    {

        $this->host = $host;

        return $this;

    }

    public function port(?int $port): static
    {

        $this->port = $port;

        return $this;

    }

    public function sslmode(?string $sslmode): static
    {

        $this->sslmode = $sslmode;

        return $this;

    }

    public function connection(): PostgreSQLConnectionInterface
    {
        return new PostgreSQLConnection($this);
    }

    public function dsn(): string
    {

        return 'pgsql:' . implode(';', [
            "host=$this->host",
            "port=$this->port",
            "dbname=$this->dbname",
            "sslmode=$this->sslmode",
        ]);

    }
}
