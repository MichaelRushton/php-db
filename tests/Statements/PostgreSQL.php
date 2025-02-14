<?php

declare(strict_types=1);

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Statements\PostgreSQL\Delete;
use MichaelRushton\DB\Statements\PostgreSQL\Insert;
use MichaelRushton\DB\Statements\PostgreSQL\Select;
use MichaelRushton\DB\Statements\PostgreSQL\Update;
use MichaelRushton\SQL\Statements\PostgreSQL\Delete as PostgreSQLDelete;
use MichaelRushton\SQL\Statements\PostgreSQL\Insert as PostgreSQLInsert;
use MichaelRushton\SQL\Statements\PostgreSQL\Select as PostgreSQLSelect;
use MichaelRushton\SQL\Statements\PostgreSQL\Update as PostgreSQLUpdate;

$pdo = new PDO("sqlite:");

test("delete", function () use ($pdo)
{

  expect($stmt = new Delete($pdo))
  ->toBeInstanceOf(PostgreSQLDelete::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("insert", function () use ($pdo)
{

  expect($stmt = new Insert($pdo))
  ->toBeInstanceOf(PostgreSQLInsert::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("select", function () use ($pdo)
{

  expect($stmt = new Select($pdo))
  ->toBeInstanceOf(PostgreSQLSelect::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("update", function () use ($pdo)
{

  expect($stmt = new Update($pdo))
  ->toBeInstanceOf(PostgreSQLUpdate::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});