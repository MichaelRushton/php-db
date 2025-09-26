<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Connections;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBReplaceInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBUpdateInterface;

interface MariaDBConnectionInterface extends ConnectionInterface
{
    public function delete(): MariaDBDeleteInterface;

    public function insert(): MariaDBInsertInterface;

    public function replace(): MariaDBReplaceInterface;

    public function select(): MariaDBSelectInterface;

    public function update(): MariaDBUpdateInterface;
}
