<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\PostgreSQL;

use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLSelectInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Distinct;
use MichaelRushton\DB\SQL\Traits\ForKeyShare;
use MichaelRushton\DB\SQL\Traits\ForNoKeyUpdate;
use MichaelRushton\DB\SQL\Traits\ForShare;
use MichaelRushton\DB\SQL\Traits\ForUpdate;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\GroupBy;
use MichaelRushton\DB\SQL\Traits\Having;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Limit;
use MichaelRushton\DB\SQL\Traits\OffsetFetch;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\SelectColumns;
use MichaelRushton\DB\SQL\Traits\SetOperation;
use MichaelRushton\DB\SQL\Traits\ToSubquery;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\Window;
use MichaelRushton\DB\SQL\Traits\With;

class PostgreSQLSelect extends Statement implements PostgreSQLSelectInterface
{
    use Distinct;
    use ForKeyShare;
    use ForNoKeyUpdate;
    use ForShare;
    use ForUpdate;
    use From;
    use GroupBy;
    use Having;
    use Join;
    use Limit;
    use OffsetFetch;
    use OrderBy;
    use SelectColumns;
    use SetOperation;
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
            $this->getColumns(),
            $this->getFrom(),
            $this->getJoin(),
            $this->getWhere(),
            $this->getGroupBy(),
            $this->getHaving(),
            $this->getWindow(),
            $this->getSetOperation(),
            $this->getOrderBy(),
            $this->getLimit() ?: $this->getOffsetFetch(),
            $this->getForUpdate(),
            $this->getForNoKeyUpdate(),
            $this->getForShare(),
            $this->getForKeyShare(),
        ];

    }
}
