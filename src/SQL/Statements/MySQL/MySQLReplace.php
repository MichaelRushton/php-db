<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\MySQL;

use MichaelRushton\DB\Interfaces\SQL\Statements\MySQL\MySQLReplaceInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\LowPriority;
use MichaelRushton\DB\SQL\Traits\Select;
use MichaelRushton\DB\SQL\Traits\Set;
use MichaelRushton\DB\SQL\Traits\Values;

class MySQLReplace extends Statement implements MySQLReplaceInterface
{
    use Columns;
    use Into;
    use LowPriority;
    use Select;
    use Set;
    use Values;

    public function toArray(): array
    {

        return [
            'REPLACE',
            $this->low_priority,
            $this->into,
            $this->getColumns(),
            implode(' ', array_filter([
                $this->getValues(),
                $this->getSet(),
                $this->getSelect(),
            ], '\strlen')) ?: 'VALUES ()',
        ];

    }
}
