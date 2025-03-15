<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use Closure;
use MichaelRushton\DB\Contracts\ConnectionInterface;
use MichaelRushton\DB\Contracts\DriverInterface;
use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;
use PDO;
use Stringable;
use Throwable;

class Connection implements ConnectionInterface
{

  public function __construct(
    public readonly DriverInterface $driver,
    public readonly PDO $pdo
  ) {}

  public function driver(): DriverInterface
  {
    return $this->driver;
  }

  public function pdo(): PDO
  {
    return $this->pdo;
  }

  public function delete(string|Stringable|array|null $from = null): Delete & PDOInterface
  {
    return $this->driver->delete($this->pdo, $from);
  }

  public function insert(?array $values = null): Insert & PDOInterface
  {
    return $this->driver->insert($this->pdo, $values);
  }

  public function replace(?array $values = null): Replace & PDOInterface
  {
    return $this->driver->replace($this->pdo, $values);
  }

  public function select(string|Stringable|int|float|bool|null|array $column = null): Select & PDOInterface
  {
    return $this->driver->select($this->pdo, ...func_get_args());
  }

  public function update(string|Stringable|array|null $table = null): Update & PDOInterface
  {
    return $this->driver->update($this->pdo, $table);
  }

  public function transaction(Closure $callback): bool
  {

    $this->pdo->beginTransaction();

    try
    {

      $callback->call($this);

      return $this->pdo->commit();

    }

    catch (Throwable $e)
    {

      $this->pdo->rollBack();

      throw $e;

    }


  }

}