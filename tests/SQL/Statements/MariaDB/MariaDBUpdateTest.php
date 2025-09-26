<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBUpdate;

test('update', function () {

    expect(
        (string) new MariaDBUpdate(Get::connection())
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
