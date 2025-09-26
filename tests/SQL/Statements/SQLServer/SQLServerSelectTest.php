<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerSelect;

test('select', function () {

    expect(
        (string) new SQLServerSelect(Get::connection())
        ->with('cte', 'SELECT')
        ->distinct()
        ->top(1)
        ->percent()
        ->withTies()
        ->columns('c1')
        ->into('t1')
        ->from('t1')
        ->join('t1')
        ->where('c1')
        ->groupBy('c1')
        ->having('c1')
        ->window('w')
        ->union('SELECT')
        ->orderBy('c1')
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'SELECT',
        'DISTINCT',
        'TOP (1)',
        'PERCENT',
        'WITH TIES',
        'c1',
        'INTO t1',
        'FROM t1',
        'JOIN t1',
        'WHERE c1',
        'GROUP BY c1',
        'HAVING c1',
        'WINDOW w AS ()',
        'UNION SELECT',
        'ORDER BY c1',
    ]));

});

test('select offset fetch', function () {

    expect(
        (string) new SQLServerSelect(Get::connection())
        ->orderBy('c1')
        ->offsetFetch(1, 2)
    )
    ->toBe(implode(' ', [
        'SELECT',
        '*',
        'ORDER BY c1',
        'OFFSET 1 ROWS FETCH NEXT 2 ROWS ONLY',
    ]));

});
