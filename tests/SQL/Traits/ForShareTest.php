<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;

test('for share', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forShare($table)
    )
    ->toBe("SELECT * FOR SHARE$expected");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for share spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forShare('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR SHARE OF t1, t2, t3, t4");

});

test('for share nowait', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forShareNoWait($table)
    )
    ->toBe("SELECT * FOR SHARE$expected NOWAIT");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for share nowait spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forShareNoWait('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR SHARE OF t1, t2, t3, t4 NOWAIT");

});

test("for share skip locked", function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forShareSkipLocked($table)
    )
    ->toBe("SELECT * FOR SHARE$expected SKIP LOCKED");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for share skip locked spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forShareSkipLocked('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR SHARE OF t1, t2, t3, t4 SKIP LOCKED");

});
