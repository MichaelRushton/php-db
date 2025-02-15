<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\PostgreSQL;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\PostgreSQL\Delete as PostgreSQLDelete;

class Delete extends PostgreSQLDelete implements PDOInterface
{
  use UsesPDO;
}