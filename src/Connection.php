<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use BadMethodCallException;
use Closure;
use MichaelRushton\DB\Contracts\ConnectionInterface;
use MichaelRushton\DB\Contracts\DriverInterface;
use MichaelRushton\DB\Contracts\Statements\DeleteInterface;
use MichaelRushton\DB\Contracts\Statements\InsertInterface;
use MichaelRushton\DB\Contracts\Statements\ReplaceInterface;
use MichaelRushton\DB\Contracts\Statements\SelectInterface;
use MichaelRushton\DB\Contracts\Statements\UpdateInterface;
use MichaelRushton\DB\Statements\Delete;
use MichaelRushton\DB\Statements\Insert;
use MichaelRushton\DB\Statements\Replace;
use MichaelRushton\DB\Statements\Select;
use MichaelRushton\DB\Statements\Update;
use PDO;
use PDOStatement;
use Throwable;
use WeakMap;

class Connection implements ConnectionInterface
{

  protected static WeakMap $cache;

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

  public function exec(string $statement): int|false
  {
    return $this->pdo()->exec($statement);
  }

  public function query(
    string $query,
    ?int $fetchMode = null,
    mixed ...$args
  ): PDOStatement|false
  {
    return $this->pdo()->query($query, $fetchMode, ...$args);
  }

  public function prepare(string $query): PDOStatement|false
  {

    static::$cache ??= new WeakMap;

    static::$cache[$pdo = $this->pdo()] ??= [];

    $hash = hash("xxh128", $query);

    return (static::$cache[$pdo][$hash] ??= ($pdo->prepare($query) ?: null)) ?: false;

  }

  public function execute(
    string $query,
    ?array $params = null
  ): PDOStatement|false
  {

    if (!$stmt = $this->prepare($query))
    {
      return false;
    }

    foreach ((array) $params as $i => $value)
    {

      $stmt->bindValue($i + 1, $value, match (gettype($value))
      {
        "boolean" => PDO::PARAM_BOOL,
        "integer" => PDO::PARAM_INT,
        "NULL" => PDO::PARAM_NULL,
        default => PDO::PARAM_STR,
      });

    }

    if (!$stmt->execute())
    {
      return false;
    }

    return $stmt;

  }

  public function fetch(
    string $query,
    ?array $params = null,
    int $mode = PDO::FETCH_DEFAULT
  ): mixed
  {

    if (!$stmt = $this->execute($query, $params))
    {
      return false;
    }

    return $stmt->fetch($mode);

  }

  public function fetchAll(
    string $query,
    ?array $params = null,
    int $mode = PDO::FETCH_DEFAULT,
    mixed ...$args
  ): array|false
  {

    if (!$stmt = $this->execute($query, $params))
    {
      return false;
    }

    return $stmt->fetchAll($mode, ...$args);

  }

  public function fetchColumn(
    string $query,
    ?array $params = null,
    int $column = 0
  ): mixed
  {

    if (!$stmt = $this->execute($query, $params))
    {
      return false;
    }

    return $stmt->fetchColumn($column);

  }

  public function fetchObject(
    string $query,
    ?array $params = null,
    ?string $class = "stdClass",
    array $constructorArgs = []
  ): object|false
  {

    if (!$stmt = $this->execute($query, $params))
    {
      return false;
    }

    return $stmt->fetchObject($class, $constructorArgs);

  }

  public function transaction(Closure $callback): bool
  {

    $this->pdo()->beginTransaction();

    try
    {

      $callback->call($this, $this);

      return $this->pdo()->commit();

    }

    catch (Throwable $e)
    {

      $this->pdo()->rollBack();

      throw $e;

    }


  }

  public function delete(): DeleteInterface
  {
    return new Delete($this, $this->driver()->sql());
  }

  public function insert(): InsertInterface
  {
    return new Insert($this, $this->driver()->sql());
  }

  public function replace(): ReplaceInterface
  {

    if (in_array($driver = $this->driver(), [Driver::PostgreSQL, Driver::SQLServer]))
    {
      throw new BadMethodCallException;
    }

    return new Replace($this, $driver->sql());

  }

  public function select(): SelectInterface
  {
    return new Select($this, $this->driver()->sql());
  }

  public function update(): UpdateInterface
  {
    return new Update($this, $this->driver()->sql());
  }

}