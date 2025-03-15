<?php

declare(strict_types=1);

use MichaelRushton\DB\Statements\SQLite\Select;

$pdo = new PDO("sqlite:", options: [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT
]);

function createTables($pdo)
{

  $pdo->query("DROP TABLE IF EXISTS t1");

  $pdo->query("CREATE TABLE t1 (id INTEGER PRIMARY KEY)");

  $pdo->query("INSERT INTO t1 VALUES (1), (2)");

  $pdo->query("DROP TABLE IF EXISTS t2");

  $pdo->query("CREATE TABLE t2 (id INTEGER PRIMARY KEY)");

}

beforeEach(function () use ($pdo)
{

  $this->pdo = $pdo;

  createTables($pdo);

});

test("cache", function ()
{

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->prepare()
  )
  ->not->toBe(
    (new Select($this->pdo))
    ->from("t1")
    ->prepare()
  );

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->cache()
    ->prepare()
  )
  ->not->toBe(
    (new Select($this->pdo))
    ->from("t1")
    ->prepare()
  );

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->cache()
    ->prepare()
  )
  ->toBe(
    (new Select($this->pdo))
    ->from("t1")
    ->cache()
    ->prepare()
  );

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->cache()
    ->prepare()
  )
  ->not->toBe(
    (new Select($this->pdo))
    ->from("t2")
    ->cache()
    ->prepare()
  );

  createTables($pdo = new PDO("sqlite:"));

  expect(
    (new Select($this->pdo))
    ->from("t1")
    ->cache()
    ->prepare()
  )
  ->not->toBe(
    (new Select($pdo))
    ->from("t1")
    ->cache()
    ->prepare()
  );

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