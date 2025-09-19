<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Overriding
{
    protected string $overriding = '';

    public function overridingSystemValue(): static
    {

        $this->overriding = 'OVERRIDING SYSTEM VALUE';

        return $this;

    }

    public function overridingUserValue(): static
    {

        $this->overriding = 'OVERRIDING USER VALUE';

        return $this;

    }
}
