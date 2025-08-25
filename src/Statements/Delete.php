<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Interfaces\StatementInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Delete as StatementsDelete;

class Delete extends StatementsDelete implements StatementInterface
{
    use Connection;
}
