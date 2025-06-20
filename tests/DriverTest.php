<?php

declare(strict_types=1);

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Driver;
use MichaelRushton\DB\LazyConnection;
use MichaelRushton\SQL\SQL;

test("connect", function ()
{

  expect(Driver::SQLite->connect())
  ->toBeInstanceOf(Connection::class);

});

test("lazy connect", function ($driver)
{

  expect($connection = $driver->lazyConnect())
  ->toBeInstanceOf(LazyConnection::class);

  expect($connection->driver())
  ->toBe($driver);

})
->with(Driver::cases());

test("dsn", function ($driver, $config, $dsn)
{

  expect($driver->dsn($config))
  ->toBe($dsn);

})
->with([
  "mariadb" => [
    Driver::MariaDB, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "",
      "charset" => "utf8mb4",
    ], "mysql:host=localhost;port=3306;dbname=database;charset=utf8mb4",
  ],
  "mariadb with unix socket" => [
    Driver::MariaDB, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "/tmp/mysql.sock",
      "charset" => "utf8mb4",
    ], "mysql:unix_socket=/tmp/mysql.sock;dbname=database;charset=utf8mb4",
  ],
  "mysql" => [
    Driver::MySQL, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "",
      "charset" => "utf8mb4",
    ], "mysql:host=localhost;port=3306;dbname=database;charset=utf8mb4",
  ],
  "mysql with unix socket" => [
    Driver::MySQL, [
      "host" => "localhost",
      "port" => 3306,
      "dbname" => "database",
      "unix_socket" => "/tmp/mysql.sock",
      "charset" => "utf8mb4",
    ], "mysql:unix_socket=/tmp/mysql.sock;dbname=database;charset=utf8mb4",
  ],
  "postgresql" => [
    Driver::PostgreSQL, [
      "host" => "localhost",
      "port" => 5432,
      "dbname" => "database",
      "sslmode" => "prefer",
    ], "pgsql:host=localhost;port=5432;dbname=database;sslmode=prefer",
  ],
  "sqlite" => [
    Driver::SQLite, [
      "database" => ":memory:",
    ], "sqlite::memory:"
  ],
  "sqlserver" => [
    Driver::SQLServer, [
      "Server" => "localhost",
      "Database" => "database",
    ], "sqlsrv:Server=localhost;Database=database",
  ],
]);

test("sql", function ($driver, $sql)
{

  expect($driver->sql())
  ->toBe($sql);

})
->with([
  [Driver::MariaDB, SQL::MariaDB],
  [Driver::MySQL, SQL::MySQL],
  [Driver::PostgreSQL, SQL::PostgreSQL],
  [Driver::SQLite, SQL::SQLite],
  [Driver::SQLServer, SQL::TransactSQL],
]);