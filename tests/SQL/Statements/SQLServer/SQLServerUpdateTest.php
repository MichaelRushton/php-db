<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerUpdate;

test('update', function () {

    expect(
        (string) new SQLServerUpdate(Get::connection())
        ->with('cte', 'SELECT')
        ->top(1)
        ->table('t1')
        ->set('c1', 1)
        ->output('*')
        ->from('t1')
        ->join('t1')
        ->where('c1')
        ->whereCurrentOf('cursor')
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'UPDATE',
        'TOP (1)',
        't1',
        'SET c1 = ?',
        'OUTPUT *',
        'FROM t1',
        'JOIN t1',
        'WHERE c1',
        'WHERE CURRENT OF cursor',
    ]));

});
