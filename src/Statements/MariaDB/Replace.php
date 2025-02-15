<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\MariaDB;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\MariaDB\Replace as MariaDBReplace;

class Replace extends MariaDBReplace implements PDOInterface
{
  use UsesPDO;
}