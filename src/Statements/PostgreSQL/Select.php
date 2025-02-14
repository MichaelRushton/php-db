<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\PostgreSQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\PostgreSQL\Select as PostgreSQLSelect;

class Select extends PostgreSQLSelect implements PDOInterface
{
  use UsesPDO;
}