<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('union', function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->union($stmt)
    )
    ->toBe("SELECT * UNION $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT', 'SELECT'],
    [new SQLiteSelect(Get::connection())->columns(1), 'SELECT ?', [1]],
    [fn ($stmt) => $stmt->columns(1), 'SELECT ?', [1]],
    [['SELECT 1', 'SELECT 2'], 'SELECT 1 UNION SELECT 2'],
]);

test('union all', function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->unionAll($stmt)
    )
    ->toBe("SELECT * UNION ALL $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT', 'SELECT'],
    [new SQLiteSelect(Get::connection())->columns(1), 'SELECT ?', [1]],
    [fn ($stmt) => $stmt->columns(1), 'SELECT ?', [1]],
    [['SELECT 1', 'SELECT 2'], 'SELECT 1 UNION ALL SELECT 2'],
]);

test('intersect', function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->intersect($stmt)
    )
    ->toBe("SELECT * INTERSECT $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT', 'SELECT'],
    [new SQLiteSelect(Get::connection())->columns(1), 'SELECT ?', [1]],
    [fn ($stmt) => $stmt->columns(1), 'SELECT ?', [1]],
    [['SELECT 1', 'SELECT 2'], 'SELECT 1 INTERSECT SELECT 2'],
]);

test('intersect all', function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->intersectAll($stmt)
    )
    ->toBe("SELECT * INTERSECT ALL $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT', 'SELECT'],
    [new SQLiteSelect(Get::connection())->columns(1), 'SELECT ?', [1]],
    [fn ($stmt) => $stmt->columns(1), 'SELECT ?', [1]],
    [['SELECT 1', 'SELECT 2'], 'SELECT 1 INTERSECT ALL SELECT 2'],
]);

test('except', function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->except($stmt)
    )
    ->toBe("SELECT * EXCEPT $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT', 'SELECT'],
    [new SQLiteSelect(Get::connection())->columns(1), 'SELECT ?', [1]],
    [fn ($stmt) => $stmt->columns(1), 'SELECT ?', [1]],
    [['SELECT 1', 'SELECT 2'], 'SELECT 1 EXCEPT SELECT 2'],
]);

test('except all', function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->exceptAll($stmt)
    )
    ->toBe("SELECT * EXCEPT ALL $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT', 'SELECT'],
    [new SQLiteSelect(Get::connection())->columns(1), 'SELECT ?', [1]],
    [fn ($stmt) => $stmt->columns(1), 'SELECT ?', [1]],
    [['SELECT 1', 'SELECT 2'], 'SELECT 1 EXCEPT ALL SELECT 2'],
]);
