<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL;
use Stringable;

trait OrderBy
{
    protected array $order_by = [];

    protected function order(
        string|Stringable|array $column,
        array $columns = [],
        string $direction = '',
    ): static {


        $column = \is_array($column) ? $column : [$column];

        foreach ($column as $column) {
            $this->order_by[] = [SQL::identifier($column), $direction];
        }

        foreach ($columns as $column) {
            $this->order($column, direction: $direction);
        }

        return $this;

    }

    public function orderBy(
        string|Stringable|array $column,
        string|Stringable|array ...$columns
    ): static
    {
        return $this->order($column, $columns);
    }

    public function orderByDesc(
        string|Stringable|array $column,
        string|Stringable|array ...$columns
    ): static
    {
        return $this->order($column, $columns, 'DESC');
    }

    public function orderByNullsFirst(
        string|Stringable|array $column,
        string|Stringable|array ...$columns
    ): static
    {
        return $this->order($column, $columns, 'ASC NULLS FIRST');
    }

    public function orderByNullsLast(
        string|Stringable|array $column,
        string|Stringable|array ...$columns
    ): static
    {
        return $this->order($column, $columns, 'ASC NULLS LAST');
    }

    public function orderByDescNullsFirst(
        string|Stringable|array $column,
        string|Stringable|array ...$columns
    ): static
    {
        return $this->order($column, $columns, 'DESC NULLS FIRST');
    }

    public function orderByDescNullsLast(
        string|Stringable|array $column,
        string|Stringable|array ...$columns
    ): static
    {
        return $this->order($column, $columns, 'DESC NULLS LAST');
    }

    protected function getOrderBy(): string
    {

        if (empty($this->order_by)) {
            return '';
        }

        foreach ($this->order_by as [$column, $direction]) {

            $order_by[] = trim($column . ' ' . $direction);

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return 'ORDER BY ' . implode(', ', $order_by);

    }
}
