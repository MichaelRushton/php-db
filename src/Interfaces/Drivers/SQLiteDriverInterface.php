<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Drivers;

use MichaelRushton\DB\Interfaces\Connections\SQLiteConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;

interface SQLiteDriverInterface extends DriverInterface
{
    public function database(?string $database): static;

    public function connection(): SQLiteConnectionInterface;
}
