<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\SQLServerConnection;
use MichaelRushton\DB\Drivers\SQLServerDriver;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerDelete;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerInsert;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerSelect;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerUpdate;

test('delete', function () {

    $connection = new SQLServerConnection(new SQLServerDriver());

    expect($connection->delete())
    ->toBeInstanceOf(SQLServerDelete::class);

});

test('insert', function () {

    $connection = new SQLServerConnection(new SQLServerDriver());

    expect($connection->insert())
    ->toBeInstanceOf(SQLServerInsert::class);

});

test('select', function () {

    $connection = new SQLServerConnection(new SQLServerDriver());

    expect($connection->select())
    ->toBeInstanceOf(SQLServerSelect::class);

});

test('update', function () {

    $connection = new SQLServerConnection(new SQLServerDriver());

    expect($connection->update())
    ->toBeInstanceOf(SQLServerUpdate::class);

});
