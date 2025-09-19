<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait SpecName
{
    protected string $spec_name = '';

    public function specName(string $name): static
    {

        $this->spec_name = $name;

        return $this;

    }
}
