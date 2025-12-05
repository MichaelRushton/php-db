<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\TableInterface;
use MichaelRushton\DB\SQL\Traits\Alias;
use MichaelRushton\DB\SQL\Traits\ForPortionOf;
use MichaelRushton\DB\SQL\Traits\IndexHint;
use MichaelRushton\DB\SQL\Traits\Only;
use MichaelRushton\DB\SQL\Traits\Partition;
use MichaelRushton\DB\SQL\Traits\When;
use Stringable;

class Table implements TableInterface, Stringable
{
    use Alias;
    use ForPortionOf;
    use IndexHint;
    use Only;
    use Partition;
    use When;

    public function __construct(
        public readonly string $name
    ) {
    }

    public function __toString(): string
    {

        return implode(' ', array_filter([
          $this->only,
          $this->name,
          $this->getPartition(),
          $this->for_portion_of,
          $this->alias,
          $this->getIndexHint(),
        ]));

    }
}
