<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;

test('sql cache', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->sqlCache()
    )
    ->toBe("SELECT SQL_CACHE *");

});

test('sql no cache', function () {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->sqlNoCache()
    )
    ->toBe("SELECT SQL_NO_CACHE *");

});
