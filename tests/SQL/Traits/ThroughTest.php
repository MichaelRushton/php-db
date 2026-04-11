<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('through', function (): void {

    expect(
        (string) $stmt = new SQLiteSelect(Get::connection())
        ->through(function ($stmt): void {
            $stmt->where('c1', 1);
        })
    )
    ->toBe("SELECT * WHERE c1 = ?");

    expect($stmt->bindings())
    ->toBe([1]);

});
