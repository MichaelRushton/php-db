<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\TransactSQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\TransactSQL\Delete as TransactSQLDelete;

class Delete extends TransactSQLDelete implements PDOInterface
{
  use UsesPDO;
}