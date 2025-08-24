<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;
use PDO;
use SensitiveParameter;

class LazyConnection extends Connection
{
    protected ConnectionInterface $connection;

    public function __construct(
        public readonly DriverInterface $driver,
        #[SensitiveParameter] protected array $config = []
    ) {
    }

    public function connection(): ConnectionInterface
    {
        return $this->connection ??= $this->driver()->connect($this->config);
    }

    public function pdo(): PDO
    {
        return $this->connection()->pdo();
    }

}
