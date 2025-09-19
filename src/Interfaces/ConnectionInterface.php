<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces;

use Generator;
use MichaelRushton\DB\Interfaces\SQL\Statements\DeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\InsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\UpdateInterface;
use PDO;
use PDOStatement;

interface ConnectionInterface
{
    public function driver(): DriverInterface;

    public function pdo(): PDO;

    public function exec(string $statement): int|false;

    public function query(
        string $query,
        ?int $fetchMode = null,
        mixed ...$fetchModeArgs
    ): PDOStatement|false;

    public function prepare(
        string $query,
        array $options = []
    ): PDOStatement|false;

    public function execute(
        string $query,
        array|string|int|float|bool|null $params = null
    ): PDOStatement|false;

    public function fetch(
        string $query,
        array|string|int|float|bool|null $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): mixed;

    public function fetchAll(
        string $query,
        array|string|int|float|bool|null $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        mixed ...$args
    ): array|false;

    public function fetchColumn(
        string $query,
        array|string|int|float|bool|null $params = null,
        int $column = 0
    ): mixed;

    public function fetchObject(
        string $query,
        array|string|int|float|bool|null $params = null,
        ?string $class = 'stdClass',
        array $constructorArgs = []
    ): object|false;

    public function yield(
        string $query,
        array|string|int|float|bool|null $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): Generator;

    public function transaction(callable $callback): bool;

    public function delete(): DeleteInterface;

    public function insert(): InsertInterface;

    public function select(): SelectInterface;

    public function update(): UpdateInterface;
}
