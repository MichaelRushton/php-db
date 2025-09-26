<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MySQL\MySQLDelete;

test('delete', function () {

    expect(
        (string) new MySQLDelete(Get::connection())
        ->with('cte', 'SELECT')
        ->lowPriority()
        ->quick()
        ->ignore()
        ->table('t1')
        ->from('t1')
        ->using('t1')
        ->join('t1')
        ->where('c1')
        ->orderBy('c1')
        ->limit(1)
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'DELETE',
        'LOW_PRIORITY',
        'QUICK',
        'IGNORE',
        't1',
        'FROM t1',
        'USING t1',
        'JOIN t1',
        'WHERE c1',
        'ORDER BY c1',
        'LIMIT 1',
    ]));

});
