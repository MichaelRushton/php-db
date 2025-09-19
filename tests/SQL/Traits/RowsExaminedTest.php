<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Raw;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;

test('rows examined', function ($row_count, $expected, $bindings = []) {

    expect(
        (string) $stmt = new MariaDBSelect(Get::connection())
        ->rowsExamined($row_count)
    )
    ->toBe("SELECT * LIMIT ROWS EXAMINED $expected");

    expect($stmt->bindings())
    ->toBe($bindings);

})
->with([
    [1, '1'],
    ['test', 'test'],
    [new Raw('?', 1), '?', [1]],
]);

test('rows examined with limit', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->limit(5)
        ->rowsExamined(10)
    )
    ->toBe("SELECT * LIMIT 5 ROWS EXAMINED 10");

});
