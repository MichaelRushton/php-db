<?php

declare(strict_types=1);

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Driver;
use MichaelRushton\DB\LazyConnection;
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
use MichaelRushton\SQL\SQL;

test("dsn", function ($driver, $config, $dsn)
{

  expect($driver->dsn($config))
  ->toBe($dsn);

})
->with([
  'mariadb' => [
    Driver::MariaDB, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "",
      "charset" => "utf8mb4",
    ], "mysql:host=localhost;port=3306;dbname=database;charset=utf8mb4",
  ],
  'mariadb with unix socket' => [
    Driver::MariaDB, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "/tmp/mysql.sock",
      "charset" => "utf8mb4",
    ], "mysql:unix_socket=/tmp/mysql.sock;dbname=database;charset=utf8mb4",
  ],
  'mysql' => [
    Driver::MySQL, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "",
      "charset" => "utf8mb4",
    ], "mysql:host=localhost;port=3306;dbname=database;charset=utf8mb4",
  ],
  'mysql with unix socket' => [
    Driver::MySQL, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "/tmp/mysql.sock",
      "charset" => "utf8mb4",
    ], "mysql:unix_socket=/tmp/mysql.sock;dbname=database;charset=utf8mb4",
  ],
  'postgresql' => [
    Driver::PostgreSQL, [
      "host" => "localhost",
      "port" => 5432,
      "dbname" => "database",
      "sslmode" => "prefer",
    ], "pgsql:host=localhost;port=5432;dbname=database;sslmode=prefer",
  ],
  'sqlite' => [
    Driver::SQLite, [
      "database" => ":memory:",
    ], "sqlite::memory:"
  ],
  'sqlserver' => [
    Driver::SQLServer, [
      "Server" => "localhost",
      "Database" => "database",
    ], "sqlsrv:Server=localhost;Database=database",
  ],
]);

test("pdo", function ()
{

  expect(Driver::SQLite->pdo([]))
  ->toBeInstanceOf(PDO::class);

});

test("connect", function ()
{

  expect($connection = Driver::SQLite->connect([]))
  ->toBeInstanceOf(Connection::class);

  expect($connection->driver)
  ->toBe(Driver::SQLite);

});

test("lazy connect", function ()
{

  expect($connection = Driver::SQLite->lazyConnect([]))
  ->toBeInstanceOf(LazyConnection::class);

  expect($connection->driver)
  ->toBe(Driver::SQLite);

});

test("sql", function ($driver, $sql)
{

  expect($driver->sql())
  ->toBe($sql);

})
->with([
  "mariadb" => [Driver::MariaDB, SQL::MariaDB],
  "mysql" => [Driver::MySQL, SQL::MySQL],
  "postgresql" => [Driver::PostgreSQL, SQL::PostgreSQL],
  "sqlite" => [Driver::SQLite, SQL::SQLite],
  "sqlserver" => [Driver::SQLServer, SQL::TransactSQL],
]);

$pdo = new PDO("sqlite:");

test("delete", function ($driver, $class, $table) use ($pdo)
{

  expect($stmt = $driver->delete($pdo, "t1"))
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

  expect($stmt = $driver->insert($pdo, [1]))
  ->toBeInstanceOf($class);

  expect("$stmt")
  ->toBe("INSERT VALUES (?)");

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

  expect($stmt = $driver->replace($pdo, [1]))
  ->toBeInstanceOf($class);

  expect("$stmt")
  ->toBe("REPLACE VALUES (?)");

})
->with([
  "mariadb" => [Driver::MariaDB, MariaDBReplace::class],
  "mysql" => [Driver::MySQL, MySQLReplace::class],
  "sqlite" => [Driver::SQLite, SQLiteReplace::class],
]);

test("cannot replace", function ($driver) use ($pdo)
{
  $driver->replace($pdo);
})
->throws(BadMethodCallException::class)
->with([
  "postgresql" => Driver::PostgreSQL,
  "sqlserver" => Driver::SQLServer,
]);

test("select", function ($driver, $class, $column) use ($pdo)
{

  expect($stmt = $driver->select($pdo, "c1"))
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

  expect($stmt = $driver->update($pdo, "t1"))
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