<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use Stringable;

trait RowCount
{
    protected int|string|Stringable $row_count = '';
    protected int|string|Stringable $offset = '';
}
