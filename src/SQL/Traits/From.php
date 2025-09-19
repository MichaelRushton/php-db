<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL;
use Stringable;

trait From
{
    protected array $from = [];

    public function from(
        string|Stringable|array $table,
        string|Stringable|array ...$tables
    ): static
    {

        $table = \is_array($table) ? $table : [$table];

        foreach ($table as $alias => $table) {
            $this->from[] = [SQL::identifier($table), \is_string($alias) ? ' ' . $alias : ''];
        }

        foreach ($tables as $table) {
            $this->from($table);
        }

        return $this;

    }

    protected function getFrom(): string
    {

        if (empty($this->from)) {
            return '';
        }

        foreach ($this->from as [$table, $alias]) {

            $from[] = $table . $alias;

            if ($table instanceof HasBindings) {
                $this->mergeBindings($table);
            }

        }

        return 'FROM ' . implode(', ', $from);

    }
}
