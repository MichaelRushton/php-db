<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Connections;

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Interfaces\Connections\MariaDBConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBReplaceInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBUpdateInterface;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBDelete;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBInsert;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBReplace;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBSelect;
use MichaelRushton\DB\SQL\Statements\MariaDB\MariaDBUpdate;

class MariaDBConnection extends Connection implements MariaDBConnectionInterface
{
    public function delete(): MariaDBDeleteInterface
    {
        return new MariaDBDelete($this);
    }

    public function insert(): MariaDBInsertInterface
    {
        return new MariaDBInsert($this);
    }

    public function replace(): MariaDBReplaceInterface
    {
        return new MariaDBReplace($this);
    }

    public function update(): MariaDBUpdateInterface
    {
        return new MariaDBUpdate($this);
    }

    public function select(): MariaDBSelectInterface
    {
        return new MariaDBSelect($this);
    }
}
