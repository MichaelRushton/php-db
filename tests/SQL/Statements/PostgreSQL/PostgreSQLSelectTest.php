<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;

test('select', function () {

    expect(
        (string) $stmt = new PostgreSQLSelect(Get::connection())
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
        ->forUpdate()
        ->forNoKeyUpdate()
        ->forShare()
        ->forKeyShare()
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
        'FOR UPDATE',
        'FOR NO KEY UPDATE',
        'FOR SHARE',
        'FOR KEY SHARE',
    ]));

    expect($stmt->bindings())
    ->toBe([1, 1]);

});

test('select offset fetch', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->orderBy('c1')
        ->offsetFetch(1, 2)
        ->withTies()
        ->forUpdate()
    )
    ->toBe(implode(' ', [
        'SELECT',
        '*',
        'ORDER BY c1',
        'OFFSET 1 ROWS FETCH NEXT 2 ROWS WITH TIES',
        'FOR UPDATE',
    ]));

});
