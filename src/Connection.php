<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use Generator;
use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\DriverInterface;
use MichaelRushton\DB\Traits\HasEvents;
use PDO;
use PDOStatement;
use Throwable;
use WeakReference;

abstract class Connection implements ConnectionInterface
{
    use HasEvents;

    protected PDO $pdo;
    protected array $cache = [];

    public function __construct(
        public readonly DriverInterface $driver
    ) {}

    public function driver(): DriverInterface
    {
        return $this->driver;
    }

    public function pdo(): PDO
    {

        if (isset($this->pdo)) {
            return $this->pdo;
        }

        $this->runBeforeConnect();

        try {

            $time = -hrtime(true);

            $this->pdo = $this->driver->pdo();

            $time += hrtime(true);

            return $this->pdo;

        } catch (Throwable $e) {

            $time += hrtime(true);

            throw $e;

        } finally {
            $this->runAfterConnect(isset($this->pdo), $time, $e ?? null);
        }

    }

    public function exec(string $statement): int|false
    {

        $pdo = $this->pdo();

        $this->runBeforeExecute($statement);

        try {

            $time = -hrtime(true);

            $count = $pdo->exec($statement);

            $time += hrtime(true);

            return $count;

        } catch (Throwable $e) {

            $time += hrtime(true);

            throw $e;

        } finally {
            $this->runAfterExecute($statement, false !== ($count ?? false), $time, $e ?? null);
        }

    }

    public function query(
        string $query,
        ?int $fetchMode = null,
        mixed ...$fetchModeArgs
    ): PDOStatement|false {

        $pdo = $this->pdo();

        $this->runBeforeExecute($query);

        try {

            $time = -hrtime(true);

            $stmt = $pdo->query($query, $fetchMode, ...$fetchModeArgs);

            $time += hrtime(true);

            return $stmt;

        } catch (Throwable $e) {

            $time += hrtime(true);

            throw $e;

        } finally {
            $this->runAfterExecute($query, !empty($stmt), $time, $e ?? null);
        }

    }

    public function prepare(
        string $query,
        array $options = []
    ): PDOStatement|false {

        $key = hash('xxh128', $query);

        if ($stmt = ($this->cache[$key] ?? null)?->get()) {
            return $stmt;
        }

        $pdo = $this->pdo();

        $this->runBeforePrepare($query);

        try {

            $time = -hrtime(true);

            $stmt = $pdo->prepare($query, $options);

            $time += hrtime(true);

            if ($stmt) {
                $this->cache[$key] = WeakReference::create($stmt);
            }

            return $stmt;

        } catch (Throwable $e) {

            $time += hrtime(true);

            throw $e;

        } finally {
            $this->runAfterPrepare($query, !empty($stmt), $time, $e ?? null);
        }

    }

    public function execute(
        string $query,
        array|string|int|float|bool|null $params = null
    ): PDOStatement|false {

        if (!$stmt = $this->prepare($query)) {
            return false;
        }

        $params = (array) $params;

        foreach ($params as $param => $value) {

            $stmt->bindValue(\is_string($param) ? $param : $param + 1, $value, match (\gettype($value)) {
                'integer' => PDO::PARAM_INT,
                'boolean' => PDO::PARAM_BOOL,
                'NULL' => PDO::PARAM_NULL,
                default => PDO::PARAM_STR,
            });

        }

        $this->runBeforeExecute($query, $params);

        try {

            $time = -hrtime(true);

            $success = $stmt->execute();

            $time += hrtime(true);

            return $success ? $stmt : false;

        } catch (Throwable $e) {

            $time += hrtime(true);

            throw $e;

        } finally {
            $this->runAfterExecute($query, $success ?? false, $time, $e ?? null, $params);
        }

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
