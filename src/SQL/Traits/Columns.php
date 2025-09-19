<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Columns
{
    protected array $columns = [];

    public function columns(
        string|array $column,
        string|array ...$columns
    ): static
    {

        foreach ((array) $column as $column) {
            $this->columns[] = $column;
        }

        foreach ($columns as $column) {
            $this->columns($column);
        }

        return $this;

    }

    protected function getColumns(): string
    {

        if (empty($this->columns)) {
            return '';
        }

        return '(' . implode(', ', $this->columns) . ')';

    }
}
