<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Connections;

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Interfaces\Connections\MySQLConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLReplaceInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLUpdateInterface;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLDelete;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLInsert;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLReplace;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLSelect;
use MichaelRushton\DB\SQL\Statements\MySQL\MySQLUpdate;

class MySQLConnection extends Connection implements MySQLConnectionInterface
{
    public function delete(): MySQLDeleteInterface
    {
        return new MySQLDelete($this);
    }

    public function insert(): MySQLInsertInterface
    {
        return new MySQLInsert($this);
    }

    public function replace(): MySQLReplaceInterface
    {
        return new MySQLReplace($this);
    }

    public function update(): MySQLUpdateInterface
    {
        return new MySQLUpdate($this);
    }

    public function select(): MySQLSelectInterface
    {
        return new MySQLSelect($this);
    }
}
