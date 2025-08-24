<?php

declare(strict_types=1);

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Driver;
use MichaelRushton\DB\Statements\Delete;
use MichaelRushton\DB\Statements\Insert;
use MichaelRushton\DB\Statements\Replace;
use MichaelRushton\DB\Statements\Select;
use MichaelRushton\DB\Statements\Update;

test("driver", function ($driver) {

    $connection = new Connection($driver, new PDO("sqlite:"));

    expect($connection->driver())
    ->toBe($driver);

})
->with(Driver::cases());

test("pdo", function () {

    $connection = new Connection(Driver::SQLite, $pdo = new PDO("sqlite:"));

    expect($connection->pdo())
    ->toBe($pdo);

});

test("exec", function () {

    $connection = new Connection(Driver::SQLite, $pdo = new PDO("sqlite:"));

    createTestTable($pdo);

    $pdo->query("INSERT INTO test VALUES (1, ''), (2, '')");

    expect($connection->exec("DELETE FROM test WHERE id = 1"))
    ->toBe(1);

});

test("query", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($stmt = $connection->query("SELECT 1 c1"))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["c1" => 1]);

});

test("query with arguments", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($stmt = $connection->query("SELECT 1 c1", PDO::FETCH_COLUMN, 0))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe(1);

});

test("prepare", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($stmt = $connection->prepare("SELECT ? c1"))
    ->toBeInstanceOf(PDOStatement::class);

    $stmt->execute([1]);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["c1" => "1"]);

});

test("execute", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($stmt = $connection->execute("SELECT 1 c1"))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["c1" => 1]);

});

test("execute with parameters", function ($param, $expected) {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($stmt = $connection->execute("SELECT ? c1", [$param]))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["c1" => $expected]);

})
->with([
  [true, 1],
  [1, 1],
  [null, null],
  ["test", "test"],
]);

test("execute failure", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:", options: [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    ]));

    expect($connection->execute("SELECT"))
    ->toBeFalse();

    expect($connection->execute("SELECT 1", [1]))
    ->toBeFalse();

});

test("fetch", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($connection->fetch("SELECT ? c1", [1]))
    ->toBe(["c1" => 1, 0 => 1]);

});

test("fetch with fetch mode", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($connection->fetch("SELECT ? c1", [1], PDO::FETCH_ASSOC))
    ->toBe(["c1" => 1]);

});

test("fetch failure", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:", options: [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    ]));

    expect($connection->fetch("SELECT"))
    ->toBeFalse();

});

test("fetch all", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($connection->fetchAll("SELECT ? c1", [1]))
    ->toBe([["c1" => 1, 0 => 1]]);

});

test("fetch all with fetch mode", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($connection->fetchAll("SELECT ? c1", [1], PDO::FETCH_COLUMN, 0))
    ->toBe([1]);

});

test("fetch all failure", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:", options: [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    ]));

    expect($connection->fetchAll("SELECT"))
    ->toBeFalse();

});

test("fetch column", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($connection->fetchColumn("SELECT ?", [1]))
    ->toBe(1);

});

test("fetch numbered column", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($connection->fetchColumn("SELECT ?, ?", [1, 2], 1))
    ->toBe(2);

});

test("fetch column failure", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:", options: [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    ]));

    expect($connection->fetchColumn("SELECT"))
    ->toBeFalse();

});

test("fetch object", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($obj = $connection->fetchObject("SELECT ? id", [1]))
    ->toBeInstanceOf(stdClass::class);

    expect($obj->id)
    ->toBe(1);

});

test("fetch named object", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:"));

    expect($obj = $connection->fetchObject("SELECT ? id", [1], Test::class, [1]))
    ->toBeInstanceOf(Test::class);

    expect($obj->id)
    ->toBe(2);

});

test("fetch object failure", function () {

    $connection = new Connection(Driver::SQLite, new PDO("sqlite:", options: [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    ]));

    expect($connection->fetchObject("SELECT"))
    ->toBeFalse();

});

test("commit transaction", function () {

    $connection = new Connection(Driver::SQLite, $pdo = new PDO("sqlite:"));

    createTestTable($pdo);

    expect($connection->transaction(function ($connection) {

        $connection->query("INSERT INTO test DEFAULT VALUES");

        $connection->query("INSERT INTO test DEFAULT VALUES");

    }))
    ->toBeTrue();

    expect($pdo->query("SELECT * FROM test")->fetchAll(PDO::FETCH_ASSOC))
    ->toBe([
      ["id" => 1, "c1" => ""],
      ["id" => 2, "c1" => ""],
    ]);

});

test("roll back transaction", function () {

    $connection = new Connection(Driver::SQLite, $pdo = new PDO("sqlite:"));

    createTestTable($pdo);

    try {

        $connection->transaction(function ($connection) {

            $connection->query("INSERT INTO test DEFAULT VALUES");

            throw new Exception();

        });

    } finally {

        expect($pdo->query("SELECT * FROM test")->fetch())
        ->toBeFalse();

    }

})
->throws(Exception::class);

test("delete", function ($driver) {

    $connection = new Connection($driver, new PDO("sqlite:"));

    expect($stmt = $connection->delete())
    ->toBeInstanceOf(Delete::class);

    expect($stmt->connection())
    ->toBe($connection);

    expect($stmt->sql())
    ->toBe($driver->sql());


})
->with(Driver::cases());

test("insert", function ($driver) {

    $connection = new Connection($driver, new PDO("sqlite:"));

    expect($stmt = $connection->insert())
    ->toBeInstanceOf(Insert::class);

    expect($stmt->connection())
    ->toBe($connection);

    expect($stmt->sql())
    ->toBe($driver->sql());


})
->with(Driver::cases());

test("replace", function ($driver) {

    $connection = new Connection($driver, new PDO("sqlite:"));

    expect($stmt = $connection->replace())
    ->toBeInstanceOf(Replace::class);

    expect($stmt->connection())
    ->toBe($connection);

    expect($stmt->sql())
    ->toBe($driver->sql());


})
->with([
  Driver::MariaDB,
  Driver::MySQL,
  Driver::SQLite,
]);

test("cannot replace", function ($driver) {

    $connection = new Connection($driver, new PDO("sqlite:"));

    (string) $connection->replace();

})
->throws(BadMethodCallException::class)
->with([
  Driver::PostgreSQL,
  Driver::SQLServer,
]);

test("select", function ($driver) {

    $connection = new Connection($driver, new PDO("sqlite:"));

    expect($stmt = $connection->select())
    ->toBeInstanceOf(Select::class);

    expect($stmt->connection())
    ->toBe($connection);

    expect($stmt->sql())
    ->toBe($driver->sql());


})
->with(Driver::cases());

test("update", function ($driver) {

    $connection = new Connection($driver, new PDO("sqlite:"));

    expect($stmt = $connection->update())
    ->toBeInstanceOf(Update::class);

    expect($stmt->connection())
    ->toBe($connection);

    expect($stmt->sql())
    ->toBe($driver->sql());


})
->with(Driver::cases());
