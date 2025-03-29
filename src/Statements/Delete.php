<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Contracts\Statements\DeleteInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Delete as StatementsDelete;

class Delete extends StatementsDelete implements DeleteInterface
{
  use Connection;
}