<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\SubqueryInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Alias;
use MichaelRushton\DB\SQL\Traits\All;
use MichaelRushton\DB\SQL\Traits\Any;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\Columns;
use MichaelRushton\DB\SQL\Traits\Exists;
use MichaelRushton\DB\SQL\Traits\In;
use MichaelRushton\DB\SQL\Traits\Lateral;
use MichaelRushton\DB\SQL\Traits\When;
use Stringable;

class Subquery implements SubqueryInterface, HasBindings, Stringable
{
    use Alias;
    use All;
    use Any;
    use Bindings;
    use Columns;
    use Exists;
    use In;
    use Lateral;
    use When;

    public function __construct(
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
            $this->all,
            $this->any,
            $this->exists,
            $this->in,
            $this->lateral,
            $this->getStmt(),
            $this->alias,
            $this->getColumns(),
        ], '\strlen'));

    }
}
