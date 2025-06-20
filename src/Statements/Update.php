<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Contracts\Statements\UpdateInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Update as StatementsUpdate;

class Update extends StatementsUpdate implements UpdateInterface
{
  use Connection;
}