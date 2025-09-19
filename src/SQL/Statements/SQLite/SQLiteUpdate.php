<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\SQLite;

use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteUpdateInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Limit;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\OrOnConflict;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Set;
use MichaelRushton\DB\SQL\Traits\Table;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\With;

class SQLiteUpdate extends Statement implements SQLiteUpdateInterface
{
    use From;
    use Join;
    use Limit;
    use OrderBy;
    use OrOnConflict;
    use Returning;
    use Set;
    use Table;
    use Where;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'UPDATE',
            $this->or,
            $this->getTable(),
            $this->getSet(),
            $this->getFrom(),
            $this->getJoin(),
            $this->getWhere(),
            $this->getReturning(),
            $this->getOrderBy(),
            $this->getLimit(),
        ];

    }
}
