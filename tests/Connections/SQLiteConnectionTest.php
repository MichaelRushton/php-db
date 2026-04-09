<?php

declare(strict_types=1);

use MichaelRushton\DB\Connections\SQLiteConnection;
use MichaelRushton\DB\Drivers\SQLiteDriver;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteDelete;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteInsert;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteReplace;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteUpdate;

test('delete', function (): void {

    $connection = new SQLiteConnection(new SQLiteDriver());

    expect($connection->delete())
    ->toBeInstanceOf(SQLiteDelete::class);

});

test('insert', function (): void {

    $connection = new SQLiteConnection(new SQLiteDriver());

    expect($connection->insert())
    ->toBeInstanceOf(SQLiteInsert::class);

});

test('replace', function (): void {

    $connection = new SQLiteConnection(new SQLiteDriver());

    expect($connection->replace())
    ->toBeInstanceOf(SQLiteReplace::class);

});

test('select', function (): void {

    $connection = new SQLiteConnection(new SQLiteDriver());

    expect($connection->select())
    ->toBeInstanceOf(SQLiteSelect::class);

});

test('update', function (): void {

    $connection = new SQLiteConnection(new SQLiteDriver());

    expect($connection->update())
    ->toBeInstanceOf(SQLiteUpdate::class);

});
