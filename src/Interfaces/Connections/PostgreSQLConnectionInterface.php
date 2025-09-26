<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Connections;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLUpdateInterface;

interface PostgreSQLConnectionInterface extends ConnectionInterface
{
    public function delete(): PostgreSQLDeleteInterface;

    public function insert(): PostgreSQLInsertInterface;

    public function select(): PostgreSQLSelectInterface;

    public function update(): PostgreSQLUpdateInterface;
}
