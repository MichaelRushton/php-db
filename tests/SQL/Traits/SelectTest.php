<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Raw;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteInsert;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('select', function ($stmt, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteInsert(Get::connection())
        ->select($stmt)
    )
    ->toBe("INSERT $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['SELECT', 'SELECT'],
    [new Raw('SELECT ?', [1]), 'SELECT ?', [1]],
    [fn (SQLiteSelect $stmt) => $stmt->columns(1), 'SELECT ?', [1]],
]);
