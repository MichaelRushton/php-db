<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\CTEInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Cycle;
use MichaelRushton\DB\SQL\Traits\CycleRestrict;
use MichaelRushton\DB\SQL\Traits\Materialized;
use MichaelRushton\DB\SQL\Traits\Search;
use MichaelRushton\DB\SQL\Traits\When;
use Stringable;

class CTE implements CTEInterface, HasBindings, Stringable
{
    use Bindings;
    use Columns;
    use Cycle;
    use CycleRestrict;
    use Materialized;
    use Search;
    use When;

    public function __construct(
        public readonly string $name,
        public readonly string|Stringable $stmt
    ) {
    }

    protected function getStmt(): string
    {

        $stmt = "($this->stmt)";

        if ($this->stmt instanceof HasBindings) {
            $this->mergeBindings($this->stmt);
        }

        return $stmt;

    }

    public function __toString(): string
    {

        $this->bindings = [];

        return implode(' ', array_filter([
          $this->name,
          $this->getColumns(),
          'AS',
          $this->materialized,
          $this->getStmt(),
          $this->getCycleRestrict(),
          $this->search,
          $this->cycle,
        ], '\strlen'));

    }
}
