<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;

test('for no key update', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forNoKeyUpdate($table)
    )
    ->toBe("SELECT * FOR NO KEY UPDATE$expected");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for no key update spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forNoKeyUpdate('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR NO KEY UPDATE OF t1, t2, t3, t4");

});

test('for no key update nowait', function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forNoKeyUpdateNoWait($table)
    )
    ->toBe("SELECT * FOR NO KEY UPDATE$expected NOWAIT");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for no key update nowait spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forNoKeyUpdateNoWait('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR NO KEY UPDATE OF t1, t2, t3, t4 NOWAIT");

});

test("for no key update skip locked", function ($table, $expected) {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forNoKeyUpdateSkipLocked($table)
    )
    ->toBe("SELECT * FOR NO KEY UPDATE$expected SKIP LOCKED");

})
->with([
    [null, ''],
    ['t1', ' OF t1'],
    [['t1', 't2'], ' OF t1, t2'],
]);

test('for no key update skip locked spread', function () {

    expect(
        (string) new PostgreSQLSelect(Get::connection())
        ->forNoKeyUpdateSkipLocked('t1', 't2', ['t3', 't4'])
    )
    ->toBe("SELECT * FOR NO KEY UPDATE OF t1, t2, t3, t4 SKIP LOCKED");

});
