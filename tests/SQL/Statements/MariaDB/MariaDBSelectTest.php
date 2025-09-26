<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;

test('select', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->with('cte', 'SELECT')
        ->distinct()
        ->highPriority()
        ->straightJoinAll()
        ->sqlSmallResult()
        ->sqlBigResult()
        ->sqlBufferResult()
        ->sqlCache()
        ->sqlCalcFoundRows()
        ->columns('c1')
        ->from('t1')
        ->join('t1')
        ->where('c1')
        ->groupBy('c1')
        ->having('c1')
        ->union('SELECT')
        ->orderBy('c1')
        ->limit(1)
        ->rowsExamined(1)
        ->intoOutfile('/tmp/file')
        ->intoDumpfile('/tmp/file')
        ->intoVar('v1')
        ->forUpdate()
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
        'SQL_CACHE',
        'SQL_CALC_FOUND_ROWS',
        'c1',
        'FROM t1',
        'JOIN t1',
        'WHERE c1',
        'GROUP BY c1',
        'HAVING c1',
        'UNION SELECT',
        'ORDER BY c1',
        'LIMIT 1',
        'ROWS EXAMINED 1',
        "INTO OUTFILE '/tmp/file'",
        "INTO DUMPFILE '/tmp/file'",
        'INTO @v1',
        'FOR UPDATE',
        'LOCK IN SHARE MODE',
    ]));

});

test('select offset fetch', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->orderBy('c1')
        ->offsetFetch(1, 2)
        ->withTies()
        ->rowsExamined(1)
    )
    ->toBe(implode(' ', [
        'SELECT',
        '*',
        'ORDER BY c1',
        'OFFSET 1 ROWS FETCH NEXT 2 ROWS WITH TIES',
        'ROWS EXAMINED 1'
    ]));

});
