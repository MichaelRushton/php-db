<?php

declare(strict_types=1);

namespace MichaelRushton\DB\SQL\Traits;

trait Partition
{
    protected array $partitions = [];

    public function partition(
        string|array $partition,
        string|array ...$partisions
    ): static {

        foreach ((array) $partition as $partition) {
            $this->partitions[] = $partition;
        }

        foreach ($partisions as $partition) {
            $this->partition($partition);
        }

        return $this;

    }

    protected function getPartition(): string
    {

        if (empty($this->partitions)) {
            return '';
        }

        return 'PARTITION (' . implode(', ', $this->partitions) . ')';

    }
}
