<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLDelete;

test('delete', function () {

    expect(
        (string) $stmt = new PostgreSQLDelete(Get::connection())
        ->with('cte', 'SELECT')
        ->from('t1')
        ->using('t1')
        ->join('t1')
        ->where('c1', 1)
        ->whereCurrentOf('cursor')
        ->returning()
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'DELETE',
        'FROM t1',
        'USING t1',
        'JOIN t1',
        'WHERE c1 = ?',
        'WHERE CURRENT OF cursor',
        'RETURNING *',
    ]));

    expect($stmt->bindings())
    ->toBe([1]);

});
