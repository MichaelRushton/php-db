<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Quick
{
    protected string $quick = '';

    public function quick(): static
    {

        $this->quick = 'QUICK';

        return $this;

    }
}
