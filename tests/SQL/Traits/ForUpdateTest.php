<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;

test('for update', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forUpdate($table)
    )
    ->toBe("SELECT * FOR UPDATE$expected");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for update spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forUpdate('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR UPDATE OF t1, t2, t3, t4");

});

test('for update wait', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forUpdateWait(1)
    )
    ->toBe("SELECT * FOR UPDATE WAIT 1");

});

test('for update nowait', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forUpdateNoWait($table)
    )
    ->toBe("SELECT * FOR UPDATE$expected NOWAIT");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for update nowait spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forUpdateNoWait('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR UPDATE OF t1, t2, t3, t4 NOWAIT");

});

test("for update skip locked", function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forUpdateSkipLocked($table)
    )
    ->toBe("SELECT * FOR UPDATE$expected SKIP LOCKED");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for update skip locked spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forUpdateSkipLocked('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR UPDATE OF t1, t2, t3, t4 SKIP LOCKED");

});
