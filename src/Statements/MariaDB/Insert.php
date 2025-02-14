<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\MariaDB;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\MariaDB\Insert as MariaDBInsert;

class Insert extends MariaDBInsert implements PDOInterface
{
  use UsesPDO;
}