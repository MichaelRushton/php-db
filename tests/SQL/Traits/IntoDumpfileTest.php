<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;

test('into dumpfile', function ($path, $expected) {

    expect(
        (string) new MariaDBSelect(Get::connection())
        ->intoDumpfile($path)
    )
    ->toBe("SELECT * INTO DUMPFILE '$expected'");

})
->with([
    ['path', 'path'],
    ["'path'", "''path''"],
]);
