<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\PostgreSQLConnection;
use MichaelRushton\DB\Drivers\PostgreSQLDriver;

test('username', function (): void {

    expect(
        new PostgreSQLDriver()
        ->username('username')
        ->username
    )
    ->toBe('username');

});

test('password', function (): void {

    expect(
        new PostgreSQLDriver()
        ->password('password')
        ->password
    )
    ->toBe('password');

});

test('host', function (): void {

    expect(
        new PostgreSQLDriver()
        ->host('host')
        ->host
    )
    ->toBe('host');

});

test('port', function (): void {

    expect(
        new PostgreSQLDriver()
        ->port(1)
        ->port
    )
    ->toBe(1);

});

test('dbname', function (): void {

    expect(
        new PostgreSQLDriver()
        ->database('dbname')
        ->dbname
    )
    ->toBe('dbname');

});

test('sslmode', function (): void {

    expect(
        new PostgreSQLDriver()
        ->sslmode('sslmode')
        ->sslmode
    )
    ->toBe('sslmode');

});

test('connection', function (): void {

    expect(new PostgreSQLDriver()->connection())
    ->toBeInstanceOf(PostgreSQLConnection::class);

});

test('dsn', function (): void {

    expect(new PostgreSQLDriver()->dsn())
    ->toBe('pgsql:host=127.0.0.1;port=5432;dbname=postgres;sslmode=prefer');

});
