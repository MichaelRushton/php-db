<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Outfile;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;

test('into outfile', function ($path, $expected) {

    expect(
        (string) new MariaDBSelect(Get::connection())
    ->intoOutfile($path, fn (Outfile $outfile) => $outfile->characterSet('utf8'))
    )
    ->toBe("SELECT * INTO OUTFILE '$expected' CHARACTER SET utf8");

})
->with([
    ['path', 'path'],
    ["'path'", "''path''"],
]);
