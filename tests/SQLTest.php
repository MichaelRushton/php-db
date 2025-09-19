<?php

declare(strict_types=1);

use MichaelRushton\DB\SQL;
use MichaelRushton\DB\SQL\Components\Raw;

test('bind', function ($value) {

    expect($raw = SQL::bind($value))
    ->toBeInstanceOf(Raw::class);

    expect("$raw")
    ->toBe('?');

    expect($raw->bindings())
    ->toBe([$value]);

})
->with(['1', 1, 1.1, true, null]);

test('escape', function () {

    expect(SQL::escape("this is a 'test'"))
    ->toBe("this is a ''test''");

});
