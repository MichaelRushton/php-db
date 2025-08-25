<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use PDO;
use PDOStatement;

interface StatementInterface
{
    public function connection(): ConnectionInterface;

    public function exec(): int|false;

    public function query(
        ?int $fetchMode = null,
        mixed ...$args
    ): PDOStatement|false;

    public function cache(string|int|null $key = null): static;

    public function prepare(): PDOStatement|false;

    public function execute(?array $params = null): PDOStatement|false;

    public function fetch(
        ?array $params = null,
        int $mode = PDO::FETCH_DEFAULT
    ): mixed;

    public function fetchAll(
        ?array $params = null,
        int $mode = PDO::FETCH_DEFAULT,
        mixed ...$args
    ): array|false;

    public function fetchColumn(
        ?array $params = null,
        int $column = 0
    ): mixed;

    public function fetchObject(
        ?array $params = null,
        ?string $class = "stdClass",
        array $constructorArgs = []
    ): object|false;

}
