<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\HavingInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\Having as HavingTrait;
use MichaelRushton\DB\SQL\Traits\When;
use Stringable;

class Having implements HavingInterface, HasBindings, Stringable
{
    use Bindings;
    use HavingTrait;
    use When;

    public function __toString(): string
    {

        if (empty($this->having)) {
            return '';
        }

        $this->bindings = [];

        foreach ($this->having as [$prefix, $predicate]) {

            $having[] = $prefix . $predicate;

            if ($predicate instanceof HasBindings) {
                $this->mergeBindings($predicate);
            }

        }

        $having = implode(' ', $having);

        return 1 === \count($this->having) ? $having : '(' . $having . ')';

    }
}
