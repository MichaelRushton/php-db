<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Table;

test('partition', function ($partition, $expected) {

    expect(
        (string) new Table('t1')
        ->partition($partition)
    )
    ->toBe("t1 PARTITION ($expected)");

})
->with([
    ['p1', 'p1'],
    [['p1', 'p2'], 'p1, p2'],
]);

test('partition spread', function () {

    expect(
        (string) new Table('t1')
        ->partition('p1', 'p2', ['p3', 'p4'])
    )
    ->toBe("t1 PARTITION (p1, p2, p3, p4)");

});
