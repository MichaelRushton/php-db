<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Pipe
{
    public function pipe(callable $callback): mixed
    {
        return $callback($this);
    }
}
