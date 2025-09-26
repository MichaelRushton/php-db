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

test('driver', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->driver())
    ->toBe($this->driver);

});

test('pdo', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->pdo())
    ->toBeInstanceOf(PDO::class);

});

test('exec', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->exec("SELECT 1"))
    ->toBe(0);

});

test('query', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->query("SELECT 1 c1"))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe([
        'c1' => 1,
    ]);

});

test('prepare', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->prepare("SELECT ? c1"))
    ->toBeInstanceOf(PDOStatement::class);

    $stmt->execute([1]);

    expect($stmt->fetch())
    ->toBe([
        'c1' => '1',
    ]);

});

test('prepare cache', function () {

    $connection = new SQLiteConnection($this->driver);

    $stmt1 = $connection->prepare("SELECT 1");
    $stmt2 = $connection->prepare("SELECT 1");
    $stmt3 = $connection->prepare("SELECT 2");

    expect($stmt1)
    ->toBe($stmt2)
    ->not->toBe($stmt3);

    $id1 = spl_object_id($stmt1);

    unset($stmt1, $stmt2, $stmt3);

    expect(spl_object_id($connection->prepare("SELECT 1")))
    ->not->toBe($id1);

});

test('execute', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->execute("SELECT 1 c1"))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe([
        'c1' => 1,
    ]);

});

test('execute with params', function ($param, $expected) {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->execute("SELECT ? c1", $param))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe([
        'c1' => $expected,
    ]);

})
->with([
    ['1', '1'],
    [1, 1],
    [1.1, '1.1'],
    [true, 1],
    [[null], null],
]);

test('execute with named params', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($stmt = $connection->execute("SELECT :c1 c1", ['c1' => 1]))
    ->toBeInstanceOf(PDOStatement::class);

    expect($stmt->fetch())
    ->toBe([
        'c1' => 1,
    ]);

});

test('execute failure', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->execute("SELECT"))
    ->toBeFalse();

    expect($connection->execute("SELECT 1", 1))
    ->toBeFalse();

});

test('fetch', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetch("SELECT 1 c1"))
    ->toBe([
        'c1' => 1,
    ]);

});

test('fetch with params', function ($param, $expected) {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetch("SELECT ? c1", $param))
    ->toBe([
        'c1' => $expected,
    ]);

})
->with([
    ['1', '1'],
    [1, 1],
    [1.1, '1.1'],
    [true, 1],
    [[null], null],
]);

test('fetch with mode', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetch("SELECT 1 c1", mode: PDO::FETCH_NUM))
    ->toBe([
        0 => 1,
    ]);

});

test('fetch failure', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetch("SELECT"))
    ->toBeFalse();

});

test('fetch all', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchAll("SELECT 1 c1"))
    ->toBe([[
        'c1' => 1,
    ]]);

});

test('fetch all with params', function ($param, $expected) {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchAll("SELECT ? c1", $param))
    ->toBe([[
        'c1' => $expected,
    ]]);

})
->with([
    ['1', '1'],
    [1, 1],
    [1.1, '1.1'],
    [true, 1],
    [[null], null],
]);

test('fetch all with mode', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchAll("SELECT 1 c1", mode: PDO::FETCH_NUM))
    ->toBe([[
        0 => 1,
    ]]);

});

test('fetch all column', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchAll("SELECT 1 c1, 2 c2", null, PDO::FETCH_COLUMN, 1))
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

    expect($object = $connection->fetchAll("SELECT 1 c1", null, PDO::FETCH_CLASS, $class::class, [2])[0])
    ->toBeInstanceOf($class::class);

    expect((array) $object)
    ->toBe([
        'c1' => 1,
        'c2' => 2,
    ]);

});

test('fetch all failure', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchAll("SELECT"))
    ->toBeFalse();

});

test('fetch column', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchColumn("SELECT 1 c1, 2 c2", column: 1))
    ->toBe(2);

});

test('fetch column with params', function ($param, $expected) {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchColumn("SELECT 0 c1, ? c2", $param, 1))
    ->toBe($expected);

})
->with([
    ['1', '1'],
    [1, 1],
    [1.1, '1.1'],
    [true, 1],
    [[null], null],
]);

test('fetch column failure', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchColumn("SELECT"))
    ->toBeFalse();

});

test('fetch object', function () {

    $connection = new SQLiteConnection($this->driver);

    $class = new class () {
        public $c1;
        public function __construct(public $c2 = 0)
        {
        }
    };

    expect($object = $connection->fetchObject("SELECT 1 c1", class: $class::class, constructorArgs: [2]))
    ->toBeInstanceOf($class::class);

    expect((array) $object)
    ->toBe([
        'c1' => 1,
        'c2' => 2,
    ]);

});

test('fetch object with params', function ($param, $expected) {

    $connection = new SQLiteConnection($this->driver);

    expect((array) $connection->fetchObject("SELECT ? c1", $param))
    ->toBe([
        'c1' => $expected,
    ]);

})
->with([
    ['1', '1'],
    [1, 1],
    [1.1, '1.1'],
    [true, 1],
    [[null], null],
]);

test('fetch object failure', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->fetchObject("SELECT"))
    ->toBeFalse();

});

test('yield', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($rows = $connection->yield("SELECT 1 c1"))
    ->toBeInstanceOf(Generator::class);

    foreach ($rows as $row) {
    }

    expect($row)
    ->toBe([
        'c1' => 1,
    ]);

});

test('yield with params', function ($param, $expected) {

    $connection = new SQLiteConnection($this->driver);

    foreach ($connection->yield("SELECT ? c1", $param) as $row) {
    }

    expect($row)
    ->toBe([
        'c1' => $expected,
    ]);

})
->with([
    ['1', '1'],
    [1, 1],
    [1.1, '1.1'],
    [true, 1],
    [[null], null],
]);

test('yield with mode', function () {

    $connection = new SQLiteConnection($this->driver);

    foreach ($connection->yield("SELECT 1 c1", mode: PDO::FETCH_NUM) as $row) {
    }

    expect($row)
    ->toBe([
        0 => 1,
    ]);

});

test('yield failure', function () {

    $connection = new SQLiteConnection($this->driver);

    foreach ($connection->yield("SELECT") as $row) {
    }

    expect(isset($row))
    ->toBeFalse();

});

test('transaction', function () {

    $connection = new SQLiteConnection($this->driver);

    expect($connection->transaction(function (SQLiteConnection $c) use ($connection) {

        expect($c->pdo()->inTransaction())
        ->toBeTrue();

        expect($c)
        ->toBe($connection);

    }))
    ->toBeTrue();

    expect($connection->pdo()->inTransaction())
    ->toBeFalse();

});

test('transaction rolls back on throwable', function () {

    $connection = new SQLiteConnection($this->driver);

    try {
        $connection->transaction(fn () => throw new Exception());
    } finally {

        expect($connection->pdo()->inTransaction())
        ->toBeFalse();

    }

})
->throws(Exception::class);
