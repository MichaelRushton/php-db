<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\MariaDBConnection;
use MichaelRushton\DB\Drivers\MariaDBDriver;

test('username', function (): void {

    expect(
        new MariaDBDriver()
        ->username('username')
        ->username
    )
    ->toBe('username');

});

test('password', function (): void {

    expect(
        new MariaDBDriver()
        ->password('password')
        ->password
    )
    ->toBe('password');

});

test('host', function (): void {

    expect(
        new MariaDBDriver()
        ->host('host')
        ->host
    )
    ->toBe('host');

});

test('port', function (): void {

    expect(
        new MariaDBDriver()
        ->port(1)
        ->port
    )
    ->toBe(1);

});

test('dbname', function (): void {

    expect(
        new MariaDBDriver()
        ->database('dbname')
        ->dbname
    )
    ->toBe('dbname');

});

test('unix socket', function (): void {

    $driver = new MariaDBDriver()->unixSocket('unix_socket');

    expect($driver->unix_socket)
    ->toBe('unix_socket');

    expect($driver->host)
    ->toBeNull();

    expect($driver->port)
    ->toBeNull();

});

test('charset', function (): void {

    expect(
        new MariaDBDriver()
        ->charset('charset')
        ->charset
    )
    ->toBe('charset');

});

test('connection', function (): void {

    expect(new MariaDBDriver()->connection())
    ->toBeInstanceOf(MariaDBConnection::class);

});

test('dsn', function (): void {

    expect(
        new MariaDBDriver()
        ->database('db')
        ->charset('utf8mb4')
        ->dsn()
    )
    ->toBe('mysql:host=127.0.0.1;port=3306;dbname=db;charset=utf8mb4');

    expect(
        new MariaDBDriver()
        ->unixSocket('sock')
        ->database('db')
        ->charset('utf8mb4')
        ->dsn()
    )
    ->toBe('mysql:dbname=db;unix_socket=sock;charset=utf8mb4');

});
