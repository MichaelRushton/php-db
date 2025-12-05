<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL;
use Stringable;

trait Returning
{
    protected array $returning = [];

    public function returning(
        string|Stringable|int|float|bool|null|array $column = '*',
        string|Stringable|int|float|bool|null|array ...$columns
    ): static {

        $column = \is_array($column) ? $column : [$column];

        foreach ($column as $alias => $column) {
            $this->returning[] = [SQL::identifier($column), \is_string($alias) ? ' ' . $alias : ''];
        }

        foreach ($columns as $column) {
            $this->returning($column);
        }

        return $this;

    }

    protected function getReturning(): string
    {

        if (empty($this->returning)) {
            return '';
        }

        foreach ($this->returning as [$column, $alias]) {

            $returning[] = $column . $alias;

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return 'RETURNING ' . implode(', ', $returning);

    }
}
