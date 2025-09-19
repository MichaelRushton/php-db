<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\SQLServer;

use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerSelectInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Distinct;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\GroupBy;
use MichaelRushton\DB\SQL\Traits\Having;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\OffsetFetch;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\SelectColumns;
use MichaelRushton\DB\SQL\Traits\SetOperation;
use MichaelRushton\DB\SQL\Traits\Top;
use MichaelRushton\DB\SQL\Traits\ToSubquery;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\Window;
use MichaelRushton\DB\SQL\Traits\With;

class SQLServerSelect extends Statement implements SQLServerSelectInterface
{
    use Distinct;
    use From;
    use GroupBy;
    use Having;
    use Into;
    use Join;
    use OffsetFetch;
    use OrderBy;
    use SelectColumns;
    use SetOperation;
    use Top;
    use ToSubquery;
    use Where;
    use Window;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'SELECT',
            $this->distinct,
            $this->getTop(),
            $this->getColumns(),
            $this->into,
            $this->getFrom(),
            $this->getJoin(),
            $this->getWhere(),
            $this->getGroupBy(),
            $this->getHaving(),
            $this->getWindow(),
            $this->getSetOperation(),
            $this->getOrderBy(),
            $this->getOffsetFetch(),
        ];

    }
}
