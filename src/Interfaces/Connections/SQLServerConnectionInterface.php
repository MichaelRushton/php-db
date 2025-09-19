<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Interfaces\Connections;

use MichaelRushton\DB\Interfaces\ConnectionInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerDeleteInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerInsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerSelectInterface;
use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerUpdateInterface;

interface SQLServerConnectionInterface extends ConnectionInterface
{
    public function delete(): SQLServerDeleteInterface;

    public function insert(): SQLServerInsertInterface;

    public function select(): SQLServerSelectInterface;

    public function update(): SQLServerUpdateInterface;
}
