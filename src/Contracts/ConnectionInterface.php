<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Contracts;

use Closure;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;
use PDO;
use Stringable;

interface ConnectionInterface
{

  public function driver(): DriverInterface;

  public function pdo(): PDO;

  public function delete(string|Stringable|array|null $from = null): Delete & PDOInterface;

  public function insert(?array $values = null): Insert & PDOInterface;

  public function replace(?array $values = null): Replace & PDOInterface;

  public function select(string|Stringable|int|float|bool|null|array $column = null): Select & PDOInterface;

  public function update(string|Stringable|array|null $table = null): Update & PDOInterface;

  public function transaction(Closure $callback): bool;

}