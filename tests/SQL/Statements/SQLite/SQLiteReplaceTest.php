<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteReplace;

test('replace', function () {

    expect(
        (string) $stmt = new SQLiteReplace(Get::connection())
        ->with('cte', 'SELECT')
        ->into('t1')
        ->columns('c1')
        ->values([1])
        ->select('SELECT')
        ->returning()
        ->when(0)
    )
    ->toBe(
        implode(' ', [
            'WITH cte AS (SELECT)',
            'REPLACE',
            'INTO t1',
            '(c1)',
            'VALUES (?)',
            'SELECT',
            'RETURNING *',
        ])
    );

    expect($stmt->bindings())
    ->toBe([1]);

});
