<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\MariaDB;

use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBSelectInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Distinct;
use MichaelRushton\DB\SQL\Traits\ForUpdate;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\GroupBy;
use MichaelRushton\DB\SQL\Traits\Having;
use MichaelRushton\DB\SQL\Traits\HighPriority;
use MichaelRushton\DB\SQL\Traits\IntoDumpfile;
use MichaelRushton\DB\SQL\Traits\IntoOutfile;
use MichaelRushton\DB\SQL\Traits\IntoVar;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Limit;
use MichaelRushton\DB\SQL\Traits\LockInShareMode;
use MichaelRushton\DB\SQL\Traits\OffsetFetch;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\RowsExamined;
use MichaelRushton\DB\SQL\Traits\SelectColumns;
use MichaelRushton\DB\SQL\Traits\SetOperation;
use MichaelRushton\DB\SQL\Traits\SQLBigResult;
use MichaelRushton\DB\SQL\Traits\SQLBufferResult;
use MichaelRushton\DB\SQL\Traits\SQLCache;
use MichaelRushton\DB\SQL\Traits\SQLCalcFoundRows;
use MichaelRushton\DB\SQL\Traits\SQLSmallResult;
use MichaelRushton\DB\SQL\Traits\StraightJoin;
use MichaelRushton\DB\SQL\Traits\ToSubquery;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\With;

class MariaDBSelect extends Statement implements MariaDBSelectInterface
{
    use Distinct;
    use ForUpdate;
    use From;
    use GroupBy;
    use Having;
    use HighPriority;
    use IntoDumpfile;
    use IntoOutfile;
    use IntoVar;
    use Join;
    use Limit;
    use LockInShareMode;
    use OffsetFetch;
    use OrderBy;
    use RowsExamined;
    use SelectColumns;
    use SetOperation;
    use SQLBigResult;
    use SQLBufferResult;
    use SQLCache;
    use SQLCalcFoundRows;
    use SQLSmallResult;
    use StraightJoin;
    use ToSubquery;
    use Where;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'SELECT',
            $this->distinct,
            $this->high_priority,
            $this->straight_join,
            $this->sql_small_result,
            $this->sql_big_result,
            $this->sql_buffer_result,
            $this->sql_cache,
            $this->sql_calc_found_rows,
            $this->getColumns(),
            $this->getFrom(),
            $this->getJoin(),
            $this->getWhere(),
            $this->getGroupBy(),
            $this->getHaving(),
            $this->getSetOperation(),
            $this->getOrderBy(),
            $this->getLimit() ?: $this->getOffsetFetch(),
            $this->getRowsExamined(),
            $this->getIntoOutfile(),
            $this->into_dumpfile,
            $this->getIntoVar(),
            $this->getForUpdate(),
            $this->lock_in_share_mode,
        ];

    }
}
