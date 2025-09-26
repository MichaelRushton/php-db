<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Statements\SQLServer;

use MichaelRushton\DB\Interfaces\SQL\Statements\SQLServer\SQLServerDeleteInterface;
use MichaelRushton\DB\SQL\Statement;
use MichaelRushton\DB\SQL\Traits\From;
use MichaelRushton\DB\SQL\Traits\Join;
use MichaelRushton\DB\SQL\Traits\Output;
use MichaelRushton\DB\SQL\Traits\Table;
use MichaelRushton\DB\SQL\Traits\Top;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\WhereCurrentOf;
use MichaelRushton\DB\SQL\Traits\With;

class SQLServerDelete extends Statement implements SQLServerDeleteInterface
{
    use From;
    use Join;
    use Output;
    use Table;
    use Top;
    use Where;
    use WhereCurrentOf;
    use With;

    public function toArray(): array
    {

        return [
            $this->getWith(),
            'DELETE',
            $this->getTop(),
            $this->getTable(),
            $this->getOutput(),
            $this->getFrom(),
            $this->getJoin(),
            $this->getWhere(),
            $this->where_current_of,
        ];

    }
}
