<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\SQLite;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\SQLite\Insert as SQLiteInsert;

class Insert extends SQLiteInsert implements PDOInterface
{
  use UsesPDO;
}