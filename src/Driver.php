<?php

declare(strict_types=1);

namespace MichaelRushton\DB;

use BadMethodCallException;
use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Drivers\MariaDB;
use MichaelRushton\DB\Drivers\MySQL;
use MichaelRushton\DB\Drivers\PostgreSQL;
use MichaelRushton\DB\Drivers\SQLite;
use MichaelRushton\DB\Drivers\SQLServer;
use MichaelRushton\DB\Statements\MariaDB\Delete as MariaDBDelete;
use MichaelRushton\DB\Statements\MariaDB\Insert as MariaDBInsert;
use MichaelRushton\DB\Statements\MariaDB\Replace as MariaDBReplace;
use MichaelRushton\DB\Statements\MariaDB\Select as MariaDBSelect;
use MichaelRushton\DB\Statements\MariaDB\Update as MariaDBUpdate;
use MichaelRushton\DB\Statements\MySQL\Delete as MySQLDelete;
use MichaelRushton\DB\Statements\MySQL\Insert as MySQLInsert;
use MichaelRushton\DB\Statements\MySQL\Replace as MySQLReplace;
use MichaelRushton\DB\Statements\MySQL\Select as MySQLSelect;
use MichaelRushton\DB\Statements\MySQL\Update as MySQLUpdate;
use MichaelRushton\DB\Statements\PostgreSQL\Delete as PostgreSQLDelete;
use MichaelRushton\DB\Statements\PostgreSQL\Insert as PostgreSQLInsert;
use MichaelRushton\DB\Statements\PostgreSQL\Select as PostgreSQLSelect;
use MichaelRushton\DB\Statements\PostgreSQL\Update as PostgreSQLUpdate;
use MichaelRushton\DB\Statements\SQLite\Delete as SQLiteDelete;
use MichaelRushton\DB\Statements\SQLite\Insert as SQLiteInsert;
use MichaelRushton\DB\Statements\SQLite\Replace as SQLiteReplace;
use MichaelRushton\DB\Statements\SQLite\Select as SQLiteSelect;
use MichaelRushton\DB\Statements\SQLite\Update as SQLiteUpdate;
use MichaelRushton\DB\Statements\TransactSQL\Delete as TransactSQLDelete;
use MichaelRushton\DB\Statements\TransactSQL\Insert as TransactSQLInsert;
use MichaelRushton\DB\Statements\TransactSQL\Select as TransactSQLSelect;
use MichaelRushton\DB\Statements\TransactSQL\Update as TransactSQLUpdate;
use MichaelRushton\SQL\Statements\Delete;
use MichaelRushton\SQL\Statements\Insert;
use MichaelRushton\SQL\Statements\Replace;
use MichaelRushton\SQL\Statements\Select;
use MichaelRushton\SQL\Statements\Update;
use PDO;
use Stringable;

enum Driver
{

  case MariaDB;
  case MySQL;
  case PostgreSQL;
  case SQLite;
  case SQLServer;

  public function connect(#[\SensitiveParameter] array $config = []): Connection
  {
    return new Connection($this, $this->pdo($config));
  }

  public function dsn(#[\SensitiveParameter] array $config = []): string
  {

    return match ($this)
    {
      static::MariaDB => MariaDB::dsn($config),
      static::MySQL => MySQL::dsn($config),
      static::PostgreSQL => PostgreSQL::dsn($config),
      static::SQLite => SQLite::dsn($config),
      static::SQLServer => SQLServer::dsn($config),
    };

  }

  public function pdo(#[\SensitiveParameter] array $config = []): PDO
  {

    return new PDO(
      static::dsn($config),
      $config["username"] ?? null,
      $config["password"] ?? null,
      $config["options"] ?? null
    );

  }

  public function delete(
    PDO $pdo,
    string|Stringable|array|null $from = null
  ): Delete & PDOInterface
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBDelete($pdo),
      static::MySQL => new MySQLDelete($pdo),
      static::PostgreSQL => new PostgreSQLDelete($pdo),
      static::SQLite => new SQLiteDelete($pdo),
      static::SQLServer => new TransactSQLDelete($pdo),
    };

    return is_null($from) ? $stmt : $stmt->from($from);

  }

  public function insert(
    PDO $pdo,
    ?array $values = null
  ): Insert & PDOInterface
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBInsert($pdo),
      static::MySQL => new MySQLInsert($pdo),
      static::PostgreSQL => new PostgreSQLInsert($pdo),
      static::SQLite => new SQLiteInsert($pdo),
      static::SQLServer => new TransactSQLInsert($pdo),
    };

    return is_null($values) ? $stmt : $stmt->values($values);

  }

  public function replace(
    PDO $pdo,
    ?array $values = null
  ): Replace & PDOInterface
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBReplace($pdo),
      static::MySQL => new MySQLReplace($pdo),
      static::SQLite => new SQLiteReplace($pdo),
      default => throw new BadMethodCallException,
    };

    return is_null($values) ? $stmt : $stmt->values($values);

  }

  public function select(
    PDO $pdo,
    string|Stringable|int|float|bool|null|array $column = null
  ): Select & PDOInterface
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBSelect($pdo),
      static::MySQL => new MySQLSelect($pdo),
      static::PostgreSQL => new PostgreSQLSelect($pdo),
      static::SQLite => new SQLiteSelect($pdo),
      static::SQLServer => new TransactSQLSelect($pdo),
    };

    return func_num_args() - 1 ? $stmt->select($column) : $stmt;

  }

  public function update(
    PDO $pdo,
    string|Stringable|array|null $table = null
  ): Update & PDOInterface
  {

    $stmt = match ($this)
    {
      static::MariaDB => new MariaDBUpdate($pdo),
      static::MySQL => new MySQLUpdate($pdo),
      static::PostgreSQL => new PostgreSQLUpdate($pdo),
      static::SQLite => new SQLiteUpdate($pdo),
      static::SQLServer => new TransactSQLUpdate($pdo),
    };

    return is_null($table) ? $stmt : $stmt->table($table);

  }

}