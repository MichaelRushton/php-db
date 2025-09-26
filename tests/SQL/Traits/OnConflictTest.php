<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Upsert;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteInsert;

test('on conflict do nothing', function () {

    expect(
        (string) new SQLiteInsert(Get::connection())
        ->onConflictDoNothing()
        ->onConflictDoNothing(fn (Upsert $upsert) => $upsert->columns('c1'))
    )
    ->toBe("INSERT DEFAULT VALUES ON CONFLICT DO NOTHING ON CONFLICT (c1) DO NOTHING");

});

test('on conflict do update set', function () {

    expect(
        (string) $stmt = new SQLiteInsert(Get::connection())
        ->onConflictDoUpdateSet('c1', 1, fn (Upsert $upsert) => $upsert->columns('c1'))
        ->onConflictDoUpdateSet([
            'c1' => 1,
            'c2' => 2,
        ], fn (Upsert $upsert) => $upsert->columns('c0'))
    )
    ->toBe(
        implode(' ', [
            'INSERT',
            'DEFAULT VALUES',
            'ON CONFLICT (c1) DO UPDATE SET c1 = ?',
            'ON CONFLICT (c0) DO UPDATE SET c1 = ?, c2 = ?',
        ])
    );

    expect($stmt->bindings())
    ->toBe([1, 1, 2]);

});
