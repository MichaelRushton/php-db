<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\SQLiteConnection;
use MichaelRushton\DB\Drivers\SQLiteDriver;

beforeEach(function () {

    $this->driver = new SQLiteDriver([
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    ]);

});

test('connection', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->connection())
    ->toBe($connection);

});

test('exec', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->columns(['c1' => 1])->exec())
    ->toBe(0);

});

test('query', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->select()->columns(['c1' => '1'])->query())
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe([
        'c1' => 1,
    ]);

});

test('prepare', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->select()->columns(['c1' => 1])->prepare())
    ->toBeInstanceOf(PDOStatement::class);

    $stmt->execute([1]);

    expect($stmt->fetch())
    ->toBe([
        'c1' => '1',
    ]);

});

test('prepare cache', function () {

    $connection = new SQLiteConnection($this->driver);

    $stmt1 = $connection->select()->columns('1')->prepare();
    $stmt2 = $connection->select()->columns('1')->prepare();
    $stmt3 = $connection->select()->columns('2')->prepare();

    expect($stmt1)
    ->toBe($stmt2)
    ->not->toBe($stmt3);

    $id1 = spl_object_id($stmt1);

    unset($stmt3, $stmt2, $stmt1);

    expect(spl_object_id($connection->select()->columns('1')->prepare()))
    ->not->toBe($id1);

});

test('execute', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->select()->columns(['c1' => 1])->execute())
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe([
        'c1' => 1,
    ]);

});

test('fetch', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->columns(['c1' => 1])->fetch())
    ->toBe([
        'c1' => 1,
    ]);

});

test('fetch with mode', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->columns(['c1' => 1])->fetch(PDO::FETCH_NUM))
    ->toBe([
        0 => 1,
    ]);

});

test('fetch all', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->columns(['c1' => 1])->fetchAll())
    ->toBe([[
        'c1' => 1,
    ]]);

});

test('fetch all with mode', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->columns(['c1' => 1])->fetchAll(PDO::FETCH_NUM))
    ->toBe([[
        0 => 1,
    ]]);

});

test('fetch all column', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->columns([1, 2])->fetchAll(PDO::FETCH_COLUMN, 1))
    ->toBe([2]);

});

test('fetch all class', function () {

    $connection = new SQLiteConnection($this->driver);

    $class = new class () {
        public $c1;
        public function __construct(public $c2 = 0)
        {
        }
    };

    expect($object = $connection->select()->columns(['c1' => 1])->fetchAll(PDO::FETCH_CLASS, $class::class, [2])[0])
    ->toBeInstanceOf($class::class);

    expect((array) $object)
    ->toBe([
        'c1' => 1,
        'c2' => 2,
    ]);

});

test('fetch column', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->select()->columns([1, 2])->fetchColumn(1))
    ->toBe(2);

});

test('fetch object', function () {

    $connection = new SQLiteConnection($this->driver);

    $class = new class () {
        public $c1;
        public function __construct(public $c2 = 0)
        {
        }
    };

    expect($object = $connection->select()->columns(['c1' => 1])->fetchObject($class::class, constructorArgs: [2]))
    ->toBeInstanceOf($class::class);

    expect((array) $object)
    ->toBe([
        'c1' => 1,
        'c2' => 2,
    ]);

});

test('yield', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($rows = $connection->select()->columns(['c1' => 1])->yield())
    ->toBeInstanceOf(Generator::class);

    foreach ($rows as $row) {
    }

    expect($row)
    ->toBe([
        'c1' => 1,
    ]);

});

test('yield with mode', function () {

    $connection = new SQLiteConnection($this->driver);

    foreach ($connection->select()->columns(['c1' => 1])->yield(PDO::FETCH_NUM) as $row) {
    }

    expect($row)
    ->toBe([
        0 => 1,
    ]);

});
