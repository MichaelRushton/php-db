<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Interfaces\Statements\InsertInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Insert as StatementsInsert;

class Insert extends StatementsInsert implements InsertInterface
{
    use Connection;
}
