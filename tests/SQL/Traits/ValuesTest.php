<?php

declare(strict_types=1);

use MichaelRushton\DB\Drivers\MariaDBDriver;
use MichaelRushton\DB\Drivers\MySQLDriver;
use MichaelRushton\DB\Drivers\PostgreSQLDriver;
use MichaelRushton\DB\Drivers\SQLiteDriver;
use MichaelRushton\DB\Drivers\SQLServerDriver;
use MichaelRushton\DB\SQL\Components\Raw;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteInsert;

test('empty values', function ($driver, $expected) {

    expect(
        (string) $driver->connection()->insert()
        ->values([])
    )
    ->toBe("INSERT $expected");

})
->with([
    [new MariaDBDriver(), 'VALUES ()'],
    [new MySQLDriver(), 'VALUES ()'],
    [new PostgreSQLDriver(), 'DEFAULT VALUES'],
    [new SQLiteDriver(), 'DEFAULT VALUES'],
    [new SQLServerDriver(), 'DEFAULT VALUES'],
]);

test('values', function ($values, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteInsert(Get::connection())
        ->values($values)
    )
    ->toBe("INSERT VALUES ($expected)");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    [['test', 1, 1.1, true, null, new Raw('?', 1)], '?, ?, ?, ?, ?, ?', ['test', 1, 1.1, true, null, 1]],
    [[['test'], [1]], '?), (?', ['test', 1]],
]);

test('values with columns', function () {

    expect(
        (string) $stmt = new SQLiteInsert(Get::connection())
        ->values([[
            'c1' => 1,
            'c2' => 2,
        ], [
            'c2' => 4,
            'c1' => 3,
        ]])
    )
    ->toBe("INSERT (c1, c2) VALUES (?, ?), (?, ?)");

    expect($stmt->bindings())
    ->toBe([1, 2, 3, 4]);

});
