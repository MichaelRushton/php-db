<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Through
{
    public function through(callable $callback): static
    {

        $callback($this);

        return $this;

    }
}
