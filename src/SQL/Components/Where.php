<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\WhereInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\When;
use MichaelRushton\DB\SQL\Traits\Where as WhereTrait;
use Stringable;

class Where implements WhereInterface, HasBindings, Stringable
{
    use Bindings;
    use When;
    use WhereTrait;

    public function __toString(): string
    {

        if (empty($this->where)) {
            return '';
        }

        $this->bindings = [];

        foreach ($this->where as [$prefix, $predicate]) {

            $where[] = $prefix . $predicate;

            if ($predicate instanceof HasBindings) {
                $this->mergeBindings($predicate);
            }

        }

        $where = implode(' ', $where);

        return 1 === \count($this->where) ? $where : '(' . $where . ')';

    }
}
