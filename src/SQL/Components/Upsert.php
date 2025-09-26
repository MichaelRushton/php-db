<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\UpsertInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\OnConstraint;
use MichaelRushton\DB\SQL\Traits\Set;
use MichaelRushton\DB\SQL\Traits\When;
use MichaelRushton\DB\SQL\Traits\Where;
use MichaelRushton\DB\SQL\Traits\WhereIndex;
use Stringable;

class Upsert implements UpsertInterface, HasBindings, Stringable
{
    use Bindings;
    use Columns;
    use OnConstraint;
    use Set;
    use Where;
    use WhereIndex;
    use When;

    public function __toString(): string
    {

        $this->bindings = [];

        return implode(' ', array_filter([
          $this->getColumns(),
          $this->getWhereIndex(),
          $this->on_constraint,
          'DO',
          empty($this->set) ? 'NOTHING' : 'UPDATE',
          $this->getSet(),
          $this->getWhere(),
        ], '\strlen'));

    }
}
