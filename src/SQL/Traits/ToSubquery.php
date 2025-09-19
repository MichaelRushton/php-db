<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Components\SubqueryInterface;
use MichaelRushton\DB\SQL\Components\Subquery;

trait ToSubquery
{
    public function toSubquery(): SubqueryInterface
    {
        return new Subquery($this);
    }
}
