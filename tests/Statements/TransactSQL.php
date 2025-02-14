<?php

declare(strict_types=1);

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Statements\TransactSQL\Delete;
use MichaelRushton\DB\Statements\TransactSQL\Insert;
use MichaelRushton\DB\Statements\TransactSQL\Select;
use MichaelRushton\DB\Statements\TransactSQL\Update;
use MichaelRushton\SQL\Statements\TransactSQL\Delete as TransactSQLDelete;
use MichaelRushton\SQL\Statements\TransactSQL\Insert as TransactSQLInsert;
use MichaelRushton\SQL\Statements\TransactSQL\Select as TransactSQLSelect;
use MichaelRushton\SQL\Statements\TransactSQL\Update as TransactSQLUpdate;

$pdo = new PDO("sqlite:");

test("delete", function () use ($pdo)
{

  expect($stmt = new Delete($pdo))
  ->toBeInstanceOf(TransactSQLDelete::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("insert", function () use ($pdo)
{

  expect($stmt = new Insert($pdo))
  ->toBeInstanceOf(TransactSQLInsert::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("select", function () use ($pdo)
{

  expect($stmt = new Select($pdo))
  ->toBeInstanceOf(TransactSQLSelect::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("update", function () use ($pdo)
{

  expect($stmt = new Update($pdo))
  ->toBeInstanceOf(TransactSQLUpdate::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});