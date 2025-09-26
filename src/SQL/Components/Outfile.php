<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Components;

use MichaelRushton\DB\Interfaces\SQL\Components\OutfileInterface;
use MichaelRushton\DB\SQL;
use MichaelRushton\DB\SQL\Traits\CharacterSet;
use MichaelRushton\DB\SQL\Traits\Fields;
use MichaelRushton\DB\SQL\Traits\Lines;
use MichaelRushton\DB\SQL\Traits\When;
use Stringable;

class Outfile implements OutfileInterface, Stringable
{
    use CharacterSet;
    use Fields;
    use Lines;
    use When;

    public function __construct(protected string $path)
    {
        $this->path = SQL::escape($path);
    }

    public function __toString(): string
    {

        return implode(' ', array_filter([
          "'$this->path'",
          $this->character_set,
          $this->getFields(),
          $this->getLines(),
        ], '\strlen'));

    }
}
