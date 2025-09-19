<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\CTE;

test('materialized', function () {

    expect(
        (string) new CTE('cte', 'SELECT')
        ->materialized()
    )
    ->toBe("cte AS MATERIALIZED (SELECT)");

});

test('not materialized', function () {

    expect(
        (string) new CTE('cte', 'SELECT')
        ->notMaterialized()
    )
    ->toBe("cte AS NOT MATERIALIZED (SELECT)");

});
