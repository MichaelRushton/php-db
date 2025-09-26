<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MySQL\MySQLReplace;

test('replace', function () {

    expect(
        (string) $stmt = new MySQLReplace(Get::connection())
        ->lowPriority()
        ->into('t1')
        ->columns('c1')
        ->values([1])
        ->set('c1', 1)
        ->select('SELECT')
        ->when(0)
    )
    ->toBe(
        implode(' ', [
            'REPLACE',
            'LOW_PRIORITY',
            'INTO t1',
            '(c1)',
            'VALUES (?)',
            'SET c1 = ?',
            'SELECT',
        ])
    );

    expect($stmt->bindings())
    ->toBe([1, 1]);

});
