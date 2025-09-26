<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Outfile;

test('outfile', function () {

    expect(
        (string) new Outfile('path')
        ->characterSet('utf8')
        ->fieldsTerminatedBy(',')
        ->linesStartingBy('')
        ->when(0)
    )
    ->toBe(implode(' ', [
        "'path'",
        'CHARACTER SET utf8',
        "FIELDS TERMINATED BY ','",
        "LINES STARTING BY ''",
    ]));

});
