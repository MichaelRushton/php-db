<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Interfaces\StatementInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Insert as StatementsInsert;

class Insert extends StatementsInsert implements StatementInterface
{
    use Connection;
}
