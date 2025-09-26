<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL;

use Generator;
use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\StatementInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\When;
use PDO;
use PDOStatement;
use Stringable;

abstract class Statement implements StatementInterface, HasBindings, Stringable
{
    use Bindings;
    use When;

    public function __construct(
        public readonly ConnectionInterface $connection
    ) {}

    public function connection(): ConnectionInterface
    {
        return $this->connection;
    }

    public function exec(): int|false
    {
        return $this->connection()->pdo()->exec("$this");
    }

    public function query(
        ?int $fetchMode = null,
        mixed ...$fetchModeArgs
    ): PDOStatement|false {
        return $this->connection()->pdo()->query("$this", $fetchMode, ...$fetchModeArgs);
    }

    public function prepare(array $options = []): PDOStatement|false
    {
        return $this->connection()->prepare("$this", $options);
    }

    public function execute(): PDOStatement|false
    {
        return $this->connection()->execute("$this", $this->bindings());
    }

    public function fetch(
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): mixed {
        return $this->connection()->fetch("$this", $this->bindings(), $mode, $cursorOrientation, $cursorOffset);
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
        ?string $class = 'stdClass',
        array $constructorArgs = []
    ): object|false {
        return $this->connection()->fetchObject("$this", $this->bindings(), $class, $constructorArgs);
    }

    public function yield(
        int $mode = PDO::FETCH_DEFAULT,
        int $cursorOrientation = PDO::FETCH_ORI_NEXT,
        int $cursorOffset = 0
    ): Generator {
        return $this->connection()->yield("$this", $this->bindings(), $mode, $cursorOrientation, $cursorOffset);
    }

    public function __toString(): string
    {

        $this->bindings = [];

        return implode(' ', array_filter($this->toArray(), '\strlen'));

    }
}
