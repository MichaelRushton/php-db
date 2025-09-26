<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\PostgreSQL;

use MichaelRushton\DB\Interfaces\SQL\Statements\PostgreSQL\PostgreSQLInsertInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\OnConflict;
use MichaelRushton\DB\SQL\Traits\Overriding;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Select;
use MichaelRushton\DB\SQL\Traits\Values;
use MichaelRushton\DB\SQL\Traits\With;

class PostgreSQLInsert extends Statement implements PostgreSQLInsertInterface
{
    use Columns;
    use Into;
    use OnConflict;
    use Overriding;
    use Returning;
    use Select;
    use Values;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'INSERT',
            $this->into,
            $this->getColumns(),
            $this->overriding,
            implode(' ', array_filter([
                $this->getValues(),
                $this->getSelect(),
            ], '\strlen')) ?: 'DEFAULT VALUES',
            $this->getOnConflict(),
            $this->getReturning(),
        ];

    }
}
