<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\PostgreSQLConnection;
use MichaelRushton\DB\Drivers\PostgreSQLDriver;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLDelete;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLInsert;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLUpdate;

test('delete', function () {

    $connection = new PostgreSQLConnection(new PostgreSQLDriver());

    expect($connection->delete())
    ->toBeInstanceOf(PostgreSQLDelete::class);

});

test('insert', function () {

    $connection = new PostgreSQLConnection(new PostgreSQLDriver());

    expect($connection->insert())
    ->toBeInstanceOf(PostgreSQLInsert::class);

});

test('select', function () {

    $connection = new PostgreSQLConnection(new PostgreSQLDriver());

    expect($connection->select())
    ->toBeInstanceOf(PostgreSQLSelect::class);

});

test('update', function () {

    $connection = new PostgreSQLConnection(new PostgreSQLDriver());

    expect($connection->update())
    ->toBeInstanceOf(PostgreSQLUpdate::class);

});
