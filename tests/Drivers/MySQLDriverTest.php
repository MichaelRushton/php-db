<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\MySQLConnection;
use MichaelRushton\DB\Drivers\MySQLDriver;

test('username', function (): void {

    expect(
        new MySQLDriver()
        ->username('username')
        ->username
    )
    ->toBe('username');

});

test('password', function (): void {

    expect(
        new MySQLDriver()
        ->password('password')
        ->password
    )
    ->toBe('password');

});

test('host', function (): void {

    expect(
        new MySQLDriver()
        ->host('host')
        ->host
    )
    ->toBe('host');

});

test('port', function (): void {

    expect(
        new MySQLDriver()
        ->port(1)
        ->port
    )
    ->toBe(1);

});

test('dbname', function (): void {

    expect(
        new MySQLDriver()
        ->database('dbname')
        ->dbname
    )
    ->toBe('dbname');

});

test('unix socket', function (): void {

    $driver = new MySQLDriver()->unixSocket('unix_socket');

    expect($driver->unix_socket)
    ->toBe('unix_socket');

    expect($driver->host)
    ->toBeNull();

    expect($driver->port)
    ->toBeNull();

});

test('charset', function (): void {

    expect(
        new MySQLDriver()
        ->charset('charset')
        ->charset
    )
    ->toBe('charset');

});

test('connection', function (): void {

    expect(new MySQLDriver()->connection())
    ->toBeInstanceOf(MySQLConnection::class);

});

test('dsn', function (): void {

    expect(
        new MySQLDriver()
        ->database('db')
        ->charset('utf8mb4')
        ->dsn()
    )
    ->toBe('mysql:host=127.0.0.1;port=3306;dbname=db;charset=utf8mb4');

    expect(
        new MySQLDriver()
        ->unixSocket('sock')
        ->database('db')
        ->charset('utf8mb4')
        ->dsn()
    )
    ->toBe('mysql:dbname=db;unix_socket=sock;charset=utf8mb4');

});
