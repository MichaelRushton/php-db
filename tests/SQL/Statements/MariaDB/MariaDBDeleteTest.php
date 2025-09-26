<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBDelete;

test('delete', function () {

    expect(
        (string) new MariaDBDelete(Get::connection())
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
        ->returning()
        ->when(0)
    )
    ->toBe(implode(' ', [
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
        'RETURNING *',
    ]));

});
