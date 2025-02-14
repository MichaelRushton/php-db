<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\PostgreSQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\PostgreSQL\Update as PostgreSQLUpdate;

class Update extends PostgreSQLUpdate implements PDOInterface
{
  use UsesPDO;
}