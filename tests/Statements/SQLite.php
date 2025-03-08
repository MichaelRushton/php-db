<?php

declare(strict_types=1);

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Statements\SQLite\Delete;
use MichaelRushton\DB\Statements\SQLite\Insert;
use MichaelRushton\DB\Statements\SQLite\Replace;
use MichaelRushton\DB\Statements\SQLite\Select;
use MichaelRushton\DB\Statements\SQLite\Update;
use MichaelRushton\SQL\Statements\SQLite\Delete as SQLiteDelete;
use MichaelRushton\SQL\Statements\SQLite\Insert as SQLiteInsert;
use MichaelRushton\SQL\Statements\SQLite\Replace as SQLiteReplace;
use MichaelRushton\SQL\Statements\SQLite\Select as SQLiteSelect;
use MichaelRushton\SQL\Statements\SQLite\Update as SQLiteUpdate;

$pdo = new PDO("sqlite:");

test("delete", function () use ($pdo)
{

  expect($stmt = new Delete($pdo))
  ->toBeInstanceOf(SQLiteDelete::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("insert", function () use ($pdo)
{

  expect($stmt = new Insert($pdo))
  ->toBeInstanceOf(SQLiteInsert::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("replace", function () use ($pdo)
{

  expect($stmt = new Replace($pdo))
  ->toBeInstanceOf(SQLiteReplace::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("select", function () use ($pdo)
{

  expect($stmt = new Select($pdo))
  ->toBeInstanceOf(SQLiteSelect::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("update", function () use ($pdo)
{

  expect($stmt = new Update($pdo))
  ->toBeInstanceOf(SQLiteUpdate::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});