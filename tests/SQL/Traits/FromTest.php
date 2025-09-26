<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('from', function ($table, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->from($table)
    )
    ->toBe("SELECT * FROM $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['t1', 't1'],
    [new SQLiteSelect(Get::connection())->columns(1), '(SELECT ?)', [1]],
    [['t1', 't3' => 't2'], 't1, t2 t3'],
]);

test('from spread', function () {

    expect(
        (string) new SQLiteSelect(Get::connection())
        ->from('t1', 't2', ['t3', 't5' => 't4'])
    )
    ->toBe("SELECT * FROM t1, t2, t3, t4 t5");

});
