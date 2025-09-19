<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Drivers;

use MichaelRushton\DB\Connections\SQLiteConnection;
use MichaelRushton\DB\Driver;
use MichaelRushton\DB\Interfaces\Connections\SQLiteConnectionInterface;
use MichaelRushton\DB\Interfaces\Drivers\SQLiteDriverInterface;

class SQLiteDriver extends Driver implements SQLiteDriverInterface
{
    public ?string $database = '';

    public function database(?string $database): static
    {

        $this->database = $database;

        return $this;

    }

    public function connection(): SQLiteConnectionInterface
    {
        return new SQLiteConnection($this);
    }

    public function dsn(): string
    {
        return 'sqlite:' . $this->database;
    }
}
