<?php

declare(strict_types=1);

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Statements\MariaDB\Delete;
use MichaelRushton\DB\Statements\MariaDB\Insert;
use MichaelRushton\DB\Statements\MariaDB\Replace;
use MichaelRushton\DB\Statements\MariaDB\Select;
use MichaelRushton\DB\Statements\MariaDB\Update;
use MichaelRushton\SQL\Statements\MariaDB\Delete as MariaDBDelete;
use MichaelRushton\SQL\Statements\MariaDB\Insert as MariaDBInsert;
use MichaelRushton\SQL\Statements\MariaDB\Replace as MariaDBReplace;
use MichaelRushton\SQL\Statements\MariaDB\Select as MariaDBSelect;
use MichaelRushton\SQL\Statements\MariaDB\Update as MariaDBUpdate;

$pdo = new PDO("sqlite:");

test("delete", function () use ($pdo)
{

  expect($stmt = new Delete($pdo))
  ->toBeInstanceOf(MariaDBDelete::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("insert", function () use ($pdo)
{

  expect($stmt = new Insert($pdo))
  ->toBeInstanceOf(MariaDBInsert::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("replace", function () use ($pdo)
{

  expect($stmt = new Replace($pdo))
  ->toBeInstanceOf(MariaDBReplace::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("select", function () use ($pdo)
{

  expect($stmt = new Select($pdo))
  ->toBeInstanceOf(MariaDBSelect::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});

test("update", function () use ($pdo)
{

  expect($stmt = new Update($pdo))
  ->toBeInstanceOf(MariaDBUpdate::class);

  expect($stmt)
  ->toBeInstanceOf(PDOInterface::class);

});