<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;

test('for key share', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forKeyShare($table)
    )
    ->toBe("SELECT * FOR KEY SHARE$expected");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for key share spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forKeyShare('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR KEY SHARE OF t1, t2, t3, t4");

});

test('for key share nowait', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forKeyShareNoWait($table)
    )
    ->toBe("SELECT * FOR KEY SHARE$expected NOWAIT");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for key share nowait spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forKeyShareNoWait('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR KEY SHARE OF t1, t2, t3, t4 NOWAIT");

});

test("for key share skip locked", function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forKeyShareSkipLocked($table)
    )
    ->toBe("SELECT * FOR KEY SHARE$expected SKIP LOCKED");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for key share skip locked spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forKeyShareSkipLocked('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR KEY SHARE OF t1, t2, t3, t4 SKIP LOCKED");

});
