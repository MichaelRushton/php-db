<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait All
{
    protected string $all = '';

    public function all(): static
    {

        $this->all = 'ALL';

        return $this;

    }
}
