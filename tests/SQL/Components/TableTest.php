<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Table;

test('table', function () {

    expect(
        (string) new Table('t1')
        ->only()
        ->partition('p1')
        ->forPortionOf('date', '2024-01-01', '2025-01-01')
        ->as('t2')
        ->useIndex()
        ->when(0)
    )
    ->toBe(implode(' ', [
        'ONLY',
        't1',
        'PARTITION (p1)',
        "FOR PORTION OF date FROM '2024-01-01' TO '2025-01-01'",
        't2',
        'USE INDEX ()',
    ]));

});
