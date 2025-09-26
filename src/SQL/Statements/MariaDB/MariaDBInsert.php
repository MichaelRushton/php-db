<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\MariaDB;

use MichaelRushton\DB\Interfaces\SQL\Statements\MariaDB\MariaDBInsertInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Delayed;
use MichaelRushton\DB\SQL\Traits\HighPriority;
use MichaelRushton\DB\SQL\Traits\Ignore;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\LowPriority;
use MichaelRushton\DB\SQL\Traits\OnDuplicateKeyUpdate;
use MichaelRushton\DB\SQL\Traits\Returning;
use MichaelRushton\DB\SQL\Traits\Select;
use MichaelRushton\DB\SQL\Traits\Set;
use MichaelRushton\DB\SQL\Traits\Values;

class MariaDBInsert extends Statement implements MariaDBInsertInterface
{
    use Columns;
    use Delayed;
    use HighPriority;
    use Ignore;
    use Into;
    use LowPriority;
    use OnDuplicateKeyUpdate;
    use Returning;
    use Select;
    use Set;
    use Values;

    public function toArray(): array
    {

        return [
            'INSERT',
            $this->low_priority,
            $this->delayed,
            $this->high_priority,
            $this->ignore,
            $this->into,
            $this->getColumns(),
            implode(' ', array_filter([
                $this->getValues(),
                $this->getSet(),
                $this->getSelect(),
            ], '\strlen')) ?: 'VALUES ()',
            $this->getOnDuplicateKeyUpdate(),
            $this->getReturning(),
        ];

    }
}
