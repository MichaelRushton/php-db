<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\SQLite;

use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteInsertInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\OnConflict;
use MichaelRushton\DB\SQL\Traits\OrOnConflict;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Select;
use MichaelRushton\DB\SQL\Traits\Values;
use MichaelRushton\DB\SQL\Traits\With;

class SQLiteInsert extends Statement implements SQLiteInsertInterface
{
    use Columns;
    use Into;
    use OnConflict;
    use OrOnConflict;
    use Returning;
    use Select;
    use Values;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'INSERT',
            $this->or,
            $this->into,
            $this->getColumns(),
            implode(' ', array_filter([
                $this->getValues(),
                $this->getSelect(),
            ], '\strlen')) ?: 'DEFAULT VALUES',
            $this->getOnConflict(),
            $this->getReturning(),
        ];

    }
}
