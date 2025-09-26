<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBReplace;

test('replace', function () {

    expect(
        (string) $stmt = new MariaDBReplace(Get::connection())
        ->lowPriority()
        ->delayed()
        ->into('t1')
        ->columns('c1')
        ->values([1])
        ->set('c1', 1)
        ->select('SELECT')
        ->returning()
        ->when(0)
    )
    ->toBe(
        implode(' ', [
            'REPLACE',
            'LOW_PRIORITY',
            'DELAYED',
            'INTO t1',
            '(c1)',
            'VALUES (?)',
            'SET c1 = ?',
            'SELECT',
            'RETURNING *',
        ])
    );

    expect($stmt->bindings())
    ->toBe([1, 1]);

});
