<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

use MichaelRushton\DB\Interfaces\SQL\Traits\HasBindings;
use Stringable;

trait SetOperation
{
    protected array $set_operation = [];

    protected function setOperation(
        string $type,
        string|Stringable|callable|array $stmt
    ): static {

        $stmts = \is_array($stmt) ? $stmt : [$stmt];

        foreach ($stmts as $stmt) {

            if (\is_callable($stmt)) {
                $stmt($stmt = $this->connection()->select());
            }

            $this->set_operation[] = [$type, $stmt];

        }

        return $this;

    }

    public function union(string|Stringable|callable|array $stmt): static
    {
        return $this->setOperation('UNION', $stmt);
    }

    public function unionAll(string|Stringable|callable|array $stmt): static
    {
        return $this->setOperation('UNION ALL', $stmt);
    }

    public function intersect(string|Stringable|callable|array $stmt): static
    {
        return $this->setOperation('INTERSECT', $stmt);
    }

    public function intersectAll(string|Stringable|callable|array $stmt): static
    {
        return $this->setOperation('INTERSECT ALL', $stmt);
    }

    public function except(string|Stringable|callable|array $stmt): static
    {
        return $this->setOperation('EXCEPT', $stmt);
    }

    public function exceptAll(string|Stringable|callable|array $stmt): static
    {
        return $this->setOperation('EXCEPT ALL', $stmt);
    }

    protected function getSetOperation(): string
    {

        if (empty($this->set_operation)) {
            return '';
        }

        foreach ($this->set_operation as [$type, $stmt]) {

            $set_operation[] = $type . ' ' . $stmt;

            if ($stmt instanceof HasBindings) {
                $this->mergeBindings($stmt);
            }

        }

        return implode(' ', $set_operation);

    }
}
