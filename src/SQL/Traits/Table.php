<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL;
use Stringable;

trait Table
{
    protected array $table = [];

    public function table(
        string|Stringable|array $table,
        string|Stringable|array ...$tables
    ): static
    {

        $table = \is_array($table) ? $table : [$table];

        foreach ($table as $alias => $table) {
            $this->table[] = [SQL::identifier($table), \is_string($alias) ? ' ' . $alias : ''];
        }

        foreach ($tables as $table) {
            $this->table($table);
        }

        return $this;

    }

    protected function getTable(): string
    {

        if (empty($this->table)) {
            return '';
        }

        foreach ($this->table as [$table, $alias]) {

            $tables[] = $table . $alias;

            if ($table instanceof HasBindings) {
                $this->mergeBindings($table);
            }

        }

        return implode(', ', $tables);

    }
}
