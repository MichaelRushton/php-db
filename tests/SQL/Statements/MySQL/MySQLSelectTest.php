<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MySQL\MySQLSelect;

test('select', function () {

    expect(
        (string) new MySQLSelect(Get::connection())
        ->with('cte', 'SELECT')
        ->distinct()
        ->highPriority()
        ->straightJoinAll()
        ->sqlSmallResult()
        ->sqlBigResult()
        ->sqlBufferResult()
        ->sqlCalcFoundRows()
        ->columns('c1')
        ->from('t1')
        ->join('t1')
        ->where('c1')
        ->groupBy('c1')
        ->having('c1')
        ->window('w1')
        ->union('SELECT')
        ->orderBy('c1')
        ->limit(1)
        ->intoOutfile('/tmp/file')
        ->intoDumpfile('/tmp/file')
        ->intoVar('v1')
        ->forUpdate()
        ->forShare()
        ->lockInShareMode()
        ->when(0)
    )
    ->toBe(implode(' ', [
        'WITH cte AS (SELECT)',
        'SELECT',
        'DISTINCT',
        'HIGH_PRIORITY',
        'STRAIGHT_JOIN',
        'SQL_SMALL_RESULT',
        'SQL_BIG_RESULT',
        'SQL_BUFFER_RESULT',
        'SQL_CALC_FOUND_ROWS',
        'c1',
        'FROM t1',
        'JOIN t1',
        'WHERE c1',
        'GROUP BY c1',
        'HAVING c1',
        'WINDOW w1 AS ()',
        'UNION SELECT',
        'ORDER BY c1',
        'LIMIT 1',
        "INTO OUTFILE '/tmp/file'",
        "INTO DUMPFILE '/tmp/file'",
        'INTO @v1',
        'FOR UPDATE',
        'FOR SHARE',
        'LOCK IN SHARE MODE',
    ]));

});
