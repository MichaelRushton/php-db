<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL\Components\Subquery;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;

test('to subquery', function () {

    expect(new SQLiteSelect(Get::connection())->toSubquery())
    ->toBeInstanceOf(Subquery::class);

});
