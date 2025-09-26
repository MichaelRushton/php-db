<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('if true', function () {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->when(
            1,
            fn ($stmt, $value) => $stmt->where('c1', $value),
            fn ($stmt, $value) => $stmt->whereNot('c1', $value)
        )
    )
    ->toBe("SELECT * WHERE c1 = ?");

    expect($stmt->bindings())
    ->toBe([1]);

});

test('if false', function () {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->when(
            0,
            fn ($stmt, $value) => $stmt->where('c1', $value),
            fn ($stmt, $value) => $stmt->whereNot('c1', $value)
        )
    )
    ->toBe("SELECT * WHERE NOT c1 = ?");

    expect($stmt->bindings())
    ->toBe([0]);

});
