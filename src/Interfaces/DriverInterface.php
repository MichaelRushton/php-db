<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces;

use PDO;

interface DriverInterface
{
    public function connection(): ConnectionInterface;

    public function pdo(): PDO;

    public function dsn(): string;
}
