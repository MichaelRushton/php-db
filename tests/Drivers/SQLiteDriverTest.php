<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\SQLiteConnection;
use MichaelRushton\DB\Drivers\SQLiteDriver;

test('database', function () {

    expect(
        new SQLiteDriver()
        ->database(':memory:')
        ->database
    )
    ->toBe(':memory:');

});

test('connection', function () {

    expect(new SQLiteDriver()->connection())
    ->toBeInstanceOf(SQLiteConnection::class);

});

test('pdo', function () {

    expect(new SQLiteDriver()->pdo())
    ->toBeInstanceOf(PDO::class);

});

test('dsn', function () {

    expect(
        new SQLiteDriver()
        ->database(':memory:')
        ->dsn()
    )
    ->toBe('sqlite::memory:');

});
