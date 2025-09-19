<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\MySQLConnection;
use MichaelRushton\DB\Drivers\MySQLDriver;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLDelete;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLInsert;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLReplace;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLSelect;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLUpdate;

test('delete', function () {

    $connection = new MySQLConnection(new MySQLDriver());

    expect($connection->delete())
    ->toBeInstanceOf(MySQLDelete::class);

});

test('insert', function () {

    $connection = new MySQLConnection(new MySQLDriver());

    expect($connection->insert())
    ->toBeInstanceOf(MySQLInsert::class);

});

test('replace', function () {

    $connection = new MySQLConnection(new MySQLDriver());

    expect($connection->replace())
    ->toBeInstanceOf(MySQLReplace::class);

});

test('select', function () {

    $connection = new MySQLConnection(new MySQLDriver());

    expect($connection->select())
    ->toBeInstanceOf(MySQLSelect::class);

});

test('update', function () {

    $connection = new MySQLConnection(new MySQLDriver());

    expect($connection->update())
    ->toBeInstanceOf(MySQLUpdate::class);

});
