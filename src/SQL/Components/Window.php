<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\WindowInterface;
use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL\Traits\Bindings;
use MichaelRushton\DB\SQL\Traits\FrameSpec;
use MichaelRushton\DB\SQL\Traits\OrderBy;
use MichaelRushton\DB\SQL\Traits\PartitionBy;
use MichaelRushton\DB\SQL\Traits\SpecName;
use MichaelRushton\DB\SQL\Traits\When;
use Stringable;

class Window implements WindowInterface, HasBindings, Stringable
{
    use Bindings;
    use FrameSpec;
    use OrderBy;
    use PartitionBy;
    use SpecName;
    use When;

    public function __construct(
        public readonly string $name
    ) {
    }

    protected function getSpec(): string
    {

        return implode(' ', array_filter([
          $this->spec_name,
          $this->getPartitionBy(),
          $this->getOrderBy(),
          $this->getFrameSpec(),
        ], '\strlen'));

    }

    public function __toString(): string
    {

        $this->bindings = [];

        return $this->name . ' AS (' . $this->getSpec() . ')';

    }
}
