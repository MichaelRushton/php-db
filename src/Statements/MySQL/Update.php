<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\MySQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\MySQL\Update as MySQLUpdate;

class Update extends MySQLUpdate implements PDOInterface
{
  use UsesPDO;
}