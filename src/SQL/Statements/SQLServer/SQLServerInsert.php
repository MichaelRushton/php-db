<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\SQLServer;

use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerInsertInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Into;
use MichaelRushton\DB\SQL\Traits\Output;
use MichaelRushton\DB\SQL\Traits\Select;
use MichaelRushton\DB\SQL\Traits\Top;
use MichaelRushton\DB\SQL\Traits\Values;
use MichaelRushton\DB\SQL\Traits\With;

class SQLServerInsert extends Statement implements SQLServerInsertInterface
{
    use Columns;
    use Into;
    use Output;
    use Select;
    use Top;
    use Values;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'INSERT',
            $this->getTop(),
            $this->into,
            $this->getColumns(),
            $this->getOutput(),
            implode(' ', array_filter([
                $this->getValues(),
                $this->getSelect(),
            ], '\strlen')) ?: 'DEFAULT VALUES',
        ];

    }
}
