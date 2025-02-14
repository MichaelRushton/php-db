<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements\SQLite;

use MichaelRushton\DB\Contracts\PDOInterface;
use MichaelRushton\DB\Traits\UsesPDO;
use MichaelRushton\SQL\Statements\SQLite\Select as SQLiteSelect;

class Select extends SQLiteSelect implements PDOInterface
{
  use UsesPDO;
}