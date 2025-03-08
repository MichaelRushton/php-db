<?php

declare(strict_types=1);

use MichaelRushton\DB\Statements\SQLite\Select;

$pdo = new PDO("sqlite:", options: [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT
]);

beforeEach(function () use ($pdo)
{

  $this->pdo = $pdo;

  $pdo->query("DROP TABLE IF EXISTS t1");

  $pdo->query("CREATE TABLE t1 (id INTEGER PRIMARY KEY)");

  $pdo->query("INSERT INTO t1 VALUES (1), (2)");

});

test("cache", function ()
{

  $stmt = (new Select($this->pdo))
  ->from("t1");

  expect($stmt->cache()->prepare())
  ->not->toBe($stmt->cache()->prepare());

  expect($stmt->cache()->prepare())->toBe($stmt->cache()->prepare());

});

test("query", function ()
{

  expect(
    $stmt = (new Select($this->pdo))
    ->from("t1")
    ->query()
  )
  ->toBeInstanceOf(PDOStatement::class);

  expect($stmt->fetchAll())
  ->toBe([[
    "id" => 1,
    0 => 1,
  ], [
    "id" => 2,
    0 => 2,
  ]]);

});

test("query with arguments", function ()
{

  expect(
    $stmt = (new Select($this->pdo))
    ->from("t1")
    ->query(PDO::FETCH_COLUMN, 0)
  )
  ->toBeInstanceOf(PDOStatement::class);

  expect($stmt->fetchAll())
  ->toBe([1, 2]);

});

test("prepare", function ()
{

  expect(
    $stmt = (new Select($this->pdo))
    ->from("t1")
    ->prepare()
  )
  ->toBeInstanceOf(PDOStatement::class);

  expect($stmt->fetchAll())
  ->toBe([]);

  $stmt->execute();

  expect($stmt->fetchAll(PDO::FETCH_ASSOC))
  ->toBe([["id" => 1], ["id" => 2]]);

});

test("execute", function ()
{

  expect(
    $stmt = (new Select($this->pdo))
    ->from("t1")
    ->execute()
  )
  ->toBeInstanceOf(PDOStatement::class);

  expect($stmt->fetchAll(PDO::FETCH_ASSOC))
  ->toBe([["id" => 1], ["id" => 2]]);

});

test("execute with parameters", function ()
{

  expect(
    $stmt = (new Select($this->pdo))
    ->from("t1")
    ->whereRaw("id = ?")
    ->execute([1])
  )
  ->toBeInstanceOf(PDOStatement::class);

  expect($stmt->fetchAll(PDO::FETCH_ASSOC))
  ->toBe([["id" => 1]]);

});

test("execute failure", function ()
{

  expect(
    (new Select($this->pdo))
    ->execute()
  )
  ->toBeFalse();

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->execute([1])
  )
  ->toBeFalse();

});

test("fetch", function ()
{

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->fetch()
  )
  ->toBe([
    "id" => 1,
    0 => 1,
  ]);

});

test("fetch with arguments", function ()
{

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->fetch(PDO::FETCH_ASSOC)
  )
  ->toBe(["id" => 1]);

});

test("fetch failure", function ()
{

  expect(
    (new Select($this->pdo))
    ->fetch()
  )
  ->toBeFalse();

});

test("fetch all", function ()
{

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->fetchAll()
  )
  ->toBe([[
    "id" => 1,
    0 => 1,
  ], [
    "id" => 2,
    0 => 2,
  ]]);

});

test("fetch all with arguments", function ()
{

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->fetchAll(PDO::FETCH_ASSOC)
  )
  ->toBe([["id" => 1], ["id" => 2]]);

});

test("fetch all failure", function ()
{

  expect(
    (new Select($this->pdo))
    ->fetchAll()
  )
  ->toBeFalse();

});