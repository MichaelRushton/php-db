<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Any
{
    protected string $any = '';

    public function any(): static
    {

        $this->any = 'ANY';

        return $this;

    }
}
