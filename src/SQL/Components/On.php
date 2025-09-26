<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\OnInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\On as OnTrait;
use MichaelRushton\DB\SQL\Traits\When;
use Stringable;

class On implements OnInterface, HasBindings, Stringable
{
    use Bindings;
    use OnTrait;
    use When;

    public function __toString(): string
    {

        if (empty($this->on)) {
            return '';
        }

        $this->bindings = [];

        foreach ($this->on as [$prefix, $predicate]) {

            $on[] = $prefix . $predicate;

            if ($predicate instanceof HasBindings) {
                $this->mergeBindings($predicate);
            }

        }

        $on = implode(' ', $on);

        return 1 === \count($this->on) ? $on : '(' . $on . ')';

    }
}
