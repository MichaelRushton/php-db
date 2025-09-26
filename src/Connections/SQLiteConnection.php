<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Connections;

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Interfaces\Connections\SQLiteConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteReplaceInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteUpdateInterface;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteDelete;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteInsert;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteReplace;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteSelect;
use MichaelRushton\DB\SQL\Statements\SQLite\SQLiteUpdate;

class SQLiteConnection extends Connection implements SQLiteConnectionInterface
{
    public function delete(): SQLiteDeleteInterface
    {
        return new SQLiteDelete($this);
    }

    public function insert(): SQLiteInsertInterface
    {
        return new SQLiteInsert($this);
    }

    public function replace(): SQLiteReplaceInterface
    {
        return new SQLiteReplace($this);
    }

    public function update(): SQLiteUpdateInterface
    {
        return new SQLiteUpdate($this);
    }

    public function select(): SQLiteSelectInterface
    {
        return new SQLiteSelect($this);
    }
}
