<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\MySQL;

use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLUpdateInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Ignore;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Limit;
use MichaelRushton\DB\SQL\Traits\LowPriority;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\Set;
use MichaelRushton\DB\SQL\Traits\Table;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\With;

class MySQLUpdate extends Statement implements MySQLUpdateInterface
{
    use Ignore;
    use Join;
    use Limit;
    use LowPriority;
    use OrderBy;
    use Set;
    use Table;
    use Where;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'UPDATE',
            $this->low_priority,
            $this->ignore,
            $this->getTable(),
            $this->getJoin(),
            $this->getSet(),
            $this->getWhere(),
            $this->getOrderBy(),
            $this->getLimit(),
        ];

    }
}
