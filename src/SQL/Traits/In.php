<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait In
{
    protected string $in = '';

    public function in(): static
    {

        $this->in = 'IN';

        return $this;

    }
}
