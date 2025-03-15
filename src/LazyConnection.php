<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use Closure;
use MichaelRushton\DB\Contracts\ConnectionInterface;
use MichaelRushton\DB\Contracts\DriverInterface;
use MichaelRushton\DB\Contracts\LazyConnectionInterface;
use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;
use PDO;
use Stringable;

class LazyConnection implements LazyConnectionInterface
{

  protected ?ConnectionInterface $connection;

  public function __construct(
    public readonly DriverInterface $driver,
    #[\SensitiveParameter] protected array $config = []
  ) {}

  public function connection(): ConnectionInterface
  {
    return $this->connection ??= $this->driver->connect($this->config);
  }

  public function driver(): DriverInterface
  {
    return $this->connection()->driver();
  }

  public function pdo(): PDO
  {
    return $this->connection()->pdo();
  }

  public function delete(string|Stringable|array|null $from = null): Delete & PDOInterface
  {
    return $this->connection()->delete($from);
  }

  public function insert(?array $values = null): Insert & PDOInterface
  {
    return $this->connection()->insert($values);
  }

  public function replace(?array $values = null): Replace & PDOInterface
  {
    return $this->connection()->replace($values);
  }

  public function select(string|Stringable|int|float|bool|null|array $column = null): Select & PDOInterface
  {
    return $this->connection()->select(...func_get_args());
  }

  public function update(string|Stringable|array|null $table = null): Update & PDOInterface
  {
    return $this->connection()->update($table);
  }

  public function transaction(Closure $callback): bool
  {
    return $this->connection()->transaction($callback);
  }

}