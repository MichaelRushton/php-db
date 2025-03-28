<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Contracts;

use Closure;
use MichaelRushton\DB\Contracts\Statements\DeleteInterface;
use MichaelRushton\DB\Contracts\Statements\InsertInterface;
use MichaelRushton\DB\Contracts\Statements\SelectInterface;
use MichaelRushton\DB\Contracts\Statements\UpdateInterface;
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
    mixed ...$fetch_mode_args
  ): PDOStatement|false;

  public function prepare(string $query): PDOStatement|false;

  public function execute(
    string $query,
    ?array $params = null
  ): PDOStatement|false;

  public function fetch(
    string $query,
    ?array $params = null,
    int $mode = PDO::FETCH_DEFAULT
  ): mixed;

  public function fetchAll(
    string $query,
    ?array $params = null,
    int $mode = PDO::FETCH_DEFAULT,
    mixed ...$mode_args
  ): array|false;

  public function fetchColumn(
    string $query,
    ?array $params = null,
    int $column = 0
  ): mixed;

  public function fetchObject(
    string $query,
    ?array $params = null,
    ?string $class = "stdClass",
    array $constructorArgs = []
  ): object|false;

  public function transaction(Closure $callback): bool;

  public function delete(): DeleteInterface;

  public function insert(): InsertInterface;

  public function select(): SelectInterface;

  public function update(): UpdateInterface;

}