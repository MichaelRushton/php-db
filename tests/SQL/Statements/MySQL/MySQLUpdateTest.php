<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MySQL\MySQLUpdate;

test('update', function () {

    expect(
        (string) new MySQLUpdate(Get::connection())
        ->with('cte', 'SELECT')
        ->lowPriority()
        ->ignore()
        ->table('t1')
        ->join('t1')
        ->set('c1', 1)
        ->where('c1')
        ->orderBy('c1')
        ->limit(1)
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'UPDATE',
        'LOW_PRIORITY',
        'IGNORE',
        't1',
        'JOIN t1',
        'SET c1 = ?',
        'WHERE c1',
        'ORDER BY c1',
        'LIMIT 1',
    ]));

});
