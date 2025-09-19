<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MySQL\MySQLInsert;

test('row alias', function ($expected = '', ...$columns) {

    expect(
        (string) new MySQLInsert(Get::connection())
      ->as('new', ...$columns)
    )
    ->toBe("INSERT VALUES () AS new$expected");

})
->with([
    [],
    [' (a)', 'a'],
    [' (a, b)', ['a', 'b']],
]);
