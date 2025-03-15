<?php

declare(strict_types=1);

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Statements\MySQL\Delete;
use MichaelRushton\DB\Statements\MySQL\Insert;
use MichaelRushton\DB\Statements\MySQL\Replace;
use MichaelRushton\DB\Statements\MySQL\Select;
use MichaelRushton\DB\Statements\MySQL\Update;
use MichaelRushton\SQL\Statements\MySQL\Delete as MySQLDelete;
use MichaelRushton\SQL\Statements\MySQL\Insert as MySQLInsert;
use MichaelRushton\SQL\Statements\MySQL\Replace as MySQLReplace;
use MichaelRushton\SQL\Statements\MySQL\Select as MySQLSelect;
use MichaelRushton\SQL\Statements\MySQL\Update as MySQLUpdate;

$pdo = new PDO("sqlite:");

test("delete", function () use ($pdo)
{

  expect($stmt = new Delete($pdo))
  ->toBeInstanceOf(MySQLDelete::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("insert", function () use ($pdo)
{

  expect($stmt = new Insert($pdo))
  ->toBeInstanceOf(MySQLInsert::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("replace", function () use ($pdo)
{

  expect($stmt = new Replace($pdo))
  ->toBeInstanceOf(MySQLReplace::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("select", function () use ($pdo)
{

  expect($stmt = new Select($pdo))
  ->toBeInstanceOf(MySQLSelect::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("update", function () use ($pdo)
{

  expect($stmt = new Update($pdo))
  ->toBeInstanceOf(MySQLUpdate::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});