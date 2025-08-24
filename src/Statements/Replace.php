<?php

declare(strict_types=1);

namespace MichaelRushton\DB\Statements;

use MichaelRushton\DB\Contracts\Statements\ReplaceInterface;
use MichaelRushton\DB\Traits\Connection;
use MichaelRushton\SQL\Statements\Replace as StatementsReplace;

class Replace extends StatementsReplace implements ReplaceInterface
{
    use Connection;
}
