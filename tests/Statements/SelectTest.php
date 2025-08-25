<?php

declare(strict_types=1);

use MichaelRushton\DB\Driver;
use MichaelRushton\DB\LazyConnection;
use MichaelRushton\DB\Statements\Select;
use MichaelRushton\SQL\Components\Raw;
use MichaelRushton\SQL\SQL;

test("connection", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect($stmt->connection())
    ->toBe($connection);

});

test("sql", function ($sql) {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, $sql);

    expect($stmt->sql())
    ->toBe($sql);

})
->with(SQL::cases());

test("exec", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect($stmt->columns("1")->exec())
    ->toBe(0);

});

test("query", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect($stmt = $stmt->columns("1 c1")->query())
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["c1" => 1]);

});

test("query with arguments", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->columns("1 c1")
    ->query(PDO::FETCH_COLUMN, 0)
    )
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe(1);

});

test("prepare", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->columns("? c1")
    ->prepare()
    )
    ->toBeInstanceOf(PDOStatement::class);

    $stmt->execute([1]);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["c1" => "1"]);

});

test("cache", function () {

    $connection = new LazyConnection(Driver::SQLite);

    createTestTable($connection->pdo());

    $stmt1 = new Select($connection, SQL::SQLite);
    $stmt2 = new Select($connection, SQL::SQLite);
    $stmt3 = new Select($connection, SQL::SQLite);

    expect($stmt1->from("test")->cache()->prepare())
    ->toBe($stmt1->prepare())
    ->toBe($stmt2->from("test")->cache()->prepare())
    ->toBe($stmt2->prepare())
    ->not->toBe($stmt3->from("test")->cache(1)->prepare());

});

test("execute", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt = $stmt->columns(new Raw("? c1", 1))
    ->execute()
    )
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch(PDO::FETCH_ASSOC))
    ->toBe(["c1" => 1]);

});

test("fetch", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt->columns(new Raw("? c1", 1))
    ->fetch()
    )
    ->toBe(["c1" => 1, 0 => 1]);

});

test("fetch with fetch mode", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt->columns(new Raw("? c1", 1))
    ->fetch(PDO::FETCH_ASSOC)
    )
    ->toBe(["c1" => 1]);

});

test("fetch all", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt->columns(new Raw("? c1", 1))
    ->fetchAll()
    )
    ->toBe([["c1" => 1, 0 => 1]]);

});

test("fetch all with fetch mode", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt->columns(new Raw("? c1", 1))
    ->fetchAll(PDO::FETCH_ASSOC)
    )
    ->toBe([["c1" => 1]]);

});

test("fetch column", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt->columns(new Raw("?", 1))
    ->fetchColumn()
    )
    ->toBe(1);

});

test("fetch numbered column", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $stmt->columns(new Raw("?, ?", [1, 2]))
    ->fetchColumn(1)
    )
    ->toBe(2);

});

test("fetch object", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $obj = $stmt->columns(new Raw("? id", 1))
    ->fetchObject()
    )
    ->toBeInstanceOf(stdClass::class);

    expect($obj->id)
    ->toBe(1);

});

test("fetch named object", function () {

    $connection = new LazyConnection(Driver::SQLite);

    $stmt = new Select($connection, SQL::SQLite);

    expect(
        $obj = $stmt->columns(new Raw("? id", 1))
    ->fetchObject(Test::class, [1])
    )
    ->toBeInstanceOf(Test::class);

    expect($obj->id)
    ->toBe(2);

});
