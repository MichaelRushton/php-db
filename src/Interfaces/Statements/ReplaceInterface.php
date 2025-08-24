<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Statements;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\SQL\Interfaces\SQLInterface;
use MichaelRushton\SQL\Interfaces\Statements\ReplaceInterface as StatementsReplaceInterface;
use PDO;
use PDOStatement;

interface ReplaceInterface extends StatementsReplaceInterface
{
    public function connection(): ConnectionInterface;

    public function sql(): SQLInterface;

    public function exec(): int|false;

    public function query(
        ?int $fetchMode = null,
        mixed ...$args
    ): PDOStatement|false;

    public function prepare(): PDOStatement|false;

    public function execute(): PDOStatement|false;

    public function fetch(int $mode = PDO::FETCH_DEFAULT): mixed;

    public function fetchAll(
        int $mode = PDO::FETCH_DEFAULT,
        mixed ...$args
    ): array|false;

    public function fetchColumn(int $column = 0): mixed;

    public function fetchObject(
        ?string $class = "stdClass",
        array $constructorArgs = []
    ): object|false;

}
