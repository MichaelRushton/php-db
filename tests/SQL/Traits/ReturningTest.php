<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLDelete;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('returning all', function () {

    expect(
        (string) new PostgreSQLDelete(Get::connection())
        ->returning()
    )
    ->toBe("DELETE RETURNING *");

});

test('returning', function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = new PostgreSQLDelete(Get::connection())
        ->returning($column)
    )
    ->toBe("DELETE RETURNING $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['c1', 'c1'],
    [1, '?', [1]],
    [1.1, '?', [1.1]],
    [true, '?', [true]],
    [null, '?', [null]],
    [new SQLiteSelect(Get::connection())->columns(1), '(SELECT ?)', [1]],
    [['c1', 'c3' => 'c2'], 'c1, c2 c3'],
]);

test('returning spread', function () {

    expect(
        (string) new PostgreSQLDelete(Get::connection())
        ->returning('c1', 'c2', ['c3', 'c5' => 'c4'])
    )
    ->toBe("DELETE RETURNING c1, c2, c3, c4 c5");

});
