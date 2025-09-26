<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\PostgreSQL;

use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLDeleteInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Using;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\WhereCurrentOf;
use MichaelRushton\DB\SQL\Traits\With;

class PostgreSQLDelete extends Statement implements PostgreSQLDeleteInterface
{
    use From;
    use Join;
    use Returning;
    use Using;
    use Where;
    use WhereCurrentOf;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'DELETE',
            $this->getFrom(),
            $this->getUsing(),
            $this->getJoin(),
            $this->getWhere(),
            $this->where_current_of,
            $this->getReturning(),
        ];

    }
}
