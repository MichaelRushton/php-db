<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Alias
{
    protected string $alias = '';

    public function as(string $alias): static
    {

        $this->alias = $alias;

        return $this;

    }
}
