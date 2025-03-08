<?php

declare(strict_types=1);

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Driver;
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

$pdo = new PDO("sqlite:");

test("delete", function ($driver, $class, $table) use ($pdo)
{

  $connection = new Connection($driver, $pdo);

  expect($stmt = $connection->delete("t1"))
  ->toBeInstanceOf($class);

  expect("$stmt")
  ->toBe("DELETE FROM $table");

})
->with([
  "mariadb" => [Driver::MariaDB, MariaDBDelete::class, "`t1`"],
  "mysql" => [Driver::MySQL, MySQLDelete::class, "`t1`"],
  "postgresql" => [Driver::PostgreSQL, PostgreSQLDelete::class, '"t1"'],
  "sqlite" => [Driver::SQLite, SQLiteDelete::class, '"t1"'],
  "sqlserver" => [Driver::SQLServer, TransactSQLDelete::class, "[t1]"],
]);

test("insert", function ($driver, $class) use ($pdo)
{

  $connection = new Connection($driver, $pdo);

  expect($stmt = $connection->insert([1]))
  ->toBeInstanceOf($class);

  expect("$stmt")
  ->toBe("INSERT VALUES (1)");

})
->with([
  "mariadb" => [Driver::MariaDB, MariaDBInsert::class],
  "mysql" => [Driver::MySQL, MySQLInsert::class],
  "postgresql" => [Driver::PostgreSQL, PostgreSQLInsert::class],
  "sqlite" => [Driver::SQLite, SQLiteInsert::class],
  "sqlserver" => [Driver::SQLServer, TransactSQLInsert::class],
]);

test("replace", function ($driver, $class) use ($pdo)
{

  $connection = new Connection($driver, $pdo);

  expect($stmt = $connection->replace([1]))
  ->toBeInstanceOf($class);

  expect("$stmt")
  ->toBe("REPLACE VALUES (1)");

})
->with([
  "mariadb" => [Driver::MariaDB, MariaDBReplace::class],
  "mysql" => [Driver::MySQL, MySQLReplace::class],
  "sqlite" => [Driver::SQLite, SQLiteReplace::class],
]);

test("select", function ($driver, $class, $column) use ($pdo)
{

  $connection = new Connection($driver, $pdo);

  expect($stmt = $connection->select("c1"))
  ->toBeInstanceOf($class);

  expect("$stmt")
  ->toBe("SELECT $column");

})
->with([
  "mariadb" => [Driver::MariaDB, MariaDBSelect::class, "`c1`"],
  "mysql" => [Driver::MySQL, MySQLSelect::class, "`c1`"],
  "postgresql" => [Driver::PostgreSQL, PostgreSQLSelect::class, '"c1"'],
  "sqlite" => [Driver::SQLite, SQLiteSelect::class, '"c1"'],
  "sqlserver" => [Driver::SQLServer, TransactSQLSelect::class, "[c1]"],
]);

test("update", function ($driver, $class, $table) use ($pdo)
{

  $connection = new Connection($driver, $pdo);

  expect($stmt = $connection->update("t1"))
  ->toBeInstanceOf($class);

  expect("$stmt")
  ->toBe("UPDATE $table");

})
->with([
  "mariadb" => [Driver::MariaDB, MariaDBUpdate::class, "`t1`"],
  "mysql" => [Driver::MySQL, MySQLUpdate::class, "`t1`"],
  "postgresql" => [Driver::PostgreSQL, PostgreSQLUpdate::class, '"t1"'],
  "sqlite" => [Driver::SQLite, SQLiteUpdate::class, '"t1"'],
  "sqlserver" => [Driver::SQLServer, TransactSQLUpdate::class, "[t1]"],
]);

test("roll back transaction", function () use ($pdo)
{

  $pdo->query("DROP TABLE IF EXISTS t1");

  $pdo->query("CREATE TABLE t1 (id INTEGER PRIMARY KEY)");

  $connection = new Connection(Driver::SQLite, $pdo);

  try
  {

    $connection->transaction(function ()
    {

      $this->pdo->query("INSERT INTO t1 VALUES (1)");

      throw new Exception;

    });

  }

  catch (Throwable $e)
  {
    throw $e;
  }

  finally
  {

    expect($pdo->query("SELECT * FROM t1")->fetchAll())
    ->toBe([]);

  }

})
->throws(Exception::class);

test("commit transaction", function () use ($pdo)
{

  $pdo->query("DROP TABLE IF EXISTS t1");

  $pdo->query("CREATE TABLE t1 (id INTEGER PRIMARY KEY)");

  $connection = new Connection(Driver::SQLite, $pdo);

  expect($connection->transaction(function ()
  {
    $this->pdo->query("INSERT INTO t1 VALUES (1)");
  }))
  ->toBeTrue();

  expect($pdo->query("SELECT * FROM t1")->fetchAll(PDO::FETCH_ASSOC))
  ->toBe([["id" => 1]]);

});