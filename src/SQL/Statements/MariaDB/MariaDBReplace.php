<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\MariaDB;

use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBReplaceInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Delayed;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\LowPriority;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Select;
use MichaelRushton\DB\SQL\Traits\Set;
use MichaelRushton\DB\SQL\Traits\Values;

class MariaDBReplace extends Statement implements MariaDBReplaceInterface
{
    use Columns;
    use Delayed;
    use Into;
    use LowPriority;
    use Returning;
    use Select;
    use Set;
    use Values;

    public function toArray(): array
    {

        return [
            'REPLACE',
            $this->low_priority,
            $this->delayed,
            $this->into,
            $this->getColumns(),
            implode(' ', array_filter([
                $this->getValues(),
                $this->getSet(),
                $this->getSelect(),
            ], '\strlen')) ?: 'VALUES ()',
            $this->getReturning(),
        ];

    }
}
