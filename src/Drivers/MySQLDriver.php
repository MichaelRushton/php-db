<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Connections\MySQLConnection;
use MichaelRushton\DB\Driver;
use MichaelRushton\DB\Interfaces\Connections\MySQLConnectionInterface;
use MichaelRushton\DB\Interfaces\Drivers\MySQLDriverInterface;
use SensitiveParameter;

class MySQLDriver extends Driver implements MySQLDriverInterface
{
    public ?string $username = 'root';

    public ?string $dbname = null;
    public ?string $host = '127.0.0.1';
    public ?int $port = 3306;
    public ?string $unix_socket = null;
    public ?string $charset = null;

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

        $this->unix_socket = null;

        return $this;

    }

    public function port(?int $port): static
    {

        $this->port = $port;

        $this->unix_socket = null;

        return $this;

    }

    public function unixSocket(?string $unix_socket): static
    {

        $this->unix_socket = $unix_socket;

        $this->host = $this->port = null;

        return $this;

    }

    public function charset(?string $charset): static
    {

        $this->charset = $charset;

        return $this;

    }

    public function connection(): MySQLConnectionInterface
    {
        return new MySQLConnection($this);
    }

    public function dsn(): string
    {

        foreach ([
            'host',
            'port',
            'dbname',
            'unix_socket',
            'charset',
        ] as $key) {

            if (isset($this->$key)) {
                $dsn[] = "$key={$this->$key}";
            }

        }

        return 'mysql:' . implode(';', $dsn ?? []);

    }
}
