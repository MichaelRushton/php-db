<?php

declare(strict_types=1);

use MichaelRushton\DB\Driver;
use MichaelRushton\DB\LazyConnection;
use MichaelRushton\DB\Statements\Replace;
use MichaelRushton\SQL\SQL;

test("connection", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Replace($connection, SQL::SQLite);

    expect($stmt->connection())
    ->toBe($connection);

});

test("sql", function ($sql) {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Replace($connection, $sql);

    expect($stmt->sql())
    ->toBe($sql);

})
->with(SQL::cases());

test("exec", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->into("test")
    ->exec()
    )
    ->toBe(1);

});

test("query", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->into("test")
    ->returning()
    ->query()
    )
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["id" => 1, "c1" => ""]);

});

test("query with arguments", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->into("test")
    ->returning()
    ->query(PDO::FETCH_COLUMN, 0)
    )
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe(1);

});

test("prepare", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->prepare()
    )
    ->toBeInstanceOf(PDOStatement::class);

    $stmt->execute([1, ""]);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["id" => 1, "c1" => ""]);

});

test("cache", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt1 = new Replace($connection, SQL::SQLite);
    $stmt2 = new Replace($connection, SQL::SQLite);
    $stmt3 = new Replace($connection, SQL::SQLite);

    expect($stmt1->into("test")->cache()->prepare())
    ->toBe($stmt1->prepare())
    ->toBe($stmt2->into("test")->cache()->prepare())
    ->toBe($stmt2->prepare())
    ->not->toBe($stmt3->into("test")->cache(1)->prepare());

});

test("execute", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->execute()
    )
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["id" => 1, "c1" => ""]);

});

test("execute with new params", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->into("test")
    ->values([0, ""])
    ->returning()
    ->execute([1, ""])
    )
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["id" => 1, "c1" => ""]);

});

test("fetch", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetch()
    )
    ->toBe(["id" => 1, 0 => 1, "c1" => "", 1 => ""]);

});

test("fetch with new params", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([0, ""])
    ->returning()
    ->fetch([1, ""])
    )
    ->toBe(["id" => 1, 0 => 1, "c1" => "", 1 => ""]);

});

test("fetch with fetch mode", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetch(mode: PDO::FETCH_ASSOC)
    )
    ->toBe(["id" => 1, "c1" => ""]);

});

test("fetch all", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetchAll()
    )
    ->toBe([["id" => 1, 0 => 1, "c1" => "", 1 => ""]]);

});

test("fetch all with new params", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([0, ""])
    ->returning()
    ->fetchAll([1, ""])
    )
    ->toBe([["id" => 1, 0 => 1, "c1" => "", 1 => ""]]);

});

test("fetch all with fetch mode", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetchAll(mode: PDO::FETCH_ASSOC)
    )
    ->toBe([["id" => 1, "c1" => ""]]);

});

test("fetch column", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetchColumn()
    )
    ->toBe(1);

});

test("fetch column with new params", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([0, ""])
    ->returning()
    ->fetchColumn([1, ""])
    )
    ->toBe(1);

});

test("fetch numbered column", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetchColumn(column: 1)
    )
    ->toBe("");

});

test("fetch object", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $obj = $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetchObject()
    )
    ->toBeInstanceOf(stdClass::class);

    expect($obj->id)
    ->toBe(1);

});

test("fetch object with new params", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $obj = $stmt->into("test")
    ->values([0, ""])
    ->returning()
    ->fetchObject([1, ""])
    )
    ->toBeInstanceOf(stdClass::class);

    expect($obj->id)
    ->toBe(1);

});

test("fetch named object", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt = new Replace($connection, SQL::SQLite);

    expect(
        $obj = $stmt->into("test")
    ->values([1, ""])
    ->returning()
    ->fetchObject(class: Test::class, constructorArgs: [1])
    )
    ->toBeInstanceOf(Test::class);

    expect($obj->id)
    ->toBe(2);

});
