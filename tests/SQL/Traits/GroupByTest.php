<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('group by', function ($column, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->groupBy($column)
    )
    ->toBe("SELECT * GROUP BY $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    ['c1', 'c1'],
    [new SQLiteSelect(Get::connection())->columns(1), '(SELECT ?)', [1]],
    [['c1', 'c2'], 'c1, c2'],
]);

test('group by spread', function () {

    expect(
        (string) new SQLiteSelect(Get::connection())
        ->groupBy('c1', 'c2', ['c3', 'c4'])
    )
    ->toBe("SELECT * GROUP BY c1, c2, c3, c4");

});

test('group by with rollup', function () {

    expect(
        (string) new SQLiteSelect(Get::connection())
        ->groupBy('c1')
        ->withRollup()
    )
    ->toBe("SELECT * GROUP BY c1 WITH ROLLUP");

});
