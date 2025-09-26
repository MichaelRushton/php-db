<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Drivers;

use MichaelRushton\DB\Interfaces\Connections\PostgreSQLConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;

interface PostgreSQLDriverInterface extends DriverInterface
{
    public function username(?string $username): static;

    public function password(?string $password): static;

    public function database(?string $database): static;

    public function host(?string $host): static;

    public function port(?int $port): static;

    public function sslmode(?string $sslmode): static;

    public function connection(): PostgreSQLConnectionInterface;
}
