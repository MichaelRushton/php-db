<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\MariaDBConnection;
use MichaelRushton\DB\Drivers\MariaDBDriver;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBDelete;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBInsert;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBReplace;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBUpdate;

test('delete', function () {

    $connection = new MariaDBConnection(new MariaDBDriver());

    expect($connection->delete())
    ->toBeInstanceOf(MariaDBDelete::class);

});

test('insert', function () {

    $connection = new MariaDBConnection(new MariaDBDriver());

    expect($connection->insert())
    ->toBeInstanceOf(MariaDBInsert::class);

});

test('replace', function () {

    $connection = new MariaDBConnection(new MariaDBDriver());

    expect($connection->replace())
    ->toBeInstanceOf(MariaDBReplace::class);

});

test('select', function () {

    $connection = new MariaDBConnection(new MariaDBDriver());

    expect($connection->select())
    ->toBeInstanceOf(MariaDBSelect::class);

});

test('update', function () {

    $connection = new MariaDBConnection(new MariaDBDriver());

    expect($connection->update())
    ->toBeInstanceOf(MariaDBUpdate::class);

});
