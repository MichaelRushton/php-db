<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Raw;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerSelect;

test('offset fetch', function ($offset, $row_count, $expected, $bindings = []) {

    expect(
        (string) $stmt = new SQLServerSelect(Get::connection())
        ->offsetFetch($offset, $row_count)
    )
    ->toBe("SELECT * OFFSET $expected ONLY");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    [1, 2, '1 ROWS FETCH NEXT 2 ROWS'],
    ['test1', 'test2', 'test1 ROWS FETCH NEXT test2 ROWS'],
    [new Raw('?', 1), new Raw('?', 1), '? ROWS FETCH NEXT ? ROWS', [1, 1]],
]);

test('offset fetch with ties', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->offsetFetch(1, 2)
        ->withTies()
    )
    ->toBe("SELECT * OFFSET 1 ROWS FETCH NEXT 2 ROWS WITH TIES");

});
