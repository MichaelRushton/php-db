<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteInsert;

test('columns', function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteInsert(Get::connection())
        ->columns($column)
    )
    ->toBe("INSERT ($expected) DEFAULT VALUES");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['c1', 'c1'],
    [['c1', 'c2'], 'c1, c2'],
]);

test('columns spread', function () {

    expect(
        (string) new SQLiteInsert(Get::connection())
        ->columns('c1', 'c2', ['c3', 'c4'])
    )
    ->toBe("INSERT (c1, c2, c3, c4) DEFAULT VALUES");

});
