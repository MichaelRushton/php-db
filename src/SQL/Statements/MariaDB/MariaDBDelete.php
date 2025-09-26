<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\MariaDB;

use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBDeleteInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\Ignore;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Limit;
use MichaelRushton\DB\SQL\Traits\LowPriority;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\Quick;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Table;
use MichaelRushton\DB\SQL\Traits\Using;
use MichaelRushton\DB\SQL\Traits\Where;

class MariaDBDelete extends Statement implements MariaDBDeleteInterface
{
    use From;
    use Ignore;
    use Join;
    use Limit;
    use LowPriority;
    use OrderBy;
    use Quick;
    use Returning;
    use Table;
    use Using;
    use Where;

    public function toArray(): array
    {

        return [
            'DELETE',
            $this->low_priority,
            $this->quick,
            $this->ignore,
            $this->getTable(),
            $this->getFrom(),
            $this->getUsing(),
            $this->getJoin(),
            $this->getWhere(),
            $this->getOrderBy(),
            $this->getLimit(),
            $this->getReturning(),
        ];

    }
}
