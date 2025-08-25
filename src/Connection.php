<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use BadMethodCallException;
use Closure;
use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;
use MichaelRushton\DB\Interfaces\StatementInterface;
use MichaelRushton\DB\Statements\Delete;
use MichaelRushton\DB\Statements\Insert;
use MichaelRushton\DB\Statements\Replace;
use MichaelRushton\DB\Statements\Select;
use MichaelRushton\DB\Statements\Update;
use MichaelRushton\DB\Traits\Cache;
use MichaelRushton\SQL\Interfaces\Statements\DeleteInterface;
use MichaelRushton\SQL\Interfaces\Statements\InsertInterface;
use MichaelRushton\SQL\Interfaces\Statements\ReplaceInterface;
use MichaelRushton\SQL\Interfaces\Statements\SelectInterface;
use MichaelRushton\SQL\Interfaces\Statements\UpdateInterface;
use PDO;
use PDOStatement;
use Throwable;
use WeakReference;

class Connection implements ConnectionInterface
{
    use Cache;
    protected array $cache = [];

    public function __construct(
        public readonly DriverInterface $driver,
        public readonly PDO $pdo
    ) {
    }

    public function driver(): DriverInterface
    {
        return $this->driver;
    }

    public function pdo(): PDO
    {
        return $this->pdo;
    }

    public function exec(string $statement): int|false
    {
        return $this->pdo()->exec($statement);
    }

    public function query(
        string $query,
        ?int $fetchMode = null,
        mixed ...$args
    ): PDOStatement|false {
        return $this->pdo()->query($query, $fetchMode, ...$args);
    }

    public function prepare(string $query): PDOStatement|false
    {

        try {
            return $this->use_cache ? $this->cached($query, $this->cache_key) : $this->pdo()->prepare($query);
        } finally {

            $this->use_cache = false;

            $this->cache_key = null;

        }

    }

    public function cached(
        string $query,
        string|int|null $key = null
    ): PDOStatement|false {

        $key ??= hash("xxh128", $query);

        if ($stmt = ($this->cache[$key] ?? null)?->get()) {
            return $stmt;
        }

        if ($stmt = $this->pdo()->prepare($query)) {
            $this->cache[$key] = WeakReference::create($stmt);
        }

        return $stmt;

    }

    public function execute(
        string $query,
        ?array $params = null
    ): PDOStatement|false {

        if (!$stmt = $this->prepare($query)) {
            return false;
        }

        foreach ((array) $params as $i => $value) {

            $stmt->bindValue($i + 1, $value, match (gettype($value)) {
                "boolean" => PDO::PARAM_BOOL,
                "integer" => PDO::PARAM_INT,
                "NULL" => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            });

        }

        if (!$stmt->execute()) {
            return false;
        }

        return $stmt;

    }

    public function fetch(
        string $query,
        ?array $params = null,
        int $mode = PDO::FETCH_DEFAULT
    ): mixed {

        if (!$stmt = $this->execute($query, $params)) {
            return false;
        }

        return $stmt->fetch($mode);

    }

    public function fetchAll(
        string $query,
        ?array $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        mixed ...$args
    ): array|false {

        if (!$stmt = $this->execute($query, $params)) {
            return false;
        }

        return $stmt->fetchAll($mode, ...$args);

    }

    public function fetchColumn(
        string $query,
        ?array $params = null,
        int $column = 0
    ): mixed {

        if (!$stmt = $this->execute($query, $params)) {
            return false;
        }

        return $stmt->fetchColumn($column);

    }

    public function fetchObject(
        string $query,
        ?array $params = null,
        ?string $class = "stdClass",
        array $constructorArgs = []
    ): object|false {

        if (!$stmt = $this->execute($query, $params)) {
            return false;
        }

        return $stmt->fetchObject($class, $constructorArgs);

    }

    public function transaction(Closure $callback): bool
    {

        $this->pdo()->beginTransaction();

        try {

            $callback($this);

            return $this->pdo()->commit();

        } catch (Throwable $e) {

            $this->pdo()->rollBack();

            throw $e;

        }


    }

    public function delete(): DeleteInterface & StatementInterface
    {
        return new Delete($this, $this->driver()->sql());
    }

    public function insert(): InsertInterface & StatementInterface
    {
        return new Insert($this, $this->driver()->sql());
    }

    public function replace(): ReplaceInterface & StatementInterface
    {

        if (in_array($driver = $this->driver(), [Driver::PostgreSQL, Driver::SQLServer])) {
            throw new BadMethodCallException();
        }

        return new Replace($this, $driver->sql());

    }

    public function select(): SelectInterface & StatementInterface
    {
        return new Select($this, $this->driver()->sql());
    }

    public function update(): UpdateInterface & StatementInterface
    {
        return new Update($this, $this->driver()->sql());
    }

}
