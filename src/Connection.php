<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use Generator;
use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;
use PDO;
use PDOStatement;
use Throwable;
use WeakReference;

abstract class Connection implements ConnectionInterface
{
    protected array $cache = [];
    protected PDO $pdo;

    public function __construct(
        public readonly DriverInterface $driver
    ) {}

    public function driver(): DriverInterface
    {
        return $this->driver;
    }

    public function pdo(): PDO
    {
        return $this->pdo ??= $this->driver->pdo();
    }

    public function exec(string $statement): int|false
    {
        return $this->pdo()->exec($statement);
    }

    public function query(
        string $query,
        ?int $fetchMode = null,
        mixed ...$fetchModeArgs
    ): PDOStatement|false {
        return $this->pdo()->query($query, $fetchMode, ...$fetchModeArgs);
    }

    public function prepare(
        string $query,
        array $options = []
    ): PDOStatement|false {

        $key = hash('xxh128', $query);

        if ($stmt = ($this->cache[$key] ?? null)?->get()) {
            return $stmt;
        }

        if ($stmt = $this->pdo()->prepare($query, $options)) {
            $this->cache[$key] = WeakReference::create($stmt);
        }

        return $stmt;

    }

    public function execute(
        string $query,
        array|string|int|float|bool|null $params = null
    ): PDOStatement|false {

        if (!$stmt = $this->prepare($query)) {
            return false;
        }

        foreach ((array) $params as $param => $value) {

            $stmt->bindValue(\is_string($param) ? $param : $param + 1, $value, match (\gettype($value)) {
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                'NULL' => PDO::PARAM_NULL,
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
        array|string|int|float|bool|null $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): mixed {

        if (!$stmt = $this->execute($query, $params)) {
            return false;
        }

        return $stmt->fetch($mode, $cursorOrientation, $cursorOffset);

    }

    public function fetchAll(
        string $query,
        array|string|int|float|bool|null $params = null,
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
        array|string|int|float|bool|null $params = null,
        int $column = 0
    ): mixed {

        if (!$stmt = $this->execute($query, $params)) {
            return false;
        }

        return $stmt->fetchColumn($column);

    }

    public function fetchObject(
        string $query,
        array|string|int|float|bool|null $params = null,
        ?string $class = 'stdClass',
        array $constructorArgs = []
    ): object|false {

        if (!$stmt = $this->execute($query, $params)) {
            return false;
        }

        return $stmt->fetchObject($class, $constructorArgs);

    }

    public function yield(
        string $query,
        array|string|int|float|bool|null $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): Generator {

        if ($stmt = $this->execute($query, $params)) {

            while (false !== $row = $stmt->fetch($mode, $cursorOrientation, $cursorOffset)) {
                yield $row;
            }

        }

    }

    public function transaction(callable $callback): bool
    {

        $pdo = $this->pdo();

        $pdo->beginTransaction();

        try {

            $callback($this);

            return $pdo->commit();

        } catch (Throwable $e) {

            $pdo->rollBack();

            throw $e;

        }

    }
}
