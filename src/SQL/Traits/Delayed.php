<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Delayed
{
    protected string $delayed = '';

    public function delayed(): static
    {

        $this->delayed = 'DELAYED';

        return $this;

    }
}
