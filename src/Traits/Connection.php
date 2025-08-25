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

    public function sql(): SQLInterface
    {
        return $this->sql;
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

    public function execute(): PDOStatement|false
    {
        return $this->connection()->execute("$this", $this->bindings());
    }

    public function fetch(int $mode = PDO::FETCH_DEFAULT): mixed
    {
        return $this->connection()->fetch("$this", $this->bindings(), $mode);
    }

    public function fetchAll(
        int $mode = PDO::FETCH_DEFAULT,
        mixed ...$args
    ): array|false {
        return $this->connection()->fetchAll("$this", $this->bindings(), $mode, ...$args);
    }

    public function fetchColumn(int $column = 0): mixed
    {
        return $this->connection()->fetchColumn("$this", $this->bindings(), $column);
    }

    public function fetchObject(
        ?string $class = "stdClass",
        array $constructorArgs = []
    ): object|false {
        return $this->connection()->fetchObject("$this", $this->bindings(), $class, $constructorArgs);
    }

}
