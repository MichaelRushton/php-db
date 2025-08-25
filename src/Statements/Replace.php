<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Interfaces\StatementInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Replace as StatementsReplace;

class Replace extends StatementsReplace implements StatementInterface
{
    use Connection;
}
