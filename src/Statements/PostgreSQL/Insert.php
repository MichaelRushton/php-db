<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\PostgreSQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\PostgreSQL\Insert as PostgreSQLInsert;

class Insert extends PostgreSQLInsert implements PDOInterface
{
  use UsesPDO;
}