<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\MariaDB;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\MariaDB\Select as MariaDBSelect;

class Select extends MariaDBSelect implements PDOInterface
{
  use UsesPDO;
}