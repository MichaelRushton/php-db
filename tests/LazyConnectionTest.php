<?php

declare(strict_types=1);

use MichaelRushton\DB\Driver;
use MichaelRushton\DB\LazyConnection;
use MichaelRushton\DB\Statements\SQLite\Delete;
use MichaelRushton\DB\Statements\SQLite\Insert;
use MichaelRushton\DB\Statements\SQLite\Replace;
use MichaelRushton\DB\Statements\SQLite\Select;
use MichaelRushton\DB\Statements\SQLite\Update;

test("driver", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($connection->driver())
  ->toBe(Driver::SQLite);

});

test("pdo", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($connection->pdo())
  ->toBeInstanceOf(PDO::class);

});

test("delete", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($stmt = $connection->delete("t1"))
  ->toBeInstanceOf(Delete::class);

  expect("$stmt")
  ->toBe('DELETE FROM "t1"');

});

test("insert", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($stmt = $connection->insert([1]))
  ->toBeInstanceOf(Insert::class);

  expect("$stmt")
  ->toBe("INSERT VALUES (?)");

});

test("replace", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($stmt = $connection->replace([1]))
  ->toBeInstanceOf(Replace::class);

  expect("$stmt")
  ->toBe("REPLACE VALUES (?)");

});

test("select", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($stmt = $connection->select("c1"))
  ->toBeInstanceOf(Select::class);

  expect("$stmt")
  ->toBe('SELECT "c1"');

});

test("update", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($stmt = $connection->update("t1"))
  ->toBeInstanceOf(Update::class);

  expect("$stmt")
  ->toBe('UPDATE "t1"');

});

test("transaction", function ()
{

  $connection = new LazyConnection(Driver::SQLite);

  expect($connection->transaction(function ()
  {

    $this->pdo->query("DROP TABLE IF EXISTS t1");

    $this->pdo->query("CREATE TABLE t1 (id INTEGER PRIMARY KEY)");

    $this->insert([1])->into("t1")->execute();

  }))
  ->toBeTrue();

  expect($connection->select()->from("t1")->fetchAll(PDO::FETCH_ASSOC))
  ->toBe([["id" => 1]]);

});