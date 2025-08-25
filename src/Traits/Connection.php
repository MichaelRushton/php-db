<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Traits;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\SQL\Interfaces\SQLInterface;
use PDO;
use PDOStatement;

trait Connection
{
    use Cache;

    public function __construct(
        public readonly ConnectionInterface $connection,
        protected SQLInterface $sql
    ) {
    }

    public function connection(): ConnectionInterface
    {

        if ($this->use_cache) {
            $this->connection->cache($this->cache_key);
        }

        return $this->connection;

    }

    public function exec(): int|false
    {
        return $this->connection()->exec("$this");
    }

    public function query(
        ?int $fetchMode = null,
        mixed ...$args
    ): PDOStatement|false {
        return $this->connection()->query("$this", $fetchMode, ...$args);
    }

    public function prepare(): PDOStatement|false
    {
        return $this->connection()->prepare("$this");
    }

    public function execute(?array $params = null): PDOStatement|false
    {
        return $this->connection()->execute("$this", $params ?? $this->bindings());
    }

    public function fetch(
        ?array $params = null,
        int $mode = PDO::FETCH_DEFAULT
    ): mixed {
        return $this->connection()->fetch("$this", $params ?? $this->bindings(), $mode);
    }

    public function fetchAll(
        ?array $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        mixed ...$args
    ): array|false {
        return $this->connection()->fetchAll("$this", $params ?? $this->bindings(), $mode, ...$args);
    }

    public function fetchColumn(
        ?array $params = null,
        int $column = 0
    ): mixed {
        return $this->connection()->fetchColumn("$this", $params ?? $this->bindings(), $column);
    }

    public function fetchObject(
        ?array $params = null,
        ?string $class = "stdClass",
        array $constructorArgs = []
    ): object|false {
        return $this->connection()->fetchObject("$this", $params ?? $this->bindings(), $class, $constructorArgs);
    }

}
