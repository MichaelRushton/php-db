<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\SQLite;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\SQLite\Replace as SQLiteReplace;

class Replace extends SQLiteReplace implements PDOInterface
{
  use UsesPDO;
}