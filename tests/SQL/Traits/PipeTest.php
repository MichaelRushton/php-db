<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('pipe', function (): void {

    $stmt = new SQLiteSelect(Get::connection());

    expect(
        $stmt->pipe(function ($select) use ($stmt) {

            expect($select)
            ->toBe($stmt);

            return true;

        })
    )
    ->toBeTrue();

});
