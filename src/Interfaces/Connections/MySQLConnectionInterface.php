<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Connections;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLReplaceInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLUpdateInterface;

interface MySQLConnectionInterface extends ConnectionInterface
{
    public function delete(): MySQLDeleteInterface;

    public function insert(): MySQLInsertInterface;

    public function replace(): MySQLReplaceInterface;

    public function select(): MySQLSelectInterface;

    public function update(): MySQLUpdateInterface;
}
