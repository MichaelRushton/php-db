<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLUpdate;

test('update', function () {

    expect(
        (string) $stmt = new PostgreSQLUpdate(Get::connection())
        ->table('t1')
        ->set('c1', 1)
        ->from('t1')
        ->join('t1')
        ->where('c1')
        ->whereCurrentOf('cursor')
        ->returning()
        ->when(0)
    )
    ->toBe(implode(' ', [
        'UPDATE',
        't1',
        'SET c1 = ?',
        'FROM t1',
        'JOIN t1',
        'WHERE c1',
        'WHERE CURRENT OF cursor',
        'RETURNING *',
    ]));

    expect($stmt->bindings())
    ->toBe([1]);

});
