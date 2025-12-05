<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use MichaelRushton\DB\Interfaces\DriverInterface;
use PDO;

abstract class Driver implements DriverInterface
{
    public ?string $username = null;
    public ?string $password = null;

    public function __construct(
        public readonly ?array $pdo_options = null
    ) {
    }

    public function pdo(): PDO
    {
        return PDO::connect($this->dsn(), $this->username, $this->password, $this->pdo_options);
    }
}
