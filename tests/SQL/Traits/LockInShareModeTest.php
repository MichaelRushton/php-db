<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;

test('lock in share mode', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->lockInShareMode()
    )
    ->toBe("SELECT * LOCK IN SHARE MODE");

});

test('lock in share mode wait', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->lockInShareModeWait(1)
    )
    ->toBe("SELECT * LOCK IN SHARE MODE WAIT 1");

});

test('lock in share mode nowait', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->lockInShareModeNoWait()
    )
    ->toBe("SELECT * LOCK IN SHARE MODE NOWAIT");

});

test('lock in share mode skip locked', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->lockInShareModeSkipLocked()
    )
    ->toBe("SELECT * LOCK IN SHARE MODE SKIP LOCKED");

});
