<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Connections;

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Interfaces\Connections\PostgreSQLConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLUpdateInterface;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLDelete;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLInsert;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLSelect;
use MichaelRushton\DB\SQL\Statements\PostgreSQL\PostgreSQLUpdate;

class PostgreSQLConnection extends Connection implements PostgreSQLConnectionInterface
{
    public function delete(): PostgreSQLDeleteInterface
    {
        return new PostgreSQLDelete($this);
    }

    public function insert(): PostgreSQLInsertInterface
    {
        return new PostgreSQLInsert($this);
    }

    public function update(): PostgreSQLUpdateInterface
    {
        return new PostgreSQLUpdate($this);
    }

    public function select(): PostgreSQLSelectInterface
    {
        return new PostgreSQLSelect($this);
    }
}
