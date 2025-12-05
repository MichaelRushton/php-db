<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use MichaelRushton\DB\SQL;
use Stringable;

trait Output
{
    protected array $output = [];

    public function output(
        string|Stringable|int|float|bool|null|array $column,
        string|Stringable|int|float|bool|null|array ...$columns
    ): static {

        $column = \is_array($column) ? $column : [$column];

        foreach ($column as $alias => $column) {
            $this->output[] = [SQL::identifier($column), \is_string($alias) ? ' ' . $alias : ''];
        }

        foreach ($columns as $column) {
            $this->output($column);
        }

        return $this;

    }

    protected function getOutput(): string
    {

        if (empty($this->output)) {
            return '';
        }

        foreach ($this->output as [$column, $alias]) {

            $output[] = $column . $alias;

            if ($column instanceof HasBindings) {
                $this->mergeBindings($column);
            }

        }

        return 'OUTPUT ' . implode(', ', $output);

    }
}
