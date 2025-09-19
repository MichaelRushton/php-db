<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\MariaDBConnection;
use MichaelRushton\DB\Drivers\MariaDBDriver;

test('username', function () {

    expect(
        new MariaDBDriver()
        ->username('username')
        ->username
    )
    ->toBe('username');

});

test('password', function () {

    expect(
        new MariaDBDriver()
        ->password('password')
        ->password
    )
    ->toBe('password');

});

test('host', function () {

    expect(
        new MariaDBDriver()
        ->host('host')
        ->host
    )
    ->toBe('host');

});

test('port', function () {

    expect(
        new MariaDBDriver()
        ->port(1)
        ->port
    )
    ->toBe(1);

});

test('dbname', function () {

    expect(
        new MariaDBDriver()
        ->database('dbname')
        ->dbname
    )
    ->toBe('dbname');

});

test('unix socket', function () {

    $driver = new MariaDBDriver()->unixSocket('unix_socket');

    expect($driver->unix_socket)
    ->toBe('unix_socket');

    expect($driver->host)
    ->toBeNull();

    expect($driver->port)
    ->toBeNull();

});

test('charset', function () {

    expect(
        new MariaDBDriver()
        ->charset('charset')
        ->charset
    )
    ->toBe('charset');

});

test('connection', function () {

    expect(new MariaDBDriver()->connection())
    ->toBeInstanceOf(MariaDBConnection::class);

});

test('dsn', function () {

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
