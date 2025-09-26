<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteDelete;

test('delete', function () {

    expect(
        (string) $stmt = new SQLiteDelete(Get::connection())
        ->with('cte', 'SELECT')
        ->from('t1')
        ->where('c1', 1)
        ->returning()
        ->orderBy('c1')
        ->limit(1)
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'DELETE',
        'FROM t1',
        'WHERE c1 = ?',
        'RETURNING *',
        'ORDER BY c1',
        'LIMIT 1',
    ]));

    expect($stmt->bindings())
    ->toBe([1]);

});
