<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait CycleRestrict
{
    protected array $cycle_restrict = [];

    public function cycleRestrict(
        string|array $column,
        string|array ...$columns
    ): static
    {

        foreach ((array) $column as $column) {
            $this->cycle_restrict[] = $column;
        }

        foreach ($columns as $column) {
            $this->cycleRestrict($column);
        }

        return $this;

    }

    protected function getCycleRestrict(): string
    {

        if (empty($this->cycle_restrict)) {
            return '';
        }

        $cycle_restrict = implode(', ', $this->cycle_restrict);

        return 'CYCLE ' . $cycle_restrict . ' RESTRICT';

    }
}
