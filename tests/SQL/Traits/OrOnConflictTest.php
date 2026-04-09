<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteInsert;

test('or fail', function (): void {

    expect(
        (string) new SQLiteInsert(Get::connection())
        ->orFail()
    )
    ->toBe("INSERT OR FAIL DEFAULT VALUES");

});

test('or ignore', function (): void {

    expect(
        (string) new SQLiteInsert(Get::connection())
        ->orIgnore()
    )
    ->toBe("INSERT OR IGNORE DEFAULT VALUES");

});

test('or replace', function (): void {

    expect(
        (string) new SQLiteInsert(Get::connection())
        ->orReplace()
    )
    ->toBe("INSERT OR REPLACE DEFAULT VALUES");

});

test('or roll back', function (): void {

    expect(
        (string) new SQLiteInsert(Get::connection())
        ->orRollBack()
    )
    ->toBe("INSERT OR ROLLBACK DEFAULT VALUES");

});
