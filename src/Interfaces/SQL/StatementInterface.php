<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\SQL;

use Generator;
use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use PDO;
use PDOStatement;

interface StatementInterface
{
    public function bindings(): array;

    public function mergeBindings(HasBindings $from): void;

    public function connection(): ConnectionInterface;

    public function exec(): int|false;

    public function query(
        ?int $fetchMode = null,
        mixed ...$fetchModeArgs
    ): PDOStatement|false;

    public function prepare(array $options = []): PDOStatement|false;

    public function execute(): PDOStatement|false;

    public function fetch(
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): mixed;

    public function fetchAll(
        int $mode = PDO::FETCH_DEFAULT,
        mixed ...$args
    ): array|false;

    public function fetchColumn(int $column = 0): mixed;

    public function fetchObject(
        ?string $class = 'stdClass',
        array $constructorArgs = []
    ): object|false;

    public function yield(
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): Generator;

    public function when(
        mixed $value,
        ?callable $if_true = null,
        ?callable $if_false = null
    ): static;

    public function toArray(): array;
}
