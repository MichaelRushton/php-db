<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL;
use Stringable;

trait SelectColumns
{
    protected array $columns = [];

    public function columns(
        string|Stringable|int|float|bool|null|array $column,
        string|Stringable|int|float|bool|null|array ...$columns
    ): static {

        $column = \is_array($column) ? $column : [$column];

        foreach ($column as $alias => $column) {
            $this->columns[] = [SQL::identifier($column), \is_string($alias) ? ' ' . $alias : ''];
        }

        foreach ($columns as $column) {
            $this->columns($column);
        }

        return $this;

    }

    protected function getColumns(): string
    {

        if (empty($this->columns)) {
            return '*';
        }

        foreach ($this->columns as [$column, $alias]) {

            $columns[] = $column . $alias;

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return implode(', ', $columns);

    }
}
