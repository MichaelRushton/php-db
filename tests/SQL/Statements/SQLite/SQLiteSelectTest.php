<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('select', function () {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->with('cte', 'SELECT')
        ->distinct()
        ->columns('c1')
        ->from('t1')
        ->join('t2')
        ->where('c1', 1)
        ->groupBy('c1')
        ->having('c1', 1)
        ->window('w1')
        ->union('SELECT')
        ->orderBy('c1')
        ->limit(1)
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'SELECT',
        'DISTINCT',
        'c1',
        'FROM t1',
        'JOIN t2',
        'WHERE c1 = ?',
        'GROUP BY c1',
        'HAVING c1 = ?',
        'WINDOW w1 AS ()',
        'UNION SELECT',
        'ORDER BY c1',
        'LIMIT 1',
    ]));

    expect($stmt->bindings())
    ->toBe([1, 1]);

});
