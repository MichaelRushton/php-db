<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerInsert;

test('insert', function () {

    expect(
        (string) $stmt = new SQLServerInsert(Get::connection())
        ->with('cte', 'SELECT')
        ->top(1)
        ->into('t1')
        ->columns('c1')
        ->output('*')
        ->values([1])
        ->select('SELECT')
        ->when(0)
    )
    ->toBe(
        implode(' ', [
            'WITH cte AS (SELECT)',
            'INSERT',
            'TOP (1)',
            'INTO t1',
            '(c1)',
            'OUTPUT *',
            'VALUES (?)',
            'SELECT',
        ])
    );

    expect($stmt->bindings())
    ->toBe([1]);

});
