<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\SQLite;

use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteDeleteInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\Limit;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\With;

class SQLiteDelete extends Statement implements SQLiteDeleteInterface
{
    use From;
    use Limit;
    use OrderBy;
    use Returning;
    use Where;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'DELETE',
            $this->getFrom(),
            $this->getWhere(),
            $this->getReturning(),
            $this->getOrderBy(),
            $this->getLimit(),
        ];

    }
}
