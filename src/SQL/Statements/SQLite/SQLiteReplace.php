<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\SQLite;

use MichaelRushton\DB\Interfaces\SQL\Statements\SQLite\SQLiteReplaceInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Select;
use MichaelRushton\DB\SQL\Traits\Values;
use MichaelRushton\DB\SQL\Traits\With;

class SQLiteReplace extends Statement implements SQLiteReplaceInterface
{
    use Columns;
    use Into;
    use Returning;
    use Select;
    use Values;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'REPLACE',
            $this->into,
            $this->getColumns(),
            implode(' ', array_filter([
                $this->getValues(),
                $this->getSelect(),
            ], '\strlen')) ?: 'DEFAULT VALUES',
            $this->getReturning(),
        ];

    }
}
