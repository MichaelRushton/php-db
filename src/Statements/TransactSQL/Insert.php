<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\TransactSQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\TransactSQL\Insert as TransactSQLInsert;

class Insert extends TransactSQLInsert implements PDOInterface
{
  use UsesPDO;
}