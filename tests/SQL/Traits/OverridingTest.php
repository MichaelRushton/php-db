<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLInsert;

test('overriding system value', function () {

    expect(
        (string) new PostgreSQLInsert(Get::connection())
        ->overridingSystemValue()
    )
    ->toBe("INSERT OVERRIDING SYSTEM VALUE DEFAULT VALUES");

});

test('overriding user value', function () {

    expect(
        (string) new PostgreSQLInsert(Get::connection())
        ->overridingUserValue()
    )
    ->toBe("INSERT OVERRIDING USER VALUE DEFAULT VALUES");

});
