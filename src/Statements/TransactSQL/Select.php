<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\TransactSQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\TransactSQL\Select as TransactSQLSelect;

class Select extends TransactSQLSelect implements PDOInterface
{
  use UsesPDO;
}