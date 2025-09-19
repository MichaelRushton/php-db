<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Connections;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteReplaceInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteUpdateInterface;

interface SQLiteConnectionInterface extends ConnectionInterface
{
    public function delete(): SQLiteDeleteInterface;

    public function insert(): SQLiteInsertInterface;

    public function replace(): SQLiteReplaceInterface;

    public function select(): SQLiteSelectInterface;

    public function update(): SQLiteUpdateInterface;
}
