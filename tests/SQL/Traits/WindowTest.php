<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Raw;
use MichaelRushton\DB\SQL\Components\Window;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('windows', function () {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->window('w1', fn (Window $window) => $window->orderBy(new Raw('?', 1)))
    )
    ->toBe("SELECT * WINDOW w1 AS (ORDER BY ?)");

    expect($stmt->bindings())
    ->toBe([1]);

});

test('multiple windows', function () {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->window('w1', fn (Window $window) => $window->orderBy(new Raw('?', 1)))
        ->window('w2', fn (Window $window) => $window->orderBy(new Raw('?', 2)))
    )
    ->toBe("SELECT * WINDOW w1 AS (ORDER BY ?), w2 AS (ORDER BY ?)");

    expect($stmt->bindings())
    ->toBe([1, 2]);

});
