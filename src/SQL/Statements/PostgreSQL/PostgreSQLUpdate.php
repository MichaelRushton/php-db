<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\PostgreSQL;

use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLUpdateInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Set;
use MichaelRushton\DB\SQL\Traits\Table;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\WhereCurrentOf;
use MichaelRushton\DB\SQL\Traits\With;

class PostgreSQLUpdate extends Statement implements PostgreSQLUpdateInterface
{
    use From;
    use Join;
    use Returning;
    use Set;
    use Table;
    use Where;
    use WhereCurrentOf;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'UPDATE',
            $this->getTable(),
            $this->getSet(),
            $this->getFrom(),
            $this->getJoin(),
            $this->getWhere(),
            $this->where_current_of,
            $this->getReturning(),
        ];

    }
}
