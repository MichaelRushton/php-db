<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Connections;

use MichaelRushton\DB\Connection;
use MichaelRushton\DB\Interfaces\Connections\SQLServerConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerUpdateInterface;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerDelete;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerInsert;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerSelect;
use MichaelRushton\DB\SQL\Statements\SQLServer\SQLServerUpdate;

class SQLServerConnection extends Connection implements SQLServerConnectionInterface
{
    public function delete(): SQLServerDeleteInterface
    {
        return new SQLServerDelete($this);
    }

    public function insert(): SQLServerInsertInterface
    {
        return new SQLServerInsert($this);
    }

    public function update(): SQLServerUpdateInterface
    {
        return new SQLServerUpdate($this);
    }

    public function select(): SQLServerSelectInterface
    {
        return new SQLServerSelect($this);
    }
}
