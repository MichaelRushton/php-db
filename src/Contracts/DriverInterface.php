<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Contracts;

use MichaelRushton\SQL\Contracts\SQLInterface;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;
use PDO;
use Stringable;

interface DriverInterface
{

  public function connect(#[\SensitiveParameter] array $config = []): ConnectionInterface;

  public function lazyConnect(#[\SensitiveParameter] array $config = []): LazyConnectionInterface;

  public function pdo(#[\SensitiveParameter] array $config = []): PDO;

  public function dsn(#[\SensitiveParameter] array $config = []): string;

  public function sql(): SQLInterface;

  public function delete(
    PDO $pdo,
    string|Stringable|array|null $from = null
  ): Delete & PDOInterface;

  public function insert(
    PDO $pdo,
    ?array $values = null
  ): Insert & PDOInterface;

  public function replace(
    PDO $pdo,
    ?array $values = null
  ): Replace & PDOInterface;

  public function select(
    PDO $pdo,
    string|Stringable|int|float|bool|null|array $column = null
  ): Select & PDOInterface;

  public function update(
    PDO $pdo,
    string|Stringable|array|null $table = null
  ): Update & PDOInterface;

}