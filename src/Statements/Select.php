<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Contracts\Statements\SelectInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Select as StatementsSelect;

class Select extends StatementsSelect implements SelectInterface
{
  use Connection;
}