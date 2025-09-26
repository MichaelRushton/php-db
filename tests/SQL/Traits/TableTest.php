<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteUpdate;

test('table', function ($table, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteUpdate(Get::connection())
        ->table($table)
    )
    ->toBe("UPDATE $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['t1', 't1'],
    [new SQLiteSelect(Get::connection())->columns(1), '(SELECT ?)', [1]],
    [['t1', 't3' => 't2'], 't1, t2 t3'],
]);

test('table spread', function () {

    expect(
        (string) new SQLiteUpdate(Get::connection())
        ->table('t1', 't2', ['t3', 't5' => 't4'])
    )
    ->toBe("UPDATE t1, t2, t3, t4 t5");

});
