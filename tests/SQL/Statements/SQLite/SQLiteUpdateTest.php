<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteUpdate;

test('update', function () {

    expect(
        (string) $stmt = new SQLiteUpdate(Get::connection())
        ->orFail()
        ->table('t1')
        ->set('c1', 1)
        ->from('t1')
        ->join('t1')
        ->where('c1')
        ->returning()
        ->orderBy('c1')
        ->limit(1)
        ->when(0)
    )
    ->toBe(implode(' ', [
        'UPDATE',
        'OR FAIL',
        't1',
        'SET c1 = ?',
        'FROM t1',
        'JOIN t1',
        'WHERE c1',
        'RETURNING *',
        'ORDER BY c1',
        'LIMIT 1',
    ]));

    expect($stmt->bindings())
    ->toBe([1]);

});
